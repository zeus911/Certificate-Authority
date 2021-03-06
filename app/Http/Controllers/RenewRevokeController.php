<?php

namespace App\Http\Controllers;

use Request;
use App\Csr;
use App\Cert;
use Input;
use Zipper;
use File;
use Response;

class RenewRevokeController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth');
    }

    public function renew()
    {
       if (isset($_POST['cn']) &&
           isset($_POST['csrprint']) &&
        
           !empty($_POST['cn']) &&
           !empty($_POST['csrprint']))
       {
            $cn = $_POST['cn'];
            $csrprint = $_POST['csrprint'];

            // Getting Collection from Certs.
            $certs = Cert::where('cn', $cn)->get()->first();

            // Return error if the certificate has already been revoked.
            if($cn == strpos($cn, '(R)'))
            {
              return view('errors.ooops', array(
                'cn' => $cn,
                'status' => 'Certificate exist but it is already revoked.'));
            }
            
            // Check if CN and CSR already exists.
            $cn_exists = Cert::where('cn', '=', Request::get('cn'))->first();
            $csr_exists = Cert::where('csrprint', '=', Request::get('csrprint'))->first();

            // return error page if there is no certificate in DB.
            if ($certs->certprint == 'Do not apply')
            {
              return view ('errors.ooops', array(
                'cn' => $cn,
                'status' => 'Certificate not found.'));
            }

            // Check if certificate has been signed by this CA. Otherwise, can´t be renewed.
            $certprint = $certs->certprint;
            $parse_cert = openssl_x509_parse($certprint);
            $issuer = $parse_cert['issuer'];
            $issuerCN = $issuer['CN'];
            if($issuerCN != 'TRAGSA CA G2'){
              return view ('errors.ooops', array(
                'cn' => $cn,
                'status' => 'Certificate is issued by: ' . $issuerCN . ' .Can´t renew it.'));
            }

            if (!isset($cn_exists) && !isset($csr_exists))
            {
              $csrprint = file_put_contents($cn . '.csr', $cn_exists->csrprint);

              return view('errors.ooops', array(
                'cn' => $cn,
                'status' => 'Either CN not CSR exist in DB.'));

             } else {

              return view ('certs.mgmt.renewed', array(
                'cn' => $cn,
                'csrprint' => $csrprint
                ));
           }

        
        }

    }

    public function getRenewed()
    {
        if (isset($_POST['cn']) && 
            isset($_POST['csrprint']) &&
            isset($_POST['password']) &&

            !empty($_POST['cn'])&&
            !empty($_POST['csrprint']) &&
            !empty($_POST['password']))
        { 
          $cn = $_POST['cn'];
          // Separate CN and SANs.
          $commonName = explode(" ", $cn);
          $cn = $commonName[0]; // Separate CN from SANs.
          $san = explode(",", ("DNS:".implode(",DNS:", $commonName)));
          $san = implode(",", $san); // Separated SANs
          $csr = $_POST['csrprint'];
          $password = $_POST['password'];
          $config = '/etc/ssl/openssl_serv.cnf';

          // Getting Collection from Certs.
          $certs = Cert::where('cn', $cn)->get()->first();
          $certprint = $certs->certprint;
          $cert_parser = openssl_x509_parse($certprint);
          $extensions = $cert_parser['extensions'];
          $nsCertType = $extensions['nsCertType'];

          // Rename nsCertType to fit openssl conf.
          if($nsCertType == 'Object Signing')
          {
            $nsCertType = 'CodeSigning';
          }
          if($nsCertType == 'SSL Server')
          {
            $nsCertType = 'SSL/TLS Server';
          }
          if($nsCertType == 'ClientID')
          {
            $nsCertType = 'ClientID';
          }
          if($nsCertType == 'SSL Client' OR $nsCertType == 'SSL Client, S/MIME')
          {
            $nsCertType = 'ClientID';
          }

        // Clean DNS entries.
        shell_exec("sudo /opt/subjectAltNameRemoval.sh 2>&1");          

        // Open Config file.
        $data = file_get_contents($config);

        // Do replacements.
        $data = str_replace("DNS:",$san, $data);
 
        // Save it back.
        file_put_contents($config, $data);
        unset($data);

        // Arguments to be passed to the CSR.
        $configArgs = array(
            'config' => $config,
            'encrypt_key' => false,
            'private_key_type' => OPENSSL_KEYTYPE_RSA,
            //'subjectAltName' => $san, // Not needed since it is hardcoded (above) in config file.
            'digest_alg' => 'sha256',
            'x509_extensions' => $nsCertType);

            $certificate_type = $nsCertType;
            $digest_alg = 'sha256';
            $serial = random_int(160001, 170001); // serial for external CSR
            $password = $_POST['password'];
            $cacert = file_get_contents('/opt/CA/cacert.pem');
            $pkeyid = array(file_get_contents('/opt/CA/private/cakey.pem'), $password );

            // Check if CN already exists.
            $cn_exists = Cert::where('cn', '=', Request::get('cn'))->first();

            if (isset($cn_exists))
            {
              $cert = openssl_csr_sign($csr , $cacert, $pkeyid, 730, $configArgs, $serial);

                // Sign csr from DB.
              $cert = openssl_csr_sign($csr , $cacert, $pkeyid, 730, $configArgs, $serial);

              // Export signed certificate to string variable.
              openssl_x509_export($cert, $certprint);

              // Put CSR and Cert in Files //
              file_put_contents(storage_path('cert.csr'), $csr);
              file_put_contents(storage_path('cert.cer'), $certprint);

              // ZIP the certificate, key and CA. Saved in storage folder.
              $zip = glob(storage_path('cert.*'));
              Zipper::make(storage_path('archives/' . $cn . '.zip'))->add($zip); 
              Zipper::close();

              // Clean DNS entries.
              shell_exec("sudo /opt/subjectAltNameRemoval.sh 2>&1");

              // Delete *.cer files
              File::delete(storage_path('cert.csr'));
              File::delete(storage_path('cert.cer'));

              // After renewing, delete the .cer from storage and monitoring. *.crt exstension gets updated
              File::delete(storage_path('public-keys/' . $cn . '.cer')); // In case it existed with .cer extension.


              // Save renewed certificate public key for expiry monitoring.
              openssl_x509_export_to_file($certprint, storage_path('public-keys/' . $cn . '.crt'));


              // DB Updates.
              //Cert::where('cn', $cn)->update(['cn' => $cn . '-Renewed']);
              Cert::where('cn', $cn)->update(['certificate_type' => $certificate_type]);
              Cert::where('cn', $cn)->update(['digest_alg' => $digest_alg]);
              Cert::where('cn', $cn)->update(['serial' => $serial]);
              Cert::where('cn', $cn)->update(['certprint' => $certprint]);
              Cert::where('cn', $cn)->update(['p12' => 'PFX archive not generated. You have to re-generate it again if you renewed the certificate.']);

              $headers = array('Content_Type: application/x-download',);
                return Response::download(storage_path('archives/' . $cn . '.zip'), $cn . '.zip', $headers)->deleteFileAfterSend(true);

            } 
        }   
    } 

    public function revoke()
    {
       if  (isset($_POST['cn']) && !empty($_POST['cn'])) 
       {
            $cn = $_POST['cn'];
            $certs = Cert::where('cn', $cn)->get()->first();
          // Return error if the certificate has already been revoked.
            if($cn == strpos($cn, '(R)'))
            {
              return view('errors.ooops', array(
                'cn' => $cn,
                'status' => 'Certificate exists and it is already revoked')); 
            
            } elseif ($certs->certprint == 'Do not apply') {

              return view ('errors.ooops', array(
                'cn' => $cn,
                'status' => 'Certificate not found'));
          } else {
                return view('certs.mgmt.revoke', array(
                'cn' => $cn,
                ));
        }
      }
    }


    public function revoked() 
    {
       if  (isset($_POST['cn']) &&
             isset($_POST['reason']) &&
             isset($_POST['password']) &&

             !empty($_POST['cn']) &&
             //!empty($_POST['reason']) &&
             !empty($_POST['password']))
            {

            $cn = $_POST['cn'];
            //$reason = $_POST['reason'];
            $password = $_POST['password'];
            $config = '/etc/ssl/openssl_serv.cnf';

            // Getting Collection from Certs.//
            $certs = Cert::where('cn', $cn)->get()->first();
            $certprint = $certs->certprint;
            $serial = $certs->serial;
            $configFile = $config;
            $updated_at = $certs->updated_at;
            $certfile = storage_path($serial . '.cer');
            $crlfile = storage_path('ca-g2.crl');

            // Return error if there is no certificate in DB.
            if ($certs->certprint == 'Do not apply')
            {
              return view ('errors.ooops', array(
                'cn' => $cn,
                'status' => 'Certificate not found.'));

            } 
            if ($certs->certprint !== 'Do not apply'){

            // Create cert file to revoke it.
            file_put_contents(storage_path($serial . '.cer'), $certprint);

            // Command to revoke certificate.
            $revoke = shell_exec("sudo openssl ca -config $config -revoke $certfile -key $password -batch 2>&1");

            // Search for status.
            $revoke_bad_password = substr($revoke, 50, 30);
      //dd($revoke_bad_password);
            $revoke_already_revoked = substr($revoke, -38, 15);
            $revoke_ok = substr($revoke, -18, 17);
      //dd($revoke_ok);
            if($revoke_bad_password == 'unable to load CA private key'){

              return view('errors.ooops', array(
                'cn' => $cn,
                'status' => 'Bad Password'
                ));

            } elseif ($revoke_already_revoked == 'Already Revoked'){

              return view('errors.ooops', array(
                'cn' => $cn,
                'status' => 'Already Revoked.'
                ));

            } elseif ($revoke_ok != 'Data Base Updated') {

              return view('errors.ooops', array(
                'cn' => $cn,
                'status' => 'Error updating the DB. Check your password and try again.'
                ));

            } elseif ($revoke_ok == 'Data Base Updated') {

              $status = 'Data Base Updated';

              if($status == 'Data Base Updated'){
                $status2 = 'Revoked';
              }
 
            // After revocation, delete the .cer from storage and monitoring.
            File::delete(storage_path($serial . '.cer'));
            File::delete(storage_path('public-keys/' . $cn . '.crt'));
            File::delete(storage_path('public-keys/' . $cn . '.cer')); // In case it existed with .cer extension.

            // Update DB. It includes the update date.
            Cert::where('cn', $cn)->update(['cn' => '(R)' . $cn . ' ' . $updated_at]);

            // Update CRL.
            $updateCRL = shell_exec('sudo openssl ca -gencrl -config $config -key $password -out /var/www/html/CA/storage/ca-g2.crl -batch 2>&1');

            // Parsing x509 attributes.
            $parse_cert = openssl_x509_parse($certprint);
            $issuer = $parse_cert['issuer'];
            $issuerCN = $issuer['CN'];
            $validFrom = date_create( '@' .  $parse_cert['validFrom_time_t'])->format('c');
            $validTo = date_create( '@' .  $parse_cert['validTo_time_t'])->format('c');
  
            return view ('certs.mgmt.revoked', array(
              'cn' => $cn,
              'serial' => $serial,
              'issuerCN' => $issuerCN,
              'validFrom' => $validFrom,
              'validTo' => $validTo,
              'updated_at' => $updated_at,
              //'reason' => $reason,
              'password' => $password,
              'status' => $status,
              'status2' => $status2
              ));
                    
              } else {
              return view ('errors.ooops', array(
                'cn' => $cn,
                'status' => 'At the end there has been an error.'));
            }
               
        }

      }
    }
}
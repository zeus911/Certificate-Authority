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
            	return view('errors.alreadyRevoked');
            	die();
            }
            
            // Check if CN and CSR already exists.
            $cn_exists = Cert::where('cn', '=', Request::get('cn'))->first();
            $csr_exists = Cert::where('csrprint', '=', Request::get('csrprint'))->first();

            // return error page if there is no certificate in DB.
            if ($certs->certprint == 'Do not apply')
            {
              return view ('errors.noCertFound');
            }

            if (!isset($cn_exists) && !isset($csr_exists))
            {
              $csrprint = file_put_contents($cn . '.csr', $cn_exists->csrprint);

              return view('dashboard.DoNotExist');

             } else {

              return view ('dashboard.renewed', array(
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
			    $cn = $commonName[0]; //separated cn
          $san = explode(",", ("DNS:".implode(",DNS:", $commonName)));
          $san = implode(",", $san); // separated sans
    	    $csr = $_POST['csrprint'];
        	$password = $_POST['password'];
        	$config = '/etc/ssl/openssl_serv.cnf';

          // Getting Collection from Certs.
          $certs = Cert::where('cn', $cn)->get()->first();

          $certprint = $certs->certprint;
          $cert_parser = openssl_x509_parse($certprint);
          $extensions = $cert_parser['extensions'];
          $nsCertType = $extensions['nsCertType'];
          $san = $extensions['subjectAltName'];

          // Rename nsCertType to fit openssl_code-signing.cnf.
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

        // Open Config file.
        $data = file_get_contents($config);

        // Do replacements.
        $data = str_replace("DNS:",$san, $data);
 
        //Save it back.
        file_put_contents($config, $data);
        unset($data);

        // Arguments to be passed to the CSR.
        $configArgs = array(
            'config' => $config,
            'encrypt_key' => false,
            'private_key_type' => OPENSSL_KEYTYPE_RSA,
            'subjectAltName' => $san,
            'digest_alg' => 'sha256',
            'x509_extensions' => $nsCertType);

            $certificate_type = $nsCertType;
            $digest_alg = 'sha256';
            $serial = random_int(160001, 170001); // serial for external CSR
            $password = $_POST['password'];
            $cacert = file_get_contents('/opt/CA/cacert.pem');
            $pkeyid = array(file_get_contents('/opt/CA/private/cakey.pem'), $password );

            // Check if CN already exists. // Posible Error: field 'cn' does not exists.
            $cn_exists = Cert::where('cn', '=', Request::get('cn'))->first();

            if (isset($cn_exists))
            {
              // Sign csr from DB.
            	$cert = openssl_csr_sign($csr , $cacert, $pkeyid, 730, $configArgs, $serial);

            	// Export signed certificate to string variable.
            	openssl_x509_export($cert, $certprint);

	          	// Put CSR and Cert in Files //
	            file_put_contents(storage_path('cert.csr'), $csr);
	            file_put_contents(storage_path('cert.cer'), $certprint);

	            // ZIP the certificate, key and CA. Saved in storage folder.
	            $zip = glob(storage_path('cert.*'));
	            Zipper::make(storage_path($cn . '.zip'))->add($zip);
	            Zipper::close();

	            // Clean DNS entries.
        		  shell_exec("sudo /opt/subjectAltNameRemoval.sh 2>&1");

	            // Delete *.cer files
	            File::delete(storage_path('cert.csr'));
	            File::delete(storage_path('cert.cer'));

	            // DB Updates.
	            //Cert::where('cn', $cn)->update(['cn' => $cn . '-Renewed']);
	            Cert::where('cn', $cn)->update(['certificate_type' => $certificate_type]);
	            Cert::where('cn', $cn)->update(['digest_alg' => $digest_alg]);
	            Cert::where('cn', $cn)->update(['serial' => $serial]);
            	Cert::where('cn', $cn)->update(['certprint' => $certprint]);
            	Cert::where('cn', $cn)->update(['p12' => 'PFX archive not generated. You have to re-generate it again if you renewed the certificate.']);

            	$headers = array('Content_Type: application/x-download',);
              	return Response::download(storage_path($cn . '.zip'), $cn . '.zip', $headers);

            } 
        }   
    } 

    public function revoke()
   	{
       if  (isset($_POST['cn']) && !empty($_POST['cn'])) 
       {
            $cn = $_POST['cn'];

            // Return error if the certificate has already been revoked.
            if($cn == strpos($cn, '(R)'))
            {
            	return view('errors.alreadyRevoked');
            	die();
            }
              return view('dashboard.revoke', array(
                'cn' => $cn,
                ));

        } else {

              return view ('errors.notRevoked');
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
              return view ('errors.noCertFound');

            } 
            if ($certs->certprint !== 'Do not apply'){

            // Create cert file to revoke it.
            file_put_contents(storage_path($serial . '.cer'), $certprint);

            // Command to revoke certificate.
            $revoke = shell_exec("sudo openssl ca -config $config -revoke $certfile -key $password -batch 2>&1");

            // Search for status.
            $revoke_bad_password = substr($revoke, 50, 29);
            $revoke_already_revoked = substr($revoke, -38, 15);
            $revoke_ok = substr($revoke, -18, 17);

            if($revoke_bad_password == 'Bad Password: Unable to load CA private key'){

            	$status = 'Bad Password';
            	return view('errors.notRevoked', array(
            		'cn' => $cn,
                'status' => $status
            		));

            } elseif ($revoke_already_revoked == 'Already Revoked'){

              $status = 'Already Revoked';
              //dd($revoke_already_revoked);
              return view('errors.notRevoked', array(
                'cn' => $cn,
                'status' => $status
                ));

            } elseif ($revoke_ok != 'Data Base Updated') {

              $status = 'Data Base NOT Updated.';
              //dd($revoke_ok);
              return view('errors.notRevoked', array(
                'cn' => $cn,
                'status' => $status
                ));

            } elseif ($revoke_ok == 'Data Base Updated') {

              $status = 'Data Base Updated';

              if($status == 'Data Base Updated'){
                $status2 = 'Revoked';
              }
 
            // After revocation, delete the .cer from storage.
            File::delete(storage_path($serial . '.cer'));



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
	
      			return view ('dashboard.revoked', array(
      				'cn' => $cn,
              		'serial' => $serial,
      				'issuerCN' => $issuerCN,
      				'validFrom' => $validFrom,
      				'validTo' => $validTo,
      				'updated_at' => $updated_at,
      				'reason' => $reason,
      				'password' => $password,
              		'status' => $status,
              		'status2' => $status2
      				));
                    
              } else {
              return view ('errors.notRevoked');
            }
               
        }

      }
    }
}
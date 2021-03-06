<?php

namespace App\Http\Controllers;

use Request;
use App\Csr;
use App\Cert;
use Input;
use Zipper;
use File;
use Response;


class CsrController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
    	
        	return view('csr.create');
    }

    public function created()
    {
        if(isset($_POST['cn']) &&
            isset($_POST['certificate_type']) && 
            isset($_POST['digest_alg']) &&

            !empty($_POST['cn']) &&
            !empty($_POST['certificate_type']) &&
            !empty($_POST['digest_alg']))
        {
            $cn = $_POST['cn'];
            // Separate CN and SANs.
            $commonName = explode(" ", $cn);
			$cn = $commonName[0]; //separated cn
            $san = explode(",", ("DNS:".implode(",DNS:", $commonName)));
            $san = implode(",", $san); // separated sans

            $certificate_type = $_POST['certificate_type'];
            $digest_alg = $_POST['digest_alg'];
            $serial = 'Do not apply: ' . $cn;
            $csrprint = 'Do not apply';
            $certprint = 'Do not apply';
            $keyprint = 'Do not apply';
            $p12 = 'PFX archive not generated. You have to re-generate it again if you renewed the certificate.';
            $config = '/etc/ssl/openssl_serv.cnf';


            // Check if CN already exists.
            $cn_exists = Cert::where('cn', '=', Request::get('cn'))->first();
                if (isset($cn_exists))
                {
                    return view ('errors.ooops', array(
                        'cn' => $cn,
                        'status' => 'Already signed and not revoked'
                        ));
                }
  
        // Data needed to populate the certificate. This should be provided through the 'create' Form.
        $dn = array(
        "countryName" => 'ES',
        "stateOrProvinceName" => 'Madrid',
        "localityName" => 'Madrid',
        "organizationName" => 'TRAGSA',
        "organizationalUnitName" => 'TRAGSA CA 1',
        "commonName" => $cn,
        //"emailAddress" => $EMailAdress
        );

        // Clean DNS entries.
        shell_exec("sudo /opt/subjectAltNameRemoval.sh 2>&1"); 

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
                'digest_alg' => $digest_alg );
        
        // Generate CSR and his corresponding Private Key.
        $keygen = openssl_pkey_new();
        $csrgen = openssl_csr_new($dn, $keygen, $configArgs);
         
        // Export Private Key to string.
        openssl_pkey_export($keygen, $keyprint);
        //openssl_pkey_export_to_file($keygen, $keystore);

        // Export CSR to string.
        openssl_csr_export($csrgen, $csrprint);
        //openssl_csr_export_to_file($csrgen, $csrstore);

        // Clean DNS entries.
        shell_exec("sudo /opt/subjectAltNameRemoval.sh 2>&1");
        
     	return view('csr.created', array(
            'cn' => $cn,
            'san' => $san,
            'certificate_type' => $certificate_type,
            'digest_alg' => $digest_alg,
            'serial' => $serial,
            'csrprint' => $csrprint,
            'certprint' => $certprint,
            'keyprint' => $keyprint,
            'p12' => $p12 ));
        } else {

            return view('errors.ooops', array(
            	'cn' => $cn,
            	'status' => 'Error in CSR'));
        }
        
    }


    public function getCSR()
   {
       if  (isset($_POST['cn']) && 
            isset($_POST['certificate_type']) &&
            isset($_POST['digest_alg']) &&
            isset($_POST['serial']) &&
            isset($_POST['csrprint']) &&
            isset($_POST['certprint']) &&
            isset($_POST['keyprint']) &&
            isset($_POST['p12']) &&

            !empty($_POST['cn']) &&
            !empty($_POST['certificate_type']) &&
            !empty($_POST['digest_alg']) &&
            !empty($_POST['serial']) &&
            !empty($_POST['csrprint']) &&
            !empty($_POST['certprint']) &&
            !empty($_POST['keyprint']) &&
            !empty($_POST['p12']))
        {
            $cn = $_POST['cn'];
            $certificate_type = $_POST['certificate_type'];
            $digest_alg = $_POST['digest_alg'];
            $serial = $_POST['serial'];
            $csr = $_POST['csrprint'];
            $cert = $_POST['certprint'];
            $key = $_POST['keyprint'];
            $p12 = $_POST['p12'];
            $status = 'N/A';

            // Check if CN already exists.
            $cn_exists = Cert::where('cn', '=', Request::get('cn'))->first();

            if (isset($cn_exists))
            {
            	return view ('errors.ooops', array(
            		'cn' => $cn,
                    'status' => 'Already signed and not revoked.'
            		));
            }
            
            // Make CSR and Cert File to include Blob in DB//
            file_put_contents(storage_path('cert.csr'), $csr);
            file_put_contents(storage_path('cert.key'), $key);
 
           // ZIP the certificate, key and CA. Saved in storage folder.
           $zip = glob(storage_path('cert.*'));
           Zipper::make(storage_path($cn . '.zip'))->add($zip);
           Zipper::close();

           // Delete *.cer files
           File::delete(storage_path('cert.csr'));
           File::delete(storage_path('cert.key'));
           

           //Csr::create(Request::only('cn', 'certificate_type', 'digest_alg','csr', 'cert', 'key'));
           Cert::create(Request::only('cn', 'certificate_type', 'digest_alg', 'serial', 'csrprint', 'certprint', 'keyprint', 'p12', 'status'));

           $headers = array('Content_Type: application/x-download',);
          
           return Response::download(storage_path($cn . '.zip'), $cn . '.zip', $headers)->deleteFileAfterSend(true);

       } else {

           return view ('errors.ooops', array(
           	'cn' => $cn,
           	'status' => 'Last error getCSR'));
       }
        
    }


    public function sign()
    {
        return view('csr.sign');
    }


    public function signed()
    {
        if (isset($_POST['csrprint']) &&
            isset($_POST['password']) &&

            !empty($_POST['csrprint']) &&
            !empty($_POST['password']))
        {
            $csr = $_POST['csrprint'];
            $password = $_POST['password'];
            $cn = openssl_csr_get_subject($csr, true);
            //dd($cn);
            $certificate_type = 'SSL/TLS Server';
            $digest_alg = 'sha256';
            $cert = 'Needs update!';
            $key = 'We do not have the key becouse it has been generated in another device.';
            $serial = random_int(260001, 270001); // serial for external CSR

            // Check if CN already exists.
            $cn_exists = Cert::where('cn', '=', Request::get('cn'))->first();

            if (isset($cn_exists))
            {
            	return view ('errors.ooops', array(
            		'cn' => $cn['CN'],
                    'status' => 'Already signed and not revoked.'
            	));
        
            } elseif ($cn_exists = 'null') {    

                return view ('csr.signed', array(
                    'cn' => $cn['CN'],
                    'certificate_type' => $certificate_type,
                    'digest_alg' => $digest_alg,
                    'serial' => $serial,
                    'csrprint' => $csr,
                    'certprint' => $cert,
                    'keyprint' => $key,
                    'p12' => 'PFX archive not generated. You have to re-generate it again if you renewed/signed the certificate.',
                    'password' => $password
                    ));

        	} else {
            	return view ('errors.signError');
            }
        }
    } 

    public function getExtCert()
    {
        if (isset($_POST['cn']) && 
            isset($_POST['certificate_type']) &&
            isset($_POST['digest_alg']) &&
            isset($_POST['serial']) &&
            isset($_POST['csrprint']) &&
            isset($_POST['certprint']) &&
            isset($_POST['keyprint']) &&
            isset($_POST['p12']) &&
            isset($_POST['password']) &&

            !empty($_POST['cn'])&&
            !empty($_POST['csrprint']) &&
            !empty($_POST['password']))
        {
            $cn = $_POST['cn'];
            $certificate_type = $_POST['certificate_type'];
            $digest_alg = $_POST['digest_alg'];
            $serial = $_POST['serial'];
            $csr = $_POST['csrprint'];
            $cert = $_POST['certprint'];
            $key = $_POST['keyprint'];
            $p12 = $_POST['p12'];
            $status = 'Valid'; // but no key
            $password = $_POST['password'];
            $cacert = file_get_contents('/opt/CA/cacert.pem');
            $pkeyid = array(file_get_contents('/opt/CA/private/cakey.pem'), $password );
            //$serial = random_int(260001, 270001); // serial for external CSR

            // Clear SAN DNS entries if previous error.
            shell_exec("sudo /opt/subjectAltNameRemoval.sh 2>&1");
            
            // Extracting SAN fron CSR.
			  $random_blurp = rand(1000,99999); 
			  //openssl_csr_get_subject doesn't support SAN names.
			  $filename = "/tmp/csr-" . $random_blurp . ".csr.pem";
			  $write_csr = file_put_contents($filename, $csr);
			  if($write_csr !== FALSE) {
			    $san = trim(shell_exec(" openssl req -noout -text -in " . $filename . " | grep -e 'DNS:' -e 'IP:'"));
			  }
			  unlink($filename); // Completely deletes the file.

			  // In case the CSR file doesn´t include SAN.
			  if($san == ""){
			  	$san = 'DNS:' . $cn;
			  }

            // Include subjectAltName in conf.
            $data = file_get_contents("/etc/ssl/openssl_serv.cnf");

            // do replacements.
            $data = str_replace("DNS:",$san, $data);

            //save it back.
            file_put_contents("/etc/ssl/openssl_serv.cnf", $data);
            unset($data); // Clears the content of the file.

            $configArgs = array(
                //'config' => '/usr/lib/ssl/openssl.cnf',
                'config' => '/etc/ssl/openssl_serv.cnf',
                'encrypt_key' => false,
                'private_key_type' => OPENSSL_KEYTYPE_RSA,
                'digest_alg' => $digest_alg,
                //'subjectAltName' => $san,
                'x509_extensions' => $certificate_type );

            // Check if CN already exists.
            $cn_exists = Cert::where('cn', '=', Request::get('cn'))->first();

            if (isset($cn_exists)){
            	
            	// Clean SAN DNS entries.
            	shell_exec("sudo /opt/subjectAltNameRemoval.sh 2>&1");
                
                return view ('errors.ooops', array(
                    'cn' => $cn,
                    'status' => 'Already signed and not revoked.'
                ));
            } elseif ($cn_exists = 'null') {


            // Sign certificate function.
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

            // Delete *.cer files
            File::delete(storage_path('cert.csr'));
            File::delete(storage_path('cert.cer'));

            // Clean SAN DNS entries.
            shell_exec("sudo /opt/subjectAltNameRemoval.sh 2>&1");

            // Creates records for the giving $CN.
            Cert::create(Request::only('cn', 'certificate_type', 'digest_alg', 'serial', 'csrprint', 'certprint', 'keyprint', 'p12', 'status'));

            // Updates de table with the 'cert' generated above.
            Cert::where('cn', $cn)->update(['certprint' => $certprint]);

            $headers = array('Content_Type: application/x-download',);
          
            return Response::download(storage_path($cn . '.zip'), $cn . '.zip', $headers)->deleteFileAfterSend(true);

            } else {
                return view ('errors.getExtCertError', array (
                    'cn' => $cn,
                    'san' => $san,
                    'certificate_type' => $certificate_type,
                    'digest_alg' => $digest_alg,
                    'serial' => $serial,
                    'cn_exists' => $cn_exists,
                    'csr' => $csr,
                    'cert' => $cert,
                    'key' => $key,
                    ));
            }
        }
    } 
}
 
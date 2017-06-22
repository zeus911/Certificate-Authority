<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use App\Cert; // Makes the model available to the Controller.
use DB;
use Zipper;
use File;
use Response;

class CertsController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }


    //public function create(Request $request)
    public function create()
    {

        return view('certs.create');
    }

    public function created()
    {
        if(isset($_POST['cn']) && 
            isset($_POST['certificate_type']) && 
            isset($_POST['digest_alg']) &&
            isset($_POST['key_length']) &&
            isset($_POST['password']) &&

            !empty($_POST['cn']) &&
            !empty($_POST['certificate_type']) &&
            !empty($_POST['digest_alg']) &&
            !empty($_POST['key_length']) &&
            !empty($_POST['password']) )
        {
            $cn= $_POST['cn'];
            $certificate_type = $_POST['certificate_type'];
            $digest_alg = $_POST['digest_alg'];
            $key_length = $_POST['key_length'];
            $password = $_POST['password'];

        // Check if CN already exists.

            $cn_exists = Cert::where('cn', '=', Request::get('cn'))->first();

            if (isset($cn_exists))
            {
                return view ('errors.cnExists', array(
                    'cn' => $cn,
                    'error_details' => 'already exist in DB'
                    ));
            }

        // Data needed to populate the certificate.
        $dn = array(
        "countryName" => 'ES',
        "stateOrProvinceName" => 'Madrid',
        "localityName" => 'Madrid',
        "organizationName" => 'LIQUABIT',
        "organizationalUnitName" => 'LIQUABIT CA',
        "commonName" => $cn,
        //"emailAddress" => $EMailAdress
        );   
        
        // Arguments to be passed to the CSR.
        $configArgs = array(
                #'config' => '/usr/lib/ssl/openssl.cnf',
                'config' => '/etc/ssl/openssl_serv.cnf',
                'encrypt_key' => false,
                'private_key_type' => OPENSSL_KEYTYPE_RSA,
                'digest_alg' => $digest_alg );
        
        // Generate CSR and his corresponding Private Key.
        $keygen = openssl_pkey_new();
        $csrgen = openssl_csr_new($dn, $keygen, $configArgs);
dd($csrgen);
        // Export Private Key to string.
        openssl_pkey_export($keygen, $keyprint);
        //openssl_pkey_export_to_file($keygen, $keystore);

        // Export CSR to string.
        openssl_csr_export($csrgen, $csrprint);
        //openssl_csr_export_to_file($csrgen, $csrstore); 

        //-- Begin Signing CSR --//
        // Location of CA/Key certificates.
        $cacert = file_get_contents('/opt/CA/cacert.pem');
        $pkeyid = array(file_get_contents('/opt/CA/private/cakey.pem'), $password );


        // Function by itself does not generate the serial so it is inserted by this function.
        $serial = random_int(160001, 170001);

        $configArgs = array(
                'config' => '/etc/ssl/openssl_serv.cnf',
                'encrypt_key' => false,
                'private_key_type' => OPENSSL_KEYTYPE_RSA,
                'digest_alg' => $digest_alg,
                //'key_length' => $key_length,
                'x509_extensions' => $certificate_type );
        
        // Sign certificate function.
        $certgen = openssl_csr_sign($csrprint , $cacert, $pkeyid, 730, $configArgs, $serial);

        // Export signed certificate to string variable.
        openssl_x509_export($certgen, $certprint);
        //openssl_x509_export_to_file($certprint, $cn . 'crt' );

            return view('certs.created', array(
                'cn' => $cn,
                'certificate_type' => $certificate_type,
                'digest_alg' => $digest_alg,
                'key_length' => $key_length,
                'serial' => $serial,
                'csrprint' => $csrprint,
                'certprint' => $certprint,
                'keyprint' => $keyprint,
                ));

        } else {
            return view('errors.csrError');
        }
        
    }

    public function getCert()
   {
       if  (isset($_POST['cn']) && 
            isset($_POST['certificate_type']) &&
            isset($_POST['digest_alg']) &&
            isset($_POST['serial']) &&
            isset($_POST['csrprint']) &&
            isset($_POST['keyprint']) && 

            !empty($_POST['cn']) &&
            !empty($_POST['certificate_type']) &&
            !empty($_POST['digest_alg']) &&
            !empty($_POST['serial']) &&
            !empty($_POST['csrprint']) &&
            !empty($_POST['keyprint'])) 
        {
            $cn = $_POST['cn'];
            $certificate_type = $_POST['certificate_type'];
            $digest_alg = $_POST['digest_alg'];
            $serial = $_POST['serial'];
            $csrprint = $_POST['csrprint'];
            $certprint = $_POST['certprint'];
            $keyprint = $_POST['keyprint'];

            // Make CSR and Cert File to include Blob in DB//
            file_put_contents(storage_path('cert.cer'), $certprint);
            file_put_contents(storage_path('cert.key'), $keyprint);

           Cert::create(Request::only('cn','certificate_type', 'digest_alg', 'serial', 'csrprint', 'certprint', 'keyprint', 'p12'));

           // ZIP the certificate, key and CA. Saved in storage folder.
           $zip = glob(storage_path('cert.*'));
           Zipper::make(storage_path($cn . '.zip'))->add($zip);
           Zipper::close();

           // Delete *.cer files
           File::delete(storage_path('cert.cer'));
           File::delete(storage_path('cert.key'));
           
           $headers = array('Content_Type: application/x-download',);
          
           return Response::download(storage_path($cn . '.zip'), $cn . '.zip', $headers);

       } else {

           return view ('errors.downloadError');
       }
        
    }
    
    public function getP12()
    {
        if (isset($_POST['cn']) &&
            isset($_POST['csrprint']) &&
            isset($_POST['certprint']) &&
            isset($_POST['keyprint']) &&
            isset($_POST['password']) );
        {
            $cn = $_POST['cn'];
            $csrprint = $_POST['csrprint'];
            $cert = $_POST['certprint'];
            $key = $_POST['keyprint'];
            $password = $_POST['password'];
            
            $storage_path = storage_path();
            $p12 = storage_path($cn . '.p12');
            //$p12content = file_get_contents(storage_path($cn . '.p12'));
            $cacert = storage_path('cert.ca.cer');

            $p12args = array (
                'friendly_name' => $cn,
                'extracerts' => storage_path('cert.ca.cer')
            );

            // Export p12 to string to insert in DB.
            $p12export = openssl_pkcs12_export( $cert, $p12string, $key, $password );

            $p12export_to_file = openssl_pkcs12_export_to_file( $cert, $p12, $key, $password, $p12args );

            // Update field 'p12' in DB with output from the file itself.
            // It updates all 'p12' fields it exists. It sould be change with ID o latest.
            Cert::where('cn', $cn)->update(['p12' => $p12string]);

            $headers = array('Content_Type: application/x-download',);
          
           return Response::download(storage_path($cn . '.p12'), $cn . '.p12', $headers);
      }  
   }

}

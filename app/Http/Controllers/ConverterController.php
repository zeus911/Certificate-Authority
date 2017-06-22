<?php

namespace App\Http\Controllers;

use Request;
use Zipper;
use File;
use Response;
use App\Cert;
use Storage;
//use App\Converter; // Makes the model available to the Controller.

class ConverterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function p12()
    {
        return view('converter.p12');
    }

    public function createP12() // This is to pass the CN and passphrase for the archive from View->Create PFX
    {
    	if (isset($_POST['cn']) &&

    		!empty($_POST['cn']) );
        {
            $cn = $_POST['cn'];

        return view('converter.createP12', array(
        	'cn' => $cn) );

        }
    }

    public function storeP12() // This is to create P12 archives from View->Create PFX
    {
    	if (isset($_POST['cn']) &&
    		isset($_POST['password']) &&

    		!empty($_POST['cn']) &&
    		!empty($_POST['password']) );
        {
            $cn = $_POST['cn'];
            $password = $_POST['password'];

            // Get CN Certificate and Key.
            $cn_get_data = Cert::where('cn', '=', Request::get('cn'))->first();
            $certprint = $cn_get_data->certprint;
            $keyprint = $cn_get_data->keyprint;

            // Certificate parser (SubjectName...)
            $subject = openssl_x509_parse($certprint, true);
            $cn = $subject['subject']['CN'];

            // P12 storage path.
            $p12 = storage_path($cn . '.p12');

            // CACert storage path.
            //$cacert = file(storage_path('cert.ca.cer'));

            $cacert = array('-----BEGIN CERTIFICATE-----
MIID4TCCAsmgAwIBAgIJAPw5S5j3bdNfMA0GCSqGSIb3DQEBCwUAMF0xCzAJBgNV
BAYTAkVTMQ8wDQYDVQQIDAZNYWRyaWQxETAPBgNVBAoMCExJUVVBQklUMRQwEgYD
VQQLDAtMSVFVQUJJVCBDQTEUMBIGA1UEAwwLTElRVUFCSVQgQ0EwHhcNMTYxMTA4
MTEyMTU4WhcNMTkxMTA4MTEyMTU4WjBdMQswCQYDVQQGEwJFUzEPMA0GA1UECAwG
TWFkcmlkMREwDwYDVQQKDAhMSVFVQUJJVDEUMBIGA1UECwwLTElRVUFCSVQgQ0Ex
FDASBgNVBAMMC0xJUVVBQklUIENBMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIB
CgKCAQEAw+HG6DwQ5a7pfw2oou0AqaL9xg1W4Vg5uXt6uNJh9+1x3mfcIvXS0qXI
/ijQ3Rq9HUNGvv6bml1XE3c1US3BYnXIy0qlHXJkIWJqLhCZB8rk9xC3ZwMOhe7q
9ZRpb1K0UnSC1q4ADO+QnpGkE3xRIVNPKdADglLWFsBShU7paMwUNxHwG8DAEbh4
0uEmAYNXjR/Q4YSlOUC0L8CI9NWg9bYCyy511ns9nJTmfdqv+uNy7r78qmfTVb+D
V41aTsrUa5mane5SEeYWDM6tSdQZFBiW5CR74unN/qKXc/SQH8t8mTybSQLejVF5
c97kpEoNUDijJsbTHGlQ3YWnsuwrewIDAQABo4GjMIGgMB0GA1UdDgQWBBT/EXQ7
Rkq+AiNnJhyKNkSwYggbJTAfBgNVHSMEGDAWgBT/EXQ7Rkq+AiNnJhyKNkSwYggb
JTAMBgNVHRMEBTADAQH/MAsGA1UdDwQEAwIBBjARBglghkgBhvhCAQEEBAMCAQYw
MAYDVR0fBCkwJzAloCOgIYYfaHR0cHM6Ly93d3cubGlxdWFiaXQuY29tL2NhLmNy
bDANBgkqhkiG9w0BAQsFAAOCAQEAaCw6BRPyfKC2uoc9xy/FpOYL2CjwMNIrYSWe
PwwD/1Jx3E8EUyBCavFrcLo8cxtDUQ9HLkbGQNc0QcubkiD3N45zZjjf7tzlzp6/
LzOhQw60OciwRAezERAPsEbCqII8gjBsISx6fWtAomR54AZpvz2L8r0TtE/S2rb2
WdrIg7kmOfuEad/qVLMQaWipw3Oxx9JjqjvBRUqPmFejOszAVK5dMGRhc7UgTzQv
mPHvs6+/Ewmt/a5CJu804ZOpVmU0o8hZ79l2+hfxOSt37VNsV5O8ZHWlEXmaDLNY
5isPQFtPJDqgZCU6ofOc3ZCHwEi3UHCBIjUSjh7u/Es2TRiDVw==
-----END CERTIFICATE-----');
            
            // Arguments to pass to the P12 archive.
            $p12args = array (
              'extracerts' => $cacert,
              'friendly_name' => $cn
            );

            // Export p12 to string to insert in DB.
            $p12export = openssl_pkcs12_export($certprint, $p12string, $keyprint, $password, $p12args);

            $p12export_to_file = openssl_pkcs12_export_to_file($certprint, $p12, $keyprint, $password, $p12args);


            // Update field 'p12' in DB.
            Cert::where('cn', $cn)->update(['p12' => $p12string]);

            $headers = array('Content_Type: application/x-download',);
          
           return Response::download(storage_path($cn . '.p12'), $cn . '.p12', $headers);
      	}  

    }

    public function getP12()
    {
        if (isset($_POST['certprint']) &&
            isset($_POST['keyprint']) &&
            isset($_POST['password']) &&

            !empty($_POST['cn']) &&
            !empty($_POST['certprint']) &&
            !empty($_POST['keyprint']) );
        {
            $certprint = $_POST['certprint'];
            $keyprint = $_POST['keyprint'];
            $password = $_POST['password'];

            // Certificate parser (SubjectName...)
            $subject = openssl_x509_parse($certprint, true);
            //dd($subject['subject']['CN']);
            $cn = $subject['subject']['CN'];

            // P12 storage path.
            $p12 = storage_path($cn . '.p12');

            // Arguments to pass to the P12 archive.
            $p12args = array (
                'friendly_name' => $cn,
                'extracerts' => storage_path('cert.ca.cer')
            );

            // Export p12 to string to insert in DB.
            $p12export = openssl_pkcs12_export($certprint, $p12string, $keyprint, $password);

            $p12export_to_file = openssl_pkcs12_export_to_file($certprint, $p12, $keyprint, $password, $p12args);


            // Update field 'p12' in DB.
            Cert::where('cn', $cn)->update(['p12' => $p12string]);

            $headers = array('Content_Type: application/x-download',);
          
           return Response::download(storage_path($cn . '.p12'), $cn . '.p12', $headers);
      	}  
   }

   public function keystore()
   {
       return view ('converter.keystore');
   }

   public function createKeystore(Request $request)
   { 

   	if ($request::hasFile('p12')) 
   	{
   		$storagePath = storage_path();

   		$srcstoretype = $request::input('srcstoretype');
   		$password = $request::input('password');
   		$p12 = $request::file('p12');
   		//$srcalias = shell_exec("keytool -v -list -storetype pkcs12 -keystore $p12 2>&1");
   		//dd($srcalias);
   		$dstalias = $request::input('dstalias');
   		//$dstalias = $srcalias;
   		$p12storage = $p12->move($storagePath . '/tmp', $p12 . '.p12');
   	}

        // JKS storage path.
        $jksstorage = storage_path($dstalias . '.jks');

          // Update field 'keystore' in DB.
          //Cert::where('dstalias', $dstalias)->update(['keystore' => $dstalias]);

        $keystore = shell_exec("keytool -importkeystore -deststorepass $password -destkeystore $jksstorage -srckeystore $p12storage -srcstorepass $password -srcstoretype $srcstoretype -noprompt -v 2>&1");


        return view('converter.createKeystore', array(
          'dstalias' => $dstalias,
          'result' => $keystore )
        );
   }

   public function getKeystore()
   {
      if (isset($_POST['dstalias']) && !empty($_POST['dstalias']) );

          $dstalias = $_POST['dstalias'];

          // Update field 'keystore' in DB.
          //Cert::where('dstalias', $dstalias)->update(['keystore' => $dstalias]);

          $headers = array('Content_Type: application/x-download',);
          
        return Response::download(storage_path($dstalias . '.jks'), $dstalias . '.jks', $headers);

   }

}

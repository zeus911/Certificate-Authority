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

            // Check if Cert/Key is available.
            if($keyprint == 'We do not have the key becouse it has been generated in another device.' OR $certprint == 'Do not apply'){
               return view('errors.ooops', array(
               'cn' => $cn,
               'error_details' => 'Can´t create P12 archive. No Certificate or PrivateKey available.'));
            }

            // Certificate parser (SubjectName...)
            $subject = openssl_x509_parse($certprint, true);
            //dd($subject['subject']['CN']);
            $cn = $subject['subject']['CN'];

            // P12 storage path.
            $p12 = storage_path($cn . '.p12');

            // CACert storage path.
            //$cacert = file(storage_path('cert.ca.cer'));
            $cacert = array('-----BEGIN CERTIFICATE-----
MIID+jCCAuKgAwIBAgIDAnEAMA0GCSqGSIb3DQEBCwUAMG0xCzAJBgNVBAYTAkVT
MQ8wDQYDVQQIDAZNYWRyaWQxDzANBgNVBAcMBk1hZHJpZDEPMA0GA1UECgwGVFJB
R1NBMRQwEgYDVQQLDAtUUkFHU0EgQ0EgMTEVMBMGA1UEAwwMVFJBR1NBIENBIEcy
MB4XDTE2MDIwOTE1NTMxN1oXDTQxMDIwMjE1NTMxN1owbTELMAkGA1UEBhMCRVMx
DzANBgNVBAgMBk1hZHJpZDEPMA0GA1UEBwwGTWFkcmlkMQ8wDQYDVQQKDAZUUkFH
U0ExFDASBgNVBAsMC1RSQUdTQSBDQSAxMRUwEwYDVQQDDAxUUkFHU0EgQ0EgRzIw
ggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQChNJLS56VTKsXuOriEe4m8
2Wwc2PMZQ+tLlKbajZerqpXsziXZxsere18XqUEldeWyzZM68WWB0PbNPji5EgnL
69leMpeCX5imB3Bsh/wVxdhQBJFUOlANGAkq5fG9MxzLBTAz/UjBMhMtr0XU00fd
vSir3iWxl2v3ztW0/TZqR1S27Fivqp9ihq7XV4SXYOqyBsZtEuPSqtPQf8i0FP8j
mzmGzO5tzsGsi5UFhrFPFFV537AuTFgzlylIQdWRMFSkrC3UEKsl5ubkcA3rv79G
DYxzP/Brw84nFGzuS/LqGxOs+S45dsthW6wp7x11iLdtFbbmDBUqZFC/CqJdNjSJ
AgMBAAGjgaIwgZ8wHQYDVR0OBBYEFK5n9AgxrpbXgOPNbQZfZbftBKH8MB8GA1Ud
IwQYMBaAFK5n9AgxrpbXgOPNbQZfZbftBKH8MAwGA1UdEwQFMAMBAf8wCwYDVR0P
BAQDAgEGMBEGCWCGSAGG+EIBAQQEAwIBBjAvBgNVHR8EKDAmMCSgIqAghh5odHRw
Oi8vd3d3LnRyYWdzYS5lcy9jYS1nMi5jcmwwDQYJKoZIhvcNAQELBQADggEBACvi
tBYsdkV9lWNygKOn1cCsg+KLjU7/BTszhZ6KvQLBmwOMc8mU/MpWtolCMxyPp4nu
2B5qZfq1F8zVvs+j23XHE2a5HWZLob3msrbT0o4njh7oPk3i1iqwD4UVX7NQf7l9
uyVtOECgjy0WypPGv7/LLcSDhyNvCCRd1lYC4HWemomQip4nwxmMFYVCyomqHotq
XVAH0WcZMUGzQkYSCGlQUVJM8FcfDoZjB11jJPUIM+Kz0hwAaabUrPQVieJLAooc
XlRXg40mdjehEK9dwNMnD2YGGP4vpeyY3/72FJ+RxWwr1yF3p5cmLdY1LIdGBiIf
TXoKcfB8UFRI5KBGbyw=
-----END CERTIFICATE-----
');
            
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
   		$dstalias = $request::input('dstalias');
   		$p12 = $request::file('p12');
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

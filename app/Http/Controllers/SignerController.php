<?php

namespace App\Http\Controllers;

use Request;
use App\Csr; // Makes the model available to the Controller.
use App\Cert;
use Input;
use Zipper;
use File;
use Response;


class SignerController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }


  	public function jar()
   	{
        return view ('signer.jar');     

    }

    public function signJAR(Request $request)
    {
        if ($request::hasFile('jar')) 
    	{
        $storagePath = storage_path();
        $jar = $request::file('jar');
        $storepass = $request::input('password');
        $jar_name = $request::file('jar')->getClientOriginalName();
        $jar_uploaded = $jar->move($storagePath . '/tmp', $jar . '.jar');
    	}

        // Variables to exec jarsigner.
		$keystore = "/opt/keystore/symantec_cs.jks";
		$keystorealias = "grupotragsacs";
		$tsaurl = "http://sha256timestamp.ws.symantec.com/sha256/timestamp"; // Timestamp Server used by Symantec. 

        $jarsigner = shell_exec("jarsigner -tsa $tsaurl -keystore $keystore -storepass 13Safter -signedjar $storagePath/$jar_name.signed $jar_uploaded $keystorealias 2>&1");

        File::delete($jar_uploaded);

        return view ('signer.signJAR', array(
            'jar_name' => $jar_name,
            'result' => $jarsigner )
        );     

    }

    public function getJAR()
   {
      if (isset($_POST['jar_name']) && !empty($_POST['jar_name']) );

          $jar_name = $_POST['jar_name'];

          // Update field 'JAR in DB.
          //Cert::where('dstalias', $dstalias)->update(['keystore' => $dstalias]);

          $headers = array('Content_Type: application/x-download',);
          
        return Response::download(storage_path($jar_name . '.signed'), $jar_name . '.signed', $headers);

   }

    public function authenticode()
   	{

            return view ('signer.authenticode');
    }   

        public function signAuthenticode(Request $request)
    {
        if ($request::hasFile('archive')) 
    	{
        $storagePath = storage_path();
        $archive = $request::file('archive');
        $archive_type = $request::input('archive_type');
        $password = $request::input('password');
        $archive_name = $request::file('archive')->getClientOriginalName();
        $archive_uploaded = $archive->move($storagePath . '/tmp', $archive . $archive_type);
    	}

        // Variables to exec jarsigner.
		$keystore = "/opt/keystore/symantec_cs.p12";
		$keystorealias = "grupotragsacs";
		//$tsaurl = "http://sha256timestamp.ws.symantec.com/sha256/timestamp"; // Timestamp Server used by Symantec (Java). 
    $tsaurl = "http://timestamp.verisign.com/scripts/timstamp.dll"; // Timestamp Server used by Symantec (Authenticode).

        $osslsigncode = shell_exec("osslsigncode sign -pkcs12 $keystore -pass $password -h sha2 -t $tsaurl -in $archive_uploaded -out $storagePath/$archive_name.signed 2>&1");

        File::delete($archive_uploaded);

        return view ('signer.signAuthenticode', array(
            'archive_name' => $archive_name,
            'archive_type' => $archive_type,
            'result' => $osslsigncode )
        );     

    }
     
    public function getAuthenticode(Request $request)
   {
      
          $archive_name = $request::input('archive_name');
          $archive_type = $request::input('archive_type');

          // Update field 'JAR in DB.
          //Cert::where('dstalias', $dstalias)->update(['keystore' => $dstalias]);

          $headers = array('Content_Type: application/x-download',);
          
        return Response::download(storage_path($archive_name . '.signed'), $archive_name . $archive_type, $headers);

   }

   public function search()
   {

   	$archives = File::allFiles(storage_path());
   	//dd($archives);

   	foreach($archives as $archive)
   	{
   		$filename = $archive::filename();
   		echo(string)$filename, "\n";

		return view('signer.search', array('archive' => $filename));
   	}
   }
   public function results(Request $request)
   {

   	$name = $request::input('name');

    return view('signer.results', array('name' => $name));
   }
}
<?php

namespace App\Http\Controllers;

use Request;
use App\Csr; // Makes the model available to the Controller.
use App\Cert;
use Input;
use Zipper;
use File;
use Response;


class GetController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }


  	public function getCSR()
   	{
       if  (isset($_POST['cn']) && !empty($_POST['cn'])) 
       {
            $cn = $_POST['cn'];

            // Check if CN already exists.
            $cn_exists = Cert::where('cn', '=', Request::get('cn'))->first();

            if (isset($cn_exists))
            {
              file_put_contents($cn . '.csr', $cn_exists->csrprint);

              $headers = array('Content_Type: application/x-download');
              return Response::download($cn . '.csr', $cn . '.csr', $headers);

             } else {

              return view ('errors.getCSR');
           }
        
        }

    }

    public function getPublicKey()
   	{
       if  (isset($_POST['cn']) && !empty($_POST['cn'])) 
       {

            $cn = $_POST['cn'];

            // Getting Collection from Certs.
            $certs = Cert::where('cn', $cn)->get()->first();

            // Check if CN already exists.
            $cn_exists = Cert::where('cn', '=', Request::get('cn'))->first();

            // return error page if there is no certificate in DB.
            if ($certs->certprint == 'Do not apply')
            {
              return view ('errors.noCertFound');
            }

            if (isset($cn_exists))
            {
              file_put_contents($cn . '.cer', $cn_exists->certprint);

              $headers = array('Content_Type: application/x-download');
              return Response::download($cn . '.cer', $cn . '.cer', $headers);

             } else {

              return view ('errors.getCert');
           }
        
        }

    }

    public function getPrivateKey()
   	{
       if  (isset($_POST['cn']) && !empty($_POST['cn'])) 
       {

            $cn = $_POST['cn'];

            // Check if CN already exists.
            $cn_exists = Cert::where('cn', '=', Request::get('cn'))->first();

            // Getting Collection from Certs.
            $certs = Cert::where('cn', $cn)->get()->first();

            // return error page if there is no certificate in DB.
            if ($certs->keyprint == 'We do not have the key becouse it has been generated in another device.')
            {
              return view ('errors.noKeyFound');
            }

            if (isset($cn_exists))
            {
              file_put_contents($cn . '.key', $cn_exists->keyprint);

              $headers = array('Content_Type: application/x-download');
              return Response::download($cn . '.key', $cn . '.key', $headers);

             } else {

              return view ('errors.getPrivateKey');
           }
        
        }
    }

    public function getP12()
   	{
  		if  (isset($_POST['cn']) && !empty($_POST['cn'])) 
       	{

            $cn = $_POST['cn'];

            // Check if CN already exists.
            $cn_exists = Cert::where('cn', '=', Request::get('cn'))->first();
            $p12 = $cn_exists->p12;
            if($p12 == 'PFX archive not generated. You have to re-generate it again if you renewed the certificate.')
            {
              //return view ('error.noP12Found');
              return view('errors.noP12Found')->withMessage("Thanks, message has been sent");

            } elseif (isset($cn_exists)) {

              file_put_contents($cn . '.p12', $cn_exists->p12);

              $headers = array('Content_Type: application/x-download');
              return Response::download($cn . '.p12', $cn . '.p12', $headers);

             } else {

              return view ('errors.getP12');
           }
        
        }

    }
}
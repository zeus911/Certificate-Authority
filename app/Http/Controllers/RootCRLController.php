<?php

namespace App\Http\Controllers;

use Request;
use App\Csr; // Makes the model available to the Controller.
use App\Cert;
use Input;
use Zipper;
use File;
use Response;


class RootCRLController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }


  	public function root()
   	{
        return view ('rootcrl.root');     
    }

    public function getRoot()
    {
      $headers = array('Content_Type: application/x-download',);
      return Response::download(storage_path('cert.ca.cer'), 'cert.ca.cer', $headers);

    }

    public function crl()
    {
        return view ('rootcrl.crl');     

    }


    public function updateCRL(Request $request)
    {
        
        $password = $request::input('password');
        $crlPath = storage_path('ca-g2.crl');

        $updateCRL = shell_exec("sudo openssl ca -config /opt/CA/openssl.cnf -gencrl -out $crlPath -key $password -batch 2>&1");


        return view ('rootcrl.updateCRL', array(
            'result' => $updateCRL, )
        );     

    }

    public function getCRL()
    {
      $headers = array('Content_Type: application/x-download',);
      return Response::download(storage_path('ca-g2.crl'), 'ca-g2.crl', $headers);

    }
}
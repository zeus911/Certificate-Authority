<?php

namespace App\Http\Controllers;

use Request;
use App\Cert;


class DashboardController extends Controller
{
    public function index()
    {
        $certs = Cert::all();

        $searchCerts = \Request::get('search');  //the param of URI

        $certs =  Cert::where('cn','like','%'.$searchCerts.'%')
        ->orderBy('id')
        ->paginate('100');

        foreach ($certs as $cert) {
         $id = $cert->id;
         $cn = $cert->cn;

        }

        return view ('dashboard.index', array(
          'certs' => $certs,

          ));
        
    }


    public function search()
 
    {
      if(isset($_POST['cn']) && !empty($_POST['cn'])) {

    	$cn = $_POST['cn'];
      // Getting Collection from Certs.
      $certs = Cert::where('cn', $cn)->get()->first();
      // Getting data from Collection (DB). 
      $id = $certs->id;
      $csrprint = $certs->csrprint;
      $certprint = $certs->certprint;
      $keyprint = $certs->keyprint;
      $p12 = $certs->p12;
      $created_at = $certs->created_at;
      $updated_at = $certs->updated_at;
      
      // Getting x509 Attributes.
      $parse_cert = openssl_x509_parse($certprint);
      $issuer = $parse_cert['issuer'];
      $issuerCN = $issuer['CN'];
      $signatureTypeSN = $parse_cert['signatureTypeSN'];
      //$key_length = $parse_cert['key_length']; // create in DB too.
      $serialNumber = $parse_cert['serialNumber']; // Decimal format by default???
      $serialNumberHex = dechex($parse_cert['serialNumber']); // Hexadecimal format

      $extensions = $parse_cert['extensions'];
      //dd($extensions);
      //$nsCertType = $extensions['nsCertType'];
      $keyUsage = $extensions['keyUsage'];

      // Do not show if certificate dows not have extendedKeyUsage.
      if (empty($extensions['extendedKeyUsage']))
      {
      	$extendedKeyUsage = "Not Available";

      } else {

      	$extendedKeyUsage = $extensions['extendedKeyUsage'];
      }

      // When just CSR/private is created to be signed by an external CA, there is no certificate so I can´t get the data from it.
      if($certprint == 'Do not apply'){
      		return view('dashboard.search', array(
            'cn' => $cn,
            'issuerCN' => 'TRAGSA CA G2 (Only CSR/Key available. Certificate signed by an external CA)',
            //'nsCertType' => $certs->certificate_type,
            'signatureTypeSN' => $certs->digest_alg,
            //'key_length' => $cert->key_length,
            'serialNumber' => 'No Serial',
            'serialNumberHex' => 'No Serial',
            'extensions' => 'No Extensions',
            'keyUsage' => 'No Key Usage',
            'extendedKeyUsage' => 'No  Extended Key Usage',
            'csrprint' => $csrprint,
            'certprint' => $certprint,
            'keyprint' => $keyprint,
            'hasPFX' => $p12,
            'validFrom' => 'No Certificate Available',
            'updated_at' => $updated_at,
            'validTo' => 'No Certificate Available'
 
            ));

     	} else {
        // Check if PFX archive and certificate exist.
        if ($p12 == 'PFX archive not generated. You have to re-generate it again if you renewed the certificate.')
        {
       		$hasPFX = $p12;
          $validFrom = date_create( '@' .  $parse_cert['validFrom_time_t'])->format('c');
          $validTo = date_create( '@' .  $parse_cert['validTo_time_t'])->format('c');

        } else {
          $hasPFX = 'There is a PFX(P12) archive  for: ' . $cn . '. Now you can download it or generate a new one.';
          $validFrom = date_create( '@' .  $parse_cert['validFrom_time_t'])->format('c');
          $validTo = date_create( '@' .  $parse_cert['validTo_time_t'])->format('c');
        }
     	}

      // Check if the certificate has expired.
      //if( $expires_on['validFrom_time_t'] > time() || $expires_on['validTo_time_t'] < time() )
      //print "Certificate is expired.";

        return view('dashboard.search', array(
          'id' => $id,
          'cn' => $cn,
          'issuerCN' => $issuerCN,
          'signatureTypeSN' => $signatureTypeSN,
          //'key_length' => $key_length,
          'serialNumber' => $serialNumber,
          'serialNumberHex' => $serialNumberHex,
          //'nsCertType' => $nsCertType,
          'keyUsage' => $keyUsage,
          'extendedKeyUsage' => $extendedKeyUsage,
          'csrprint' => $csrprint,
          'certprint' => $certprint,
          'keyprint' => $keyprint,
          'p12' => $p12,
          'hasPFX' => $hasPFX,
          'created_at' => $created_at,
          'updated_at' => $updated_at,
          'validFrom' => $validFrom,
          'validTo' => $validTo
          ));
      }
    }

    public function update()
    {
      if(isset($_POST['cn']) && !empty($_POST['cn'])){

      $cn = $_POST['cn'];

      return view('dashboard.update', array(
        'cn' => $cn));
      }
    }  

    public function updated()
    {
      if(isset($_POST['cn']) && isset($_POST['csrprint']) OR isset($_POST['certprint']) OR isset($_POST['keyprint']) &&
        !empty($_POST['cn']) && !empty($_POST['csrprint']) OR !empty($_POST['certprint']) OR !empty($_POST['keyprint'])) {

        $cn = $_POST['cn'];
        $csrprint = $_POST['csrprint'];
        $certprint = $_POST['certprint'];
        $keyprint = $_POST['keyprint'];

        // Getting serial if certprint update.
        $parse_cert = openssl_x509_parse($certprint);
        $serialNumber = $parse_cert['serialNumber'];

        // Update DB with inputs.
        if($csrprint != ''){
        Cert::where('cn', $cn)->update(['csrprint' => $csrprint]);
        }

        if($certprint != ''){
        Cert::where('cn', $cn)->update(['certprint' => $certprint]);
        Cert::where('cn', $cn)->update(['serial' => $serialNumber]);
        }

        if($keyprint != ''){
        Cert::where('cn', $cn)->update(['keyprint' => $keyprint]);
        }

        return view('dashboard.updated', array('cn' => $cn));
      }
    }

}

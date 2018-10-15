<?php

namespace App\Http\Controllers;

use Request;
use App\Cert;
use File;


class MgmtController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $certs = Cert::all();

        $searchCerts = \Request::get('search');  //the param of URI

        $certs =  Cert::where('cn','like','%'.$searchCerts.'%')
        ->orderBy('id')
        ->paginate('200');


        foreach ($certs as $cert) {
         $id = $cert->id;
         $cn = $cert->cn;
         $status = $cert->status;
        }

        return view ('certs.mgmt.index', array(
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
      $status = $certs->status;
      $created_at = $certs->created_at;
      $updated_at = $certs->updated_at;
      
      // Getting x509 Attributes
      $parse_cert = openssl_x509_parse($certprint);
      $issuer = $parse_cert['issuer'];
      $issuerCN = $issuer['CN'];
      $signatureTypeSN = $parse_cert['signatureTypeSN'];
      //$key_length = $parse_cert['key_length']; // create in DB too.
      $serialNumber = $parse_cert['serialNumber']; // Decimal format by default???
      $serialNumberHex = dechex($parse_cert['serialNumber']); // Hexadecimal format
      $extensions = $parse_cert['extensions'];
      // For $san variable: checks if subjuctAltName property is present, otherwise print N/A.
      if (empty($extensions['subjectAltName']))
      {
        $san = "N/A";

      } else {

        $san = $extensions['subjectAltName'];
      }
      //$nsCertType = $extensions['nsCertType'];
      $keyUsage = $extensions['keyUsage'];

      // Do not show if certificate do not have extendedKeyUsage.
      if (empty($extensions['extendedKeyUsage']))
      {
        $extendedKeyUsage = "Not Available";

      } else {

        $extendedKeyUsage = $extensions['extendedKeyUsage'];
      }

      // When just CSR/private is created to be signed by an external CA, there is no certificate so I can´t get the data from it.
      if($certprint == 'Do not apply'){
          return view('certs.mgmt.search', array(
            'cn' => $cn,
            'san' => $san,
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
            'status' => $status,
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

        return view('certs.mgmt.search', array(
          'id' => $id,
          'cn' => $cn,
          'san' => $san,
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
          'status' => $status,
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

      return view('certs.mgmt.update', array(
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

        // When cert is updated has to be replace in public-keys to be monitored.
        if($certprint != ''){
        openssl_x509_export_to_file($certprint, storage_path('public-keys/' . $cn . '.crt'));
        }

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

        return view('certs.mgmt.updated', array('cn' => $cn));
      }
    }

    public function delete()
    {
       if(isset($_POST['cn']) &&
         !empty($_POST['cn'])) {

        $cn = $_POST['cn'];

        return view('certs.mgmt.delete', array('cn' => $cn));
      }
    }

    public function deleted()
    {
       if(isset($_POST['cn']) &&
         !empty($_POST['cn'])) {

        $cn = $_POST['cn'];

        // When cert is DELETED has to be DELETED in public-keys  as well.
        FILE::delete(storage_path('public-keys/' . $cn . '.crt'));
        FILE::delete(storage_path('public-keys/' . $cn . '.cer'));

        // Delete DB table.
        Cert::where('cn', $cn)->delete();
        }
        return view('certs.mgmt.deleted', array('cn' => $cn));
      }

    public function keymatcher()
    {
       if(isset($_POST['cn']) && isset($_POST['csrprint']) && isset($_POST['certprint']) && isset($_POST['keyprint']) && !empty($_POST['cn']) && !empty($_POST['keyprint'])) {

        $cn = $_POST['cn'];
        $csrprint = $_POST['csrprint'];
        $certprint = $_POST['certprint'];
        $keyprint = $_POST['keyprint'];

        // Check if csr/cert/key are in DB.
        if($csrprint != 'No CSR available'){
          $csr_status = 'Found';
        } else {
          $csr_status = 'Can´t find CSR';
        }
        if($certprint != 'Do not apply'){
          $cert_status = 'Found';
        } else {
          $cert_status = 'Can´t find Certificate';
        }
        if($keyprint != 'We do not have the key becouse it has been generated in another device.'){
          $key_status = 'Found';
        } else {
          $key_status = 'Can´t find PrivateKey';
        }     

        // Checks if a private key matches certificate.
        $keyMatchesCert = openssl_x509_check_private_key($certprint, $keyprint);
        //dd($keyMatchesCert);
        if($keyMatchesCert === true){
          $keyMatchesCert = 'YES';
        } else {
          $keyMatchesCert = 'NO';
        }
            $tmp_storage = '/tmp/';
            $_tempcsr = file_put_contents($tmp_storage . 'temp.csr', $csrprint);
            $_tempcer = file_put_contents($tmp_storage . 'temp.cer', $certprint);
            //$_tempkey = file_put_contents($tmp_storage . 'temp.key', $keyprint);

            //dd($_tempcsr, $_tempcer, $_tempkey);

        //$keySHA2sum = shell_exec("openssl pkey -in /tmp/temp.key -pubout -outform pem | sha256sum");
        $certSHA2sum = shell_exec("openssl x509 -in /tmp/temp.cer -pubkey -noout -outform pem | sha256sum"); 
        $csrSHA2sum = shell_exec("openssl req -in /tmp/temp.csr -pubkey -noout -outform pem | sha256sum");

        //dd($cn, $csrSHA2sum, $certSHA2sum);

        if($certSHA2sum === $csrSHA2sum){
          $certMatchesCSR = 'YES';
        } else {
          $certMatchesCSR = 'NO';
        }

        return view('certs.mgmt.keymatcher', array(
          'cn' => $cn,
          'csr_status' => $csr_status,
          'cert_status' => $cert_status,
          'key_status' => $key_status,
          'keyMatchesCert' => $keyMatchesCert,
          'certMatchesCSR' => $certMatchesCSR ));
      }
    }



}

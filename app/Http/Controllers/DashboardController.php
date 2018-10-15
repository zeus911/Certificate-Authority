<?php

namespace App\Http\Controllers;

use App\Cert;
use DB;
use App\Charts\CertsStatus;
use App\Charts\CertsCreated;
use App\Charts\CertsIssuedBy;
use App\Charts\CertsTypes;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        // Total Nº of certificates in DB.
        $certs = Cert::all()->count();

      //// Chart of Total Nº of certificates in DB.
      //   $certsTotal = $certs;
      //   $certsNum = new CertsIssuedBy;
      //   $certsNum->labels(['Nº of Total Cerificates in this CA']); 
      //   $certsNum->dataset('Total Nº', 'bar', [$certs]);

        // Chart Certificates created Monthly, Yearly
        $certs_month = Cert::whereMonth('created_at', date('m'))->count();
        $certs_year = Cert::whereYear('created_at', date('Y'))->count();
        $certs_number_issued = new CertsCreated;
        $certs_number_issued->labels(['This Year', 'This Month']);
        $certs_number_issued->dataset('Nº of Certificates Created In', 'doughnut', [$certs_year, $certs_month])->color(['#0080ff', '#00bfff']);

        // Chart Certificates status.
        $certs_status_blank = Cert::where('status', '=', '')->count();      
        $certs_status_valid = Cert::where('status', '=', 'Valid')->count();
        $certs_status_expiring = Cert::where('status', '=', 'Expiring')->count();      
        $certs_status_expired = Cert::where('status', '=', 'Expired')->count();
        $certs_status_revoked = Cert::where('status', '=', 'Revoked')->count();
        $certs_status = new CertsStatus;
        $certs_status->labels(['N/A', 'Valid', 'Expiring', 'Expired', 'Revoked']);
        $certs_status->dataset('Certificates Status', 'bar', [$certs_status_blank, $certs_status_valid, $certs_status_expiring, $certs_status_expired, $certs_status_revoked])
        ->color(['', '#33cc33', '#ff8000', '#ff0000', '#ff0000']);
        //$certs_status->container($certs_status->lebels = null);

        // Chart Issued by CA
        $certs_year = Cert::whereYear('created_at', date('Y'))->count();
        $certs_issued_by = new CertsIssuedBy;
        $certs_issued_by->labels(['TRAGSA CA G2', 'Firma Profesional', 'DigiCert', 'Symantec', 'Verisign', "Let's Encrypt"]);
        $certs_issued_by->dataset('Nº of Issued By each CA', 'bar', [$certs_year, $certs_month, $certs_year, $certs_month, $certs_month, $certs_month, ])
        ->color(['#ff8000', '#ff8000', '#ff8000', '#ff8000', '#ff8000', '#ff8000']);

        // Chart Certificate types.
        $certs_ssl_tls = Cert::where('certificate_type', '=', 'SSL/TLS Server')->count();
        $certs_client_id = Cert::where('certificate_type', '=', 'ClientID')->count();
        $certs_code_signing = Cert::where('certificate_type', '=', 'CodeSigning')->count();
        $certs_type = new CertsTypes;
        $certs_type->labels(['SSL/TLS', 'Code Signing', 'Client Authentication']);
        $certs_type->dataset('Certificate Types', 'bar', [$certs_ssl_tls, $certs_client_id, $certs_code_signing])->color('#3333ff');



        return view ('dashboard.index', [
          'certsTotal' => $certs,
          //'certsNum' => $certsNum,
          'certs_number_issued' => $certs_number_issued,
          'certs_issued_by' => $certs_issued_by,
          'certs_status' => $certs_status,
          'certs_type' => $certs_type ]);
    }    

}

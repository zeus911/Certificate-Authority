<?php

Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

// Self-Service
Route::get('home', 'HomeController@index');

// Changelog and To Do´s
Route::get('changelog', 'HomeController@changelog');
Route::get('todo', 'HomeController@todo');


// Certs
Route::get('certs/create', 'CertsController@create');
Route::post('certs/created', 'CertsController@created');
Route::post('certs/getP12', 'CertsController@getP12');
Route::post('certs/getCert', 'CertsController@getCert');
Route::post('certs/revokeCert', 'CertsController@revokeCert');

// Certs - Mgmt
Route::get('certs/mgmt', 'MgmtController@index');
Route::post('certs/mgmt/results', 'MgmtController@results');
Route::post('certs/mgmt/search/', 'MgmtController@search');
Route::post('certs/mgmt/viewCSR', [ 'as' => 'viewCSR', 'uses' => 'MgmtController@viewCSR']);
Route::post('certs/mgmt/update', 'MgmtController@update');
Route::post('certs/mgmt/updated', 'MgmtController@updated');
// 
Route::post('certs/mgmt/getCSR', 'GetController@getCSR');
Route::post('certs/mgmt/getPublicKey', 'GetController@getPublicKey');
Route::post('certs/mgmt/getPrivateKey', 'GetController@getPrivateKey');
Route::post('certs/mgmt/getP12', 'GetController@getP12');
//
Route::post('certs/mgmt/renew', 'RenewRevokeController@renew');
Route::post('certs/mgmt/getRenewed', 'RenewRevokeController@getRenewed');
Route::post('certs/mgmt/revoke', 'RenewRevokeController@revoke');
Route::post('certs/mgmt/revoked', 'RenewRevokeController@revoked');

// Generate CSR and Keys.
Route::get('csr/create', 'CsrController@create');
Route::post('csr/created', 'CsrController@created');
Route::post('csr/getCSR', 'CsrController@getCSR');

// Sign external CSRs
Route::get('csr/sign', 'CsrController@sign');
Route::post('csr/signed', 'CsrController@signed');
Route::post('csr/getExtCert', 'CsrController@getExtCert');

// Convert certificates to PFX/P12 or Keystore.
Route::get('converter/p12', 'ConverterController@p12');
Route::post('converter/createP12', 'ConverterController@createP12');
Route::post('converter/storeP12', 'ConverterController@storeP12');
Route::post('converter/getP12', 'ConverterController@getP12');
Route::get('converter/keystore', 'ConverterController@keystore');
Route::post('converter/createKeystore', 'ConverterController@createKeystore');
Route::post('converter/getKeystore', 'ConverterController@getKeystore');

// Dashboard - Search ---- Delete when mgmt is done!..
Route::get('dashboard/index', 'DashboardController@index');
Route::post('dashboard/results', 'DashboardController@results');
Route::post('dashboard/search/', 'DashboardController@search');
Route::post('dashboard/viewCSR', [ 'as' => 'viewCSR', 'uses' => 'DashboardController@viewCSR']);
Route::post('dashboard/update', 'DashboardController@update');
Route::post('dashboard/updated', 'DashboardController@updated');


// GetController - CSR/Cert/Key/P12. ---- Delete when mgmt is done!..
Route::post('dashboard/getCSR', 'GetController@getCSR');
Route::post('dashboard/getPublicKey', 'GetController@getPublicKey');
Route::post('dashboard/getPrivateKey', 'GetController@getPrivateKey');
Route::post('dashboard/getP12', 'GetController@getP12');

// Renew and Revoke Certificates. ---- Delete when mgmt is done!..
Route::post('dashboard/renew', 'RenewRevokeController@renew');
Route::post('dashboard/getRenewed', 'RenewRevokeController@getRenewed');
Route::post('dashboard/revoke', 'RenewRevokeController@revoke');
Route::post('dashboard/revoked', 'RenewRevokeController@revoked');

// JavaARchive signer.
Route::get('signer/jar','SignerController@jar');
Route::post('signer/signJAR','SignerController@signJAR');
Route::post('signer/getJAR','SignerController@getJAR');

// Microsoft Authenticode signer.
Route::get('signer/authenticode','SignerController@authenticode');
Route::post('signer/signAuthenticode','SignerController@signAuthenticode');
Route::post('signer/getAuthenticode','SignerController@getAuthenticode');

// Signer Search/List (JAR/Authenticode).
Route::get('signer/search','SignerController@search');
Route::post('signer/results','SignerController@results');


// Donwload Roots and Update/download CRLs.
Route::get('rootcrl/root','RootCRLController@root');
Route::post('rootcrl/getRoot','RootCRLController@getRoot');
Route::get('rootcrl/crl','RootCRLController@crl');
Route::post('rootcrl/updateCRL','RootCRLController@updateCRL');
Route::post('rootcrl/getCRL','RootCRLController@getCRL');

// Let´s Encrypt WebApp.
Route::get('le/index','LEController@index');
Route::post('le/getCert','LEController@getCert');

// SSL Decoder.
Route::get('ssldecoder/','SSLDecoderController@index');

// [Admin] - Update previously generated CSR with the Certificate signed by an external CA.
Route::get('admin/csr/update', 'AdminCsrController@update');
Route::post('admin/csr/updateCSRWithCertificate', 'AdminCsrController@updateCSRWithCertificate');
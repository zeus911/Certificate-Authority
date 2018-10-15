@extends('layouts.app')

@section('content')

<div class="container">
    <H2>Certificate Key Matcher for: <strong>{{ $cn }}</strong></H2>
    <p class='text-info'>Check whether a private key matches a certificate and/or whether a certificate matches a certificate signing request (CSR).</p>

    <div class="container">
        <h3><i class="fa fa-handshake-o" aria-hidden="true"></i> Private Key Matches Certificate: <strong>{{ $keyMatchesCert }}</strong></h3>

        <h3><i class="fa fa-handshake-o" aria-hidden="true"></i> Certificate Matches CSR: <strong>{{ $certMatchesCSR }}</strong></h3>

        <br />
        <br />

        <h3 class="text-info"><i class="fa fa-database" aria-hidden="true"></i> Info found in DB:</h3>       
        <table class="table">
            <thead>
            <tr>
                <th>CSR</th>
                <th>Certificate</th>
                <th>PrivateKey</th>
<!--                 <th><i class="fa fa-handshake-o" aria-hidden="true"></i> PrivateKey Matches Certificate</th>
                <th><i class="fa fa-handshake-o" aria-hidden="true"></i> Certificate Matches CSR --></th>
            </tr>
            </thead>
            <tbody>
              <tr class="text-info">
                 <td>{{ $csr_status }}</td>
                 <td>{{ $cert_status }}</td>
                 <td>{{ $key_status }}</td>
              </tr>
            </tbody>
        </table>

    </div>

@endsection
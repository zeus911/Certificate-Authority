@extends('layouts.app')

@section('content')

<div class="container">
    <H2 class="text-info">Certificate {{ $cn }} has been succesfully {{ $status2 }}.</H2>
    <H3 class="text-info">Issuer: {{ $issuerCN }}</H3>
    <H4 class="text-success">Status: {{ $status2 }}</H4>

        <div class="container">
        
        <table class="table">
            <thead>
            <tr>
                  <th>Serial</th>
                  <th>Date Issued</th>
                  <th>Expiration date:</th>
                  <th>Revoked date (UTC):</th>
                  <th>Index DB:</th>
                  <th>Reason</th>

            </tr>
            </thead>
            <tbody>
            	<tr>

                  <td>{{ $serial }}</td>
                  <td>{{ $validFrom }}</td>
                  <td>{{ $validTo }}</td>
                  <td>{{ $updated_at }}</td>
                  <td class="text-success"><strong>{{ $status }}</strong></td>
                  <td>$reason</td>
            	</tr>
            </tbody>
        </table>
        </div>
</div>
@endsection
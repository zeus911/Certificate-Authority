@extends('layouts.app')

@section('content')

<div class="container">
    <blockquote>Learn from yesterday, live for today, hope for tomorrow. The important thing is not to stop questioning..</blockquote>
    <H1 class="text-info">Certificate {{ $cn }} has been succesfully {{ $status2 }}.</H1>
    <H2 class="text-info">Issuer: {{ $issuerCN }}</H2>
    <H2 class="text-success">Status: {{ $status2 }}</H2>

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
                  <td>{{ $reason }}</td>
            	</tr>
            </tbody>
        </table>
        </div>
</div>
@endsection
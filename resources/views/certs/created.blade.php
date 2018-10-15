@extends('layouts.app')

@section('content')

<div class="container">
    <H2>You have successfully generated the Certificate.</H2>
    <p class='text-info'>Now, You should download the certificate &amp his Private Key archive.</p>

    <div class="container">
        <h3>Certificate Details:</h3>       
        <table class="table">
            <thead>
            <tr>
                <th>Common Name / SAN</th>
                <th>Certificate Type</th>
                <th>Signature Algorithm</th>
                <th>Key Length</th>
                <th>Serial</th>
                <th>Certificate &amp Private Key</th> 
                
            </tr>
            </thead>
            <tbody>
            <tr class="text-info">
                <td>{{ $cn }}</td>
                <td>{{ $certificate_type }}</td>
                <td>{{ $digest_alg }}</td>
                <td>{{ $key_length }}</td>
                <td>{{ $serial }}</td>
                <td> <!-- // // -->
                {{ Form::open(['url' => 'certs/getCert', 'method' => 'post']) }}
                <input type="hidden" name="cn" value="{{ $cn }}">
                <input type="hidden" name="certificate_type" value="{{ $certificate_type }}">
                <input type="hidden" name="digest_alg" value="{{ $digest_alg }}">
                <input type="hidden" name="serial" value="{{ $serial }}">
                <input type="hidden" name="csrprint" value="{{ $csrprint }}">
                <input type="hidden" name="certprint" value="{{ $certprint }}">
                <input type="hidden" name="keyprint" value="{{ $keyprint }}">
                <input type="hidden" name="p12" value="PFX archive not generated. You have to re-generate it again if you renewed the certificate.">
                <input type="hidden" name="status" value="N/A"> <!-- // This is to populate the columm 'status' in DB. // -->
                {{ form::token() }}
                {{ Form::submit('Create & Get Keypair ', ['class' =>'btn btn-primary btn-md']) }}
                {{ Form::close() }}
                </td>
               
            </tr>

            </tbody>
        </table>
        <H3>Convert to PFX (P12)</H3>
        <p class='text-danger'>To convert it to PFX (P12), click <strong>Create & Get Keypair</strong> button first and then type the passphrase and click <strong>Convert to PFX (P12)</strong> button.</p>
        {{ Form::open(['url' => 'certs/getP12', 'method' => 'post']) }}
        <input type="hidden" name="cn" value="{{ $cn }}">
        <input type="hidden" name="certificate_type" value="{{ $certificate_type }}">
        <input type="hidden" name="digest_alg" value="{{ $digest_alg }}">
        <input type="hidden" name="csrprint" value="{{ $csrprint }}">
        <input type="hidden" name="certprint" value="{{ $certprint }}">
        <input type="hidden" name="keyprint" value="{{ $keyprint }}">
        
        {{ Form::label('password: ', 'Passphrase: ', ['class' => '']) }}
        {{ Form::password('password', ['placeholder' => 'PFX Passphrase', 'class' => 'form-control' ]) }}
            @if($errors->has('password'))
            {{ $errors->first('password') }} 
        @endif     
        <br />
        {{ form::token() }}
        {{ Form::submit('Convert to PFX (P12)', ['class' =>'btn btn-primary btn-md']) }}
        {{ Form::close() }}
        </div>

@endsection
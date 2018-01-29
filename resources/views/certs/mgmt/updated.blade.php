@extends('layouts.app')

@section('content')

<div class="container">

      <h2 class="text-info">You have updated the CSR/Certificate OR Private Key of {{ $cn }}.</h2>
      <br />
      <center><p class="btn btn-default btn-lg"><a href='{{ URL('certs/mgmt') }}'><i class="fa fa-chevron-left" aria-hidden="true"></i> Go back to Management</a></p></center>

      
</div>
@endsection


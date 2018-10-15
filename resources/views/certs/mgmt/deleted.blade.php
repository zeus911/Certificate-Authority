@extends('layouts.app')

@section('content')

<div class="container">
      
      <h2>{{ $cn }} deleted from DB.</h2>
      <center><p class="btn btn-default btn-lg"><a href='{{ URL('certs/mgmt') }}'><i class="fa fa-chevron-left" aria-hidden="true"></i> Go back to Management</a></p></center>

</div>
@endsection

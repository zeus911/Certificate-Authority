@extends('layouts.app_dashboard')
@section('content') 

<div class="container">

  <h1><center>Certificates Dashboard</center></h1>
  <h3 class="text-info"><center>Total Nº of Certificates: <strong class="text-danger"> {{ $certsTotal }}</strong></center></h3>
     
  <!-- // Number of Certificates By CA -->
  <div class="container-fuid">
  	<div class="row">
  		<div class="col-sm-7">
  			{!! $certs_issued_by->container() !!} 
  		</div>
  		<div class="col-md-5 col-sm-5">
  			{!! $certs_number_issued->container() !!}
  		</div>
 		<div class="col-md-5 col-sm-5">
  			{!! $certs_status->container() !!}
  		</div>
  		<div class="col-md-5 col-sm-5">
  			{!! $certs_type->container() !!} 
  		</div>
  	</div>
  </div>	

</div> 
@endsection

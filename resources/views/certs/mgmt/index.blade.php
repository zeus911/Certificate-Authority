@extends('layouts.app')
@section('content') 

<div class="container">

  <h2>Certificates Management</h2>          

    </br>
<table width="100%" class="table dt-responsive nowrap" id="dashboard" cellspacing="0">
      <!--<table id="dashboard" class="table table-bordered table-condensed table-responsive" cellspacing="0" width="100%"> -->
          <thead>
              <tr>
                  <th>ID</th>
                <th>Common Name</th>
                <th>Type</th>
                  <th>Signature</th>
                  <th>Key Length</th>
                  <!-- <th>Serial</th> -->
                <th>Created on</th>
                <th>Status</th>
                  <th></th>
              </tr>
          </thead>
          <tbody>
          @foreach ($certs as $cert)
              <tr class="text-info">
                  <td>{{ $cert->id }}</td>
                <td>{{ $cert->cn }}</td>
                <td>{{ $cert->certificate_type}}</td>
                <td>{{ $cert->digest_alg}}</td>
                  <td>2048</td>
                <!-- <td>{{ $cert->serial }} ( $serialNumberHex )</td> -->
                <td>{{ $cert->created_at }}</td>
                <td>{{ $cert->status }}</td>

                <td>
                    {{ Form::open(['url' => 'certs/mgmt/search/', 'method' => 'post']) }}
                    {{csrf_field()}}
                    <input class="hidden" type="text" name="cn" value="{{ $cert->cn }}"> 
                    @if($errors->has('cn'))
                        {{ $errors->first('cn') }} 
                    @endif
                    <br />
                    {{ Form::token() }}
                    {{ Form::submit('More Details', ['class' => 'btn btn-primary btn-outline btn-md']) }}
                    {{ Form::close() }}
                </td>
                  
              </tr>
          @endforeach

          </tbody>
      </table>

    <br />
<!--     {{ Form::token() }}
    {{ Form::submit('Export to Excel', ['class' => 'btn btn-primary btn-md .disabled']) }}
    {{ Form::close() }}
 -->
    </br>
   </div>
</div>
@endsection

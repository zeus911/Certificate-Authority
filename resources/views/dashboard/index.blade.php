@extends('layouts.app')
@section('content') 

<div class="container">

    <blockquote>Learn from yesterday, live for today, hope for tomorrow. The important thing is not to stop questioning..</blockquote>

			<h2>Certificates Management</h2>

      <div>
          {{ Form::open(['url' => 'dashboard/search/', 'method' => 'post', 'class' => 'navbar-form navbar-left']) }}
          {{csrf_field()}}
          <!--{{ Form::label('Common Name: ', 'Common Name: ', ['class' => '']) }}-->
          <input class="form-control" type="text" name="cn" value="{{ (isset($input['cn'])) ? e($input['cn']) : '' }}" placeholder="Search by full Common Name. Ex. www.domain.com">
             @if($errors->has('cn'))
               {{ $errors->first('cn') }} 
             @endif
          <br />
          {{ Form::token() }}
          {{ Form::close() }}    
      </div>
      
      <table id="dashboard" class="table table-bordered table-condensed table-responsive" cellspacing="0" width="100%">
	        <thead>
	            <tr>
                  <th>ID</th>
	              <th>Common Name</th>
	              <th>Type</th>
                  <th>Signature</th>
                  <th>Key Length</th>
                  <th>Serial</th>
	              <th>Created on</th>
	              <th>Updated</th>
                  <th></th>
	            </tr>
	        </thead>
	        <tbody>
          @foreach ($certs as $cert)
	            <tr>
                  <td>{{ $cert->id }}</td>
	              <td>{{ $cert->cn }}</td>
	              <td>{{ $cert->certificate_type}}</td>
	              <td>{{ $cert->digest_alg}}</td>
                  <td>2048</td>
	              <td>{{ $cert->serial }}</td>
	              <td>{{ $cert->created_at }}</td>
	              <td>{{ $cert->updated_at }}</td>
	              <td>
                    {{ Form::open(['url' => 'dashboard/search/', 'method' => 'post']) }}
                    {{csrf_field()}}
                    <input class="hidden" type="text" name="cn" value="{{ $cert->cn }}"> 
                    @if($errors->has('cn'))
                        {{ $errors->first('cn') }} 
                    @endif
                    <br />
                    {{ Form::token() }}
                    {{ Form::submit('More Details', ['class' => 'btn btn-primary btn-md']) }}
                    {{ Form::close() }}
                  </td>
	                
              </tr>
	        @endforeach

	        </tbody>
	    </table>

    {{ Form::open(['url' => 'dashboard/search/', 'method' => 'post']) }}
    {{csrf_field()}}
    <!--{{ Form::label('Common Name: ', 'Common Name: ', ['class' => '']) }}-->
    <!--<input class="form-control" type="text" name="cn" value="{{ (isset($input['cn'])) ? e($input['cn']) : '' }}" placeholder="Search by CommonName"> -->
    @if($errors->has('cn'))
        {{ $errors->first('cn') }} 
    @endif
    <br />
    {{ Form::token() }}
    {{ Form::submit('Export to Excel', ['class' => 'btn btn-primary btn-md']) }}
    {{ Form::close() }}

    </br>
                    </div>

</div>
@endsection

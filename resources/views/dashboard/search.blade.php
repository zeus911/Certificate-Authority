@extends('layouts.app')

@section('content')

<div class="container">
    <H2>Certificate details for: <strong>{{ $cn }}</strong></H2>
    <H3> Issued by: <strong>{{ $issuerCN }}</strong></H3>
    <p class="text-info"><strong><i class="fa fa-calendar" aria-hidden="true"></i> Valid from: {{ $validFrom }}</strong></p>
    <p class="text-info"><strong><i class="fa fa-calendar" aria-hidden="true"></i> Updated on: {{ $updated_at }}</strong></p>
    <p class="text-info"><strong><i class="fa fa-calendar" aria-hidden="true"></i> Expires on: {{ $validTo }}</strong></p>
    
    <div class="container">
        
        <table class="table">
            <thead>
            <tr>
                  <th>Signature</th>
                  <th>Serial</th>
                  <th>Key Usage</th>
                  <th>Extended Key Usage</th>
                  <th>Request</th>
                  <th>Certificate</th>
                  <th>Private Key</th>
                  <th>PFX</th>
            </tr>
            </thead>
            <tbody>
            <tr class="text-info">

                  <td>{{ $signatureTypeSN }}</td>
                  <td>{{ $serialNumber }} ( {{ $serialNumberHex }} )</td>
                  <td>{{ $keyUsage }}</td>
                  <td>{{ $extendedKeyUsage }}</td>
                  <td><!-- View CSR -->
                  <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal1">View</button>

                    <div id="myModal1" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Certicate Server Request (CSR)</h4>
                          </div>
                          <div class="modal-body">
                            <p>Copy &amp Paste.</p>
                            <pre>{{ $csrprint }}</pre>
                          </div>
                          <div class="modal-footer">
  
                              <!-- // Button to Update CSR in DB. // -->
                            	{{ Form::open(['url' => 'dashboard/update', 'method' => 'post']) }}
    			                    {{csrf_field()}}
    			                    <input class="hidden" type="text" name="cn" value="{{ $cn }}"> 
    			                    @if($errors->has('cn'))
    			                        {{ $errors->first('cn') }} 
    			                    @endif
    			                    <br />
    			                    {{ Form::token() }}
    			                    {{ Form::submit('Update CSR', ['class' => 'btn btn-primary btn-md']) }}
    			                    {{ Form::close() }}
                            	<!-- // End Button to Update in DB. // -->
  
                             	<!-- // Button to download CSR to a file. // -->
                            	{{ Form::open(['url' => 'dashboard/getCSR', 'method' => 'post']) }}
    			                    {{csrf_field()}}
    			                    <input class="hidden" type="text" name="cn" value="{{ $cn }}"> 
    			                    @if($errors->has('cn'))
    			                        {{ $errors->first('cn') }} 
    			                    @endif
    			                    <br />
    			                    {{ Form::token() }}
    			                    {{ Form::submit('Get CSR', ['class' => 'btn btn-primary btn-md']) }}
    			                    {{ Form::close() }}
                            	</br>
                            	<!-- // End Button to download CSR to a file. // -->
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                          </div>
                        </div>

                      </div>
                    </div>
                  </td>
                  <td><!-- View Certificate -->
                  <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal2">View</button>

                    <div id="myModal2" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Certificate (Public Key)</h4>
                          </div>
                          <div class="modal-body">
                            <p>Copy &amp Paste.</p>
                            <pre>{{ $certprint }}</pre>
                          </div>
                          <div class="modal-footer">
                              <!-- // Button to Update CSR in DB. // -->
                              {{ Form::open(['url' => 'dashboard/update', 'method' => 'post']) }}
                              {{csrf_field()}}
                              <input class="hidden" type="text" name="cn" value="{{ $cn }}"> 
                              @if($errors->has('cn'))
                                  {{ $errors->first('cn') }} 
                              @endif
                              <br />
                              {{ Form::token() }}
                              {{ Form::submit('Update PublicKey', ['class' => 'btn btn-primary btn-md']) }}
                              {{ Form::close() }}
                              <!-- // End Button to Update in DB. // -->
  
                              <!-- // Button to download CSR to a file. // -->
                              {{ Form::open(['url' => 'dashboard/getPublicKey', 'method' => 'post']) }}
                              {{csrf_field()}}
                              <input class="hidden" type="text" name="cn" value="{{ $cn }}"> 
                              @if($errors->has('cn'))
                                  {{ $errors->first('cn') }} 
                              @endif
                              <br />
                              {{ Form::token() }}
                              {{ Form::submit('Get Public Key', ['class' => 'btn btn-primary btn-md']) }}
                              {{ Form::close() }}
                              </br>
                              <!-- // End Button to download CSR to a file. // -->

                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                          </div>
                        </div>

                      </div>
                    </div>
                  </td>
                  <td><!-- View Private Key -->
                  <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal3">View</button>

                    <div id="myModal3" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Certificate (Private Key)</h4>
                          </div>
                          <div class="modal-body">
                            <p>Copy &amp Paste.</p>
                            <pre>{{ $keyprint }}</pre>
                          </div>
                          <div class="modal-footer">
                              <!-- // Button to Update CSR in DB. // -->
                              {{ Form::open(['url' => 'dashboard/update', 'method' => 'post']) }}
                              {{csrf_field()}}
                              <input class="hidden" type="text" name="cn" value="{{ $cn }}"> 
                              @if($errors->has('cn'))
                                  {{ $errors->first('cn') }} 
                              @endif
                              <br />
                              {{ Form::token() }}
                              {{ Form::submit('Update Private Key', ['class' => 'btn btn-primary btn-md']) }}
                              {{ Form::close() }}
                              <!-- // End Button to Update in DB. // -->
  
                              <!-- // Button to download CSR to a file. // -->
                              {{ Form::open(['url' => 'dashboard/getPrivateKey', 'method' => 'post']) }}
                              {{csrf_field()}}
                              <input class="hidden" type="text" name="cn" value="{{ $cn }}"> 
                              @if($errors->has('cn'))
                                  {{ $errors->first('cn') }} 
                              @endif
                              <br />
                              {{ Form::token() }}
                              {{ Form::submit('Get Private Key', ['class' => 'btn btn-primary btn-md']) }}
                              {{ Form::close() }}
                              </br>
                              <!-- // End Button to download CSR to a file. // -->

                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                          </div>
                        </div>

                      </div>
                    </div>
                  </td>
                  <td><!-- Show if PFX archive has been generated -->
                  <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal4">View</button>
                    <div id="myModal4" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Personal Information Exchange(PFX)</h4>
                          </div>
                          <div class="modal-body">
                            <p class='text-primary'><strong>{{ $hasPFX }}</strong></p>
                          </div>
                          <div class="modal-footer">
                              <!-- // Button to crete new PFX. // -->
                              {{ Form::open(['url' => 'converter/createP12', 'method' => 'post']) }}
                              {{csrf_field()}}
                              <input class="hidden" type="text" name="cn" value="{{ $cn }}">
                              <input class="hidden" type="text" name="certprint" value="{{ $certprint }}">
                              <input class="hidden" type="text" name="keyprint" value="{{ $keyprint }}">
                              @if($errors->has('certprint'))
                                  {{ $errors->first('certprint') }} 
                              @endif
                              <br />
                              {{ Form::token() }}
                              {{ Form::submit('Create PFX(P12)', ['class' => 'btn btn-primary btn-md']) }}
                              {{ Form::close() }}
                              <!-- // End Button to Update in DB. // -->
  
                              <!-- // Button to download PFX to a file. // -->
                              {{ Form::open(['url' => 'dashboard/getP12', 'method' => 'post']) }}
                              {{csrf_field()}}
                              <input class="hidden" type="text" name="cn" value="{{ $cn }}"> 
                              @if($errors->has('cn'))
                                  {{ $errors->first('cn') }} 
                              @endif
                              <br />
                              {{ Form::token() }}
                              {{ Form::submit('Get PFX(P12)', ['class' => 'btn btn-primary btn-md']) }}
                              {{ Form::close() }}
                              </br>
                              <!-- // End Button to download CSR to a file. // -->

                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                          </div>
                        </div>

                      </div>
                    </div>
                  </td>
</td>
            </tr>
            
            </tbody>
        </table>


        <table class="table">
            <thead>
            <tr>
                  <th></th>
                  <th></th>
                  <th></th>
              </tr>
             </thead>
            <tbody>
            <tr>

                <td><!-- Get Archive PFX(P12) -->
                  {{ Form::open(['url' => 'dashboard/getP12', 'method' => 'post']) }}
                  {{csrf_field()}}
                  <!--{{ Form::label('Common Name: ', 'Common Name: ', ['class' => '']) }}-->
                  <input type="hidden" name="cn" value="{{ $cn }}">
                  @if($errors->has('cn'))
                      {{ $errors->first('cn') }} 
                  @endif
                  {{ Form::token() }}
                  {{ Form::submit('Get PFX(P12)', ['class' => 'btn btn-primary btn-md']) }}
                  {{ Form::close() }}
                </td>
                <td><!-- Create Archive PFX(P12) -->
                  {{ Form::open(['url' => 'converter/createP12', 'method' => 'post']) }}
                  {{csrf_field()}}
                  <!--{{ Form::label('Common Name: ', 'Common Name: ', ['class' => '']) }}-->
                  <input type="hidden" name="cn" value="{{ $cn }}">
                  @if($errors->has('cn'))
                      {{ $errors->first('cn') }} 
                  @endif
                  {{ Form::token() }}
                  {{ Form::submit('Create PFX(P12)', ['class' => 'btn btn-primary btn-md']) }}
                  {{ Form::close() }}
                </td>

                <td><!-- Renew Certificate -->
                  {{ Form::open(['url' => 'dashboard/renew', 'method' => 'post']) }}
                  {{csrf_field()}}
                  <!--{{ Form::label('Common Name: ', 'Common Name: ', ['class' => '']) }}-->
                  <input type="hidden" name="cn" value="{{ $cn }}">
                  <input type="hidden" name="csrprint" value="{{ $csrprint }}">
                  @if($errors->has('cn'))
                      {{ $errors->first('cn') }} 
                  @endif
                  {{ Form::token() }}
                  {{ Form::submit('Renew Certificate', ['class' => 'btn btn-success btn-md']) }}
                  {{ Form::close() }}
				</td>
                <td><!-- Revoke Certificate -->
                  {{ Form::open(['url' => 'dashboard/revoke', 'method' => 'post']) }}
                  {{csrf_field()}}
                  <!--{{ Form::label('Common Name: ', 'Common Name: ', ['class' => '']) }}-->
                  <input type="hidden" name="cn" value="{{ $cn }}">
                  @if($errors->has('cn'))
                      {{ $errors->first('cn') }} 
                  @endif
                  {{ Form::token() }}
                  {{ Form::submit('Revoke Certificate', ['class' => 'btn btn-danger btn-md']) }}
                  {{ Form::close() }}
				</td>

              </tr>
             </tbody>
        	</table>
        </div>

@endsection

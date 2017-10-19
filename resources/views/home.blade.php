@extends('layouts.app')

	@section('content')
<div class="container">

    <blockquote>Learn from yesterday, live for today, hope for tomorrow. The important thing is not to stop questioning...</blockquote>
    
      <h2>Self-Service</h2>
  	<p></p>
  		<ul class="nav nav-pills">
	  			<li class="active"><a data-toggle="pill" href="#certs">Certificates</a></li>
    			<li><a data-toggle="pill" href="#jar">JAR Signer</a></li>
    			<li><a data-toggle="pill" href="#msauth">Microsoft Authenticode</a></li>
    			<li><a data-toggle="pill" href="#rootcrl">Roots / CRL certificates</a></li>
    			<li><a data-toggle="pill" href="#"></a></li>
    			<li><a data-toggle="pill" href="#le">Let's Encrypt Web App</a></li>
  		</ul>
    	<div class="tab-content">
    	
    	<!-- ################################################################## -->
    	<div id="certs" class="tab-pane fade in active">
      	<h3>Certificates</h3>
		  		<p><a href="dashboard/index"><strong>Dashboard</strong></a></p>
				<p><a href="certs/create"><strong>Request New Certificate</strong></a> (Generates CSR,Certificate, Private Key & PFX(Optional))</p>
				<p><a href="csr/create"><strong>Request New CSR</strong></a> (Requests generated to be signed by an external CA.)</p>
				<p><a href="csr/sign"><strong>Sign Certificate Request</strong></a> (Requests generated in an external system.)</p>
				<p><a href="converter/p12"><strong>Convert to P12 / PFX</strong></a> (Creates a PFX archive from Certificate/PrivateKey)</p>
				<p><a href="converter/keystore"><strong>Create Keystore</strong></a></p>
				<!-- <p><a href="dashboard/revoke"><strong>Revoke Certificate</strong></a></p> -->
    	</div>
    	<!-- ################################################################## -->
    	<div id="jar" class="tab-pane fade">  
      	<h3>JAR Signer</h3>
      	<p>Web Interface for OpenSSL running in Laravel Framework with PHP7 and NGINX.</p>
      	<p><a href="signer/jar"><strong>Sign a JAVA Archive</strong></a></p>
				<p><a href=""><strong>Search JAR </strong></a></p>	
    	</div>
    	<!-- ################################################################## -->
    	<div id="msauth" class="tab-pane fade">
      	<h3>Microsoft Authenticode</h3>
      	<p><a href="signer/authenticode"><strong>Sign a Microsoft Archive</strong></a></p>
				<p><a href=""><strong>Search Microsoft Authenticode</strong></a></p>
    	</div>
		<div id="rootcrl" class="tab-pane fade">
      	<h3>Roots / CRL certificates</h3>
      	<p><a href="roots"><strong>Download Roots Certificates</strong></a></p>
				<p><a href="clr"><strong>Update & Download CRL</strong></a></p>
    	</div>
    	<!-- #################################################################### -->
    	<div id="le" class="tab-pane fade">
      	<h3>Let's Encrypt Web App</h3>
         	<p>Web app for having Let's Encrypt signing CSR and returning a public certificate chain.</p>
    	</div>	
    	<!-- #################################################################### -->
      
      </div>
    </div>
</div>
@endsection

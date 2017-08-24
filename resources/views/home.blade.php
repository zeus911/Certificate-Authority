@extends('layouts.app')

@section('content')
<div class="container">

    <blockquote>There are two theories to arguing with a woman. Neither works.</blockquote>
    
      <h2>Pills &amp Resources</h2>
    	<p></p> 
      <ul class="nav nav-pills"> 
    			<li class='active'><a data-toggle="pill" href="#certauth">Cetificate Authority</a></li>
    			<li><a data-toggle="pill" href="#2falatch">2FA + Latch</a></li>
    			<li><a data-toggle="pill" href="#py">Scripts</a></li>
          <li><a data-toggle="pill" href="#git">Github</a></li>
    			<li><a data-toggle="pill" href="#le">Let's Encrypt CSR Signer</a></li>
  		</ul>
    	<div class="tab-content">

    	<!-- ################################################################## -->
    	<div id="certauth" class="tab-pane fade in active">  
      	<h3>Certificate Authority</h3>
      	<p>Management WebApp for Certificate Authority.</p>
      		<p><i class="fa fa-external-link" aria-hidden="true"></i> URL: <a href="https://ca.liquabit.com">ca.liquabit.com</a></p>
          <p><i class="fa fa-github" aria-hidden="true"></i> Github: <a href="https://github.com/lopeaa/Certificate-Authority.git">Certificate Authority Source</a></p>

			<p><strong>Log in with 'Username' instead of 'email' in Laravel Framework.</strong></p>
				<p>In order to log in with 'username' instead of 'email' field, you have to include the field
				 'username' in the database first like this:</br>
				 Edit database/migrations/*_create_users_table.php and include these fields:</br>
				 <code>$table->string('username', 60);</code></br>
         <pre>
Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
	    	$table->string('username', 10);
	    	$table->string('email')->unique();
            $table->string('password'); 
            $table->rememberToken();
            $table->timestamps();
        });
			</pre>
			Then, execute <code>php artisan migrate</code> to create de tables in the DB and <code>php artisan make:auth</code> to create the Login/Register pages.</p>
			<p>Now, you have to modify the pages to include the 'Username' field.</p>
			
    	</div>
    	<!-- ################################################################## -->
		<div id="2falatch" class="tab-pane fade">
      	<h3>2FA + Latch</h3> 
      	<p></p>
    	</div>
    	<!-- ################################################################### -->
    	<div id="py" class="tab-pane fade">
      	<h3>DevOps Scripts</h3>
          <p><i class="fa fa-github" aria-hidden="true"></i>Github: <a href="https://github.com/lopeaa/Scripts.git">Scripts Source</a></p>
    	</div>
    	
    	<!-- #################################################################### -->
      <div id="git" class="tab-pane fade">
        <H3>Github Commands</H3>
        <H4 class="text-info">Clone and Update repos:</H4>
        <code>git clone https://github.com:lopeaa/prototypes.git OR https://github.com:lopeaa/Certificate-Authority.git</code></br>
        <code>git status</code></br>
        <code>git add . OR git add -A</code></br>
        <code>git commit -m "comment"</code></br>
        <code>git push</code></br>
        <H3>Credencials Caching:</H3>
        <code>git config --global credential.helper cache</code></br>
        <code>git config --global credential.helper 'cache --timeout=3600'</code></br>
        <H3>Proxy Configuration:</H3>
        <code>git config --global http.proxy http://user:pass@proxyaddress:port</code></br>
        <code>git config --global --get http.proxy</code></br>
        <code>git config --global --unset http.proxy</code></br>
      </div>
      
      <!-- #################################################################### -->

    	<div id="le" class="tab-pane fade">
      	<h3>Let's Encrypt CSR Signer</h3>
         	<p>Web app for having Let's Encrypt signing CSR and returning a public certificate.</p>
    	</div>	
    	<!-- #################################################################### -->
      
      </div>
    </div>

@endsection
 
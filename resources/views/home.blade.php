@extends('layouts.app')

@section('content')
<div class="container">

    <blockquote>There are two theories to arguing with a woman. Neither works.</blockquote>
    
      <h2>Pills &amp Resources</h2>
  	<p></p>
  		<ul class="nav nav-pills">
    			<li class='active'><a data-toggle="pill" href="#certauth">Cetificate Authority</a></li>
    			<li><a data-toggle="pill" href="#bcapi">BlueCoat API Client </a></li>
    			<li><a data-toggle="pill" href="#2falatch">2FA + Latch</a></li>
    			<li><a data-toggle="pill" href="#py">Python Scripts</a></li>
          <li><a data-toggle="pill" href="#py">Github</a></li>
    			<li><a data-toggle="pill" href="#le">Let's Encrypt Web App</a></li>
  		</ul>
    	<div class="tab-content">

    	<!-- ################################################################## -->
    	<div id="certauth" class="tab-pane fade in active">  
      	<h3>Certificate Authority</h3>
      	<p>Management WebApp for Certificate Authority.</p>
      		<p>URL: <a href="https://ca.liquabit.com"><span class=""></span>ca.liquabit.com</a></p>
          <p>Latest archive: <a href=""><span class=""></span>Prototypes-2017531-19:47:50.tgz</a></p>

			<p><strong>Log in with 'Username' instead of 'email' in Laravel Framework.</strong></p>
				<p>In order to log in with 'username' instead of 'email' field, you have to include the field
				 'username' in the database fist like this:
				 Edit database/migrations/*_create_users_table.php and include these fields:
				 <code>$table->string('username', 60);</code>
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
    	<div id="bcapi" class="tab-pane fade">
      	<h3>BlueCoat API Client</h3>
      	<p></p>
    	</div>
		<div id="2falatch" class="tab-pane fade">
      	<h3>Laravel Framework + 2FA + Latch</h3>
      	<p></p>
    	</div>
    	<!-- ################################################################### -->
    	<div id="py" class="tab-pane fade">
      	<h3>Python Scripts</h3>
      	<p></p>
    	</div>
    	
    	<!-- #################################################################### -->
       <div id="py" class="tab-pane fade">
        <h3>Github</h3>
        <p>Guthub Commands</p>
        <p>git clone git@github.com:lopeaa/prototypes.git OR git@github.com:lopeaa/Certificate-Authority.git</p>
        <p>git status</p>
        <p>git add . OR git add -A</p>
        <p>git commit -m "comment"</p>
        <p>git push</p>
      </div>
      
      <!-- #################################################################### -->

    	<div id="le" class="tab-pane fade">
      	<h3>Let's Encrypt Web App</h3>
         	<p>Web app for having Let's Encrypt signing CSR and returning a public certificate chain.</p>
    	</div>	
    	<!-- #################################################################### -->
      
      </div>
    </div>

@endsection

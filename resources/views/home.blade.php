@extends('layouts.app')

@section('content')

<div class="container"><h1>Bootstrap  tab panel example (using nav-pills)  </h1></div>
<div id="exTab1" class="container"> 
<ul  class="nav nav-pills">
      <li class="active">
        <a  href="#1a" data-toggle="tab">Overview</a>
      </li>
      <li><a href="#2a" data-toggle="tab">Using nav-pills</a>
      </li>
      <li><a href="#3a" data-toggle="tab">Applying clearfix</a>
      </li>
      <li><a href="#4a" data-toggle="tab">Background color</a>
      </li>
    </ul>

      <div class="tab-content clearfix">
        <div class="tab-pane active" id="1a">
          <h3>Content's background color is the same for the tab</h3>
        </div>
        <div class="tab-pane" id="2a">
          <h3>We use the class nav-pills instead of nav-tabs which automatically creates a background color for the tab</h3>
        </div>
        <div class="tab-pane" id="3a">
          <h3>We applied clearfix to the tab-content to rid of the gap between the tab and the content</h3>
        </div>
          <div class="tab-pane" id="4a">
          <h3>We use css to change the background color of the content to be equal to the tab</h3>
        </div>
      </div>
  </div>

<!--  -->

    <blockquote>There are two theories to arguing with a woman. Neither works.</blockquote>
    
      <h2>Pills &amp Resources</h2>
  	<p></p>
  		<ul class="nav nav-pills">
    			<li class='active'><a data-toggle="pill" href="#certauth">Cetificate Authority</a></li>
    			<li><a data-toggle="pill" href="#2falatch">2FA + Latch</a></li>
    			<li><a data-toggle="pill" href="#py">DevOps Scripts</a></li>
          <li><a data-toggle="pill" href="#git">Github</a></li>
    			<li><a data-toggle="pill" href="#le">Let's Encrypt Web App</a></li>
  		</ul>
    	<div class="tab-content">

    	<!-- ################################################################## -->
    	<div id="certauth" class="tab-pane fade in active">  
      	<h3>Certificate Authority</h3>
      	<p>Management WebApp for Certificate Authority.</p>
      		<p>URL: <a href="https://ca.liquabit.com"><span class=""></span>ca.liquabit.com</a></p>
          <p>Github: <a href="https://github.com/lopeaa/Certificate-Authority.git"><span class=""></span>Certificate Authority Source</a></p>

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
      	<h3>Laravel Framework + 2FA + Latch</h3>
      	<p></p>
    	</div>
    	<!-- ################################################################### -->
    	<div id="py" class="tab-pane fade">
      	<h3>DevOps Scripts</h3>
          <p>Github: <a href="https://github.com/lopeaa/Scripts.git"><span class=""></span>Scripts Source</a></p>
    	</div>
    	
    	<!-- #################################################################### -->
       <div id="git" class="tab-pane fade">
        <H3>Github Commands</H3>
        <H4 class="text-info">Clone and Update repos:</H4>
        <code>git clone git@github.com:lopeaa/prototypes.git OR git@github.com:lopeaa/Certificate-Authority.git</code></br>
        <code>git status</code></br>
        <code>git add . OR git add -A</code></br>
        <code>git commit -m "comment"</code></br>
        <code>git push</code></br>
        <H3>Credencials Caching:</H3>
        <code>git config --global credential.helper cache</code></br>
        <code>git config --global credential.helper 'cache --timeout=3600'</code></br>
        <H3>Proxy Configuration:</H3>
        <code>git config --global http.proxy http://user:pass@proxyaddress:port</code>
        <code>git config --global --get http.proxy</code>
        <code>git config --global --unset http.proxy</code>
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

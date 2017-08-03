@extends('layouts.app')

@section('content')
<div class="container">

    <blockquote>There are two theories to arguing with a woman. Neither works.</blockquote>
    
      <h2>Pills &amp Resources</h2>
      <!-- New tabs -->

      <h1>Responsive CSS Tabs</h1>
    <div class="tab_container">
      <input id="tab1" type="radio" name="tabs" checked>
      <label for="tab1"><i class="fa fa-code"></i><span>Code</span></label>

      <input id="tab2" type="radio" name="tabs">
      <label for="tab2"><i class="fa fa-pencil-square-o"></i><span>About</span></label>

      <input id="tab3" type="radio" name="tabs">
      <label for="tab3"><i class="fa fa-bar-chart-o"></i><span>Services</span></label>

      <input id="tab4" type="radio" name="tabs">
      <label for="tab4"><i class="fa fa-folder-open-o"></i><span>Portfolio</span></label>

      <input id="tab5" type="radio" name="tabs">
      <label for="tab5"><i class="fa fa-envelope-o"></i><span>Contact</span></label>

      <section id="content1" class="tab-content">
        <h3>Headline 1</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            
      </section>

      <section id="content2" class="tab-content">
        <h3>Headline 2</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.</p>
          
      </section>

      <section id="content3" class="tab-content">
        <h3>Headline 3</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        
      </section>

      <section id="content4" class="tab-content">
        <h3>Headline 4</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua.</p>
            
      </section>

      <section id="content5" class="tab-content">
        <h3>Headline 5</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.</p>
            
      </section>
    </div>

      <!-- end New tabs -->
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
      	<h3>2FA + Latch</h3>
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

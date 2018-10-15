@extends('layouts.app')

	@section('content')
<div class="container">

	<h2><i class="fa fa-list-alt" aria-hidden="true"></i> Knowledge Base</h2>
	<div class="content">

	<h3><i class="fa fa-cogs" aria-hidden="true"></i> ErrorExceptions:</h3>

	<ul class="text-info">
		<img src="/img/kb/ErrorException1.png">
		<li class="text-info">Check <strong>SubjectAltNames = DNS:</strong> in openssl_serv.cnf.
    	<li class="text-info">Para que "subjectAltName = DNS:" no se corrompa se podría hacer un crontab cada 1 min que limpiase y/o pusiese "DNS:" en el fichero.

    	<img src="/img/kb/ErrorException2.png">
		<li class="text-info">El error sale al intentar renovar el certificado con un CSR obsolto que no tiene "subjectAltName". Para poder generar otro con el mismo CN hay que Revocar el certificado.




	</ul>

	<!-- END CONTENT -->

	</div>
</div>
@endsection

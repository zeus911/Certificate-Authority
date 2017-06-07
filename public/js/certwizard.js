var cn, cert_type, key_size;
function _(x){
	return document.getElementById(x);
}
function processPhase1(){
	cn = _("commonName").value;
    if(cn.length > 2 ){
		_("phase1").style.display = "none";
		_("phase2").style.display = "block";
		_("progressBar").value = 33;
		_("status").innerHTML = "Paso 2 of 3";
	} else {
	    alert("Please fill in the fields");	
	}
}
function processPhase2(){
	cert_type = _("cert_type").value;
	if(cert_type.length > 0){
		_("phase2").style.display = "none";
		_("phase3").style.display = "block";
		_("progressBar").value = 66;
		_("status").innerHTML = "Paso 3 of 3";
	} else {
	    alert("Please choose your gender");	
	}
}
function processPhase3(){
	key_size = _("key_size").value;
	if(key_size.length > 0){
		_("phase3").style.display = "none";
		_("show_all_data").style.display = "block";
		_("display_cn").innerHTML = cn;
		_("display_cert_type").innerHTML = cert_type;
		_("display_key_size").innerHTML = key_size;
        _("progressBar").value = 100;
		_("status").innerHTML = "Certificate Data Overview";
	} else {
	    alert("Please choose your country");
	}
}
	function sendForm(){
	_("multiphase").method = "post";
  _("multiphase").action = "api.php";
  _("multiphase").submit(this.sendForm);
}
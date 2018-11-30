with(document.login){
	onsubmit = function(e){
		e.preventDefault();
		ok = true;
		if(ok && nombre_usuario.value==""){
			ok=false;
			document.getElementById("msg").innerHTML="Escriba el usuario por favor";
			nombre_usuario.focus();
		}
		if(ok && password.value==""){
			ok=false;
			document.getElementById("msg").innerHTML="Escriba su contraseña por favor";
			password.focus();
		}
		if(ok){ submit(); }
	}
}

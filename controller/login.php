<?php

if(!empty($_POST)){
	if(isset($_POST["nombre_usuario"]) &&isset($_POST["password"])){
		if($_POST["nombre_usuario"]!=""&&$_POST["password"]!=""){
			include "conexion.php";
			$user_id=null;
			$nombre=null;
			$tipo=null;
			$usuario=null;
			$password=$_POST["password"];
			$regional=null;
			$email=null;
			$sql1= "SELECT * FROM usuario WHERE usuario=\"$_POST[nombre_usuario]\"  and password=AES_ENCRYPT('$password','nocsis') ";
			$query = $con->query($sql1);
			while ($r=$query->fetch_array()) {
				
				$user_id=$r["ci"];
				$nombres=$r["nombres"];
				$apellidos=$r["apellidos"];
				$sexo=$r["sexo"];
				$tipo=$r["tipo"];
				$usuario=$r["usuario"];
				$regional=$r["regional"];
				$email=$r["email"];
				break;
			}
			if($user_id==null){
				print "<script>window.alert('Datos incorrectos, Por favor intentelo otra vez.');window.location='../index.php';</script>";
			}else{
				if($tipo==0){
					session_start();
				$_SESSION["user_id"]=$user_id;
				$_SESSION["nombres"]=$nombres;
				$_SESSION["apellidos"]=$apellidos;
				$_SESSION["sexo"]=$sexo;
				$_SESSION["tipo"]=$tipo;
				$_SESSION["usuario"]=$usuario;
				$_SESSION["password"]=$password;
				$_SESSION["regional"]=$regional;
				$_SESSION["email"]=$email;
				print "<script>window.location='../views/page_admin.php';</script>";
				}
				else{
					session_start();
				$_SESSION["user_id"]=$user_id;
				$_SESSION["nombres"]=$nombres;
				$_SESSION["apellidos"]=$apellidos;
				$_SESSION["sexo"]=$sexo;
				$_SESSION["tipo"]=$tipo;
				$_SESSION["usuario"]=$usuario;
				$_SESSION["password"]=$password;
				$_SESSION["regional"]=$regional;
				$_SESSION["email"]=$email;
				print "<script>window.location='../views/page_user.php';</script>";
				}			
			}
			
		}
	}
}



?>
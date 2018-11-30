<?php

if(!empty($_POST)){
	if(isset($_POST["ci"]) &&isset($_POST["pass2"])){
		if($_POST["ci"]!=""&&$_POST["pass2"]!=""){
			include "conexion.php";
			$password=$_POST['pass2'];
			$sql2= "UPDATE usuario SET 
			nombres=\"$_POST[nombres]\",
			apellidos=\"$_POST[apellidos]\",
			sexo=\"$_POST[sexo]\",
			email=\"$_POST[email]\",
			fecha_nac=\"$_POST[fecha_nac]\",
			nacionalidad=\"$_POST[nacionalidad]\",
			tipo=\"$_POST[tipo]\",
			regional=\"$_POST[region]\",
			usuario=\"$_POST[usuario]\",
			password=AES_ENCRYPT('$password','nocsis') 
			where ci=\"$_POST[ci]\"";
			$query = $con->query($sql2) or die(mysqli_error($con));
			mysqli_close($con);
			if($query!=null){
				print "<script>alert(\"Datos actualizados correctamente\");window.location='../views/view_user.php';</script>";
			}
			else{
				print "<script>alert(\"Error interno del sistema, consulte con el administrador\");window.location='../views/page_admin.php';</script>";
			}
			}
			else{
				echo "Pasa algo en el tercer if";
			}
		}
		else{
			echo "Pasa algo en el segundo if";
		}
	}
	else{
		echo "Pasa algo en el primer if";
	}


?>
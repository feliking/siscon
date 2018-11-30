<?php

if(!empty($_POST)){
	if(isset($_POST["ci"]) &&isset($_POST["pass2"])){
		if($_POST["ci"]!=""&&$_POST["pass2"]!=""){
			include "conexion.php";
			$password=$_POST['pass2'];
			$sql2= "UPDATE usuario SET 
			usuario=\"$_POST[usuario]\",
			password=AES_ENCRYPT('$password','nocsis') 
			where ci=\"$_POST[ci]\"";
			$query = $con->query($sql2) or die(mysqli_error($con));
			mysqli_close($con);
			if($query!=null){
				session_start();
				session_destroy();
				print "<script>alert(\"Se cambió la contraseña exitosamente, puede identificarse otra vez.\");window.location='../index.php';</script>";
			}
			else{
				print "<script>alert(\"Error interno del sistema, consulte con el administrador\");window.location='../index.php';</script>";
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
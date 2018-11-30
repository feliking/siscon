<?php 
	$tabla="otros_contratos";
	extract($_GET);
	include "conexion.php";
	$sql2= "DELETE FROM $tabla WHERE id_ot=$id";
	$query2 = $con->query($sql2);
	mysqli_close($con);
	if($query2!=null){
			print "<script>alert(\"Contrato de $tabla eliminado exitosamente\");window.location='../views/otros.php';</script>";
	}
	else{
			print "<script>alert(\"Error interno del sistema, consulte con el administrador\");window.location='../views/otros.php';</script>";
	}
?>
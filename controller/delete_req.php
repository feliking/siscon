<?php 
	$tabla="request";
	extract($_GET);
	include "conexion.php";
	$sql= "SELECT cuadro FROM $tabla WHERE id_req=$id";
	$query = $con->query($sql);
	$fila=mysqli_fetch_row($query);
	if ($fila[0]!=null) {
		unlink("../files/cuadro/$fila[0]");
	}
	$sql2= "DELETE FROM $tabla WHERE id_req=$id";
	$query2 = $con->query($sql2);
	mysqli_close($con);
	if($query!=null && $query2!=null){
			print "<script>alert(\"Proveedor eliminado exitosamente\");window.location='../views/principal.php';</script>";
	}
	else{
			print "<script>alert(\"Error interno del sistema, consulte con el administrador\");window.location='../views/principal.php';</script>";
	}
?>
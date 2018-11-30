<?php 
	$tabla="proveedor";
	extract($_GET);
	include "conexion.php";
	$sql= "SELECT archivo FROM $tabla WHERE id_pro=$id";
	$query = $con->query($sql);
	$fila=mysqli_fetch_row($query);
	if ($fila[0]!=null) {
		unlink("../files/proveedor/$fila[0]");
	}
	$sql2= "DELETE FROM $tabla WHERE id_pro=$id";
	$query2 = $con->query($sql2);
	mysqli_close($con);
	if($query!=null && $query2!=null){
			print "<script>alert(\"Proveedor eliminado exitosamente\");window.location='../views/view_proveedor.php';</script>";
	}
	else{
			print "<script>alert(\"Error interno del sistema, consulte con el administrador\");window.location='../views/view_proveedor.php';</script>";
	}
?>
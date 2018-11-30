<?php 
	$tabla="licenpu";
	extract($_GET);
	include "conexion.php";
	$sql= "SELECT respaldo_adosada,respaldo,respaldo_patentes FROM $tabla WHERE id_licenpub=$id";
	$query = $con->query($sql);
	$fila=mysqli_fetch_row($query);
	if (!$fila[0]==null) {
		unlink("../files/licenciapubli/adosada/$fila[0]");
	}
	if (!$fila[1]==null) {
		unlink("../files/licenciapubli/respaldo/$fila[1]");
	}
	if (!$fila[3]==null) {
		unlink("../files/licenciapubli/patentes/$fila[2]");
	}
	$sql2= "DELETE FROM $tabla WHERE id_licenpub=$id";
	$query2 = $con->query($sql2);
	mysqli_close($con);
	if($query!=null && $query2!=null){
			print "<script>alert(\"Contrato de licencia eliminado exitosamente\");window.location='../views/publicidad.php';</script>";
	}
	else{
			print "<script>alert(\"Error interno del sistema, consulte con el administrador\");window.location='../views/publicidad.php';</script>";
	}
?>
<?php 
	session_start();
	  if ($_SESSION['user_id']==null || $_SESSION['tipo']!=0) {
	    print "<script>alert(\"No puede realizar estas acciones como usuario.\");window.location='../views/view_user.php';</script>";
	    exit;
	  }
	$tabla="seguridad";
	extract($_GET);
	include "conexion.php";
	$sql= "SELECT respaldo FROM $tabla WHERE id_segu=$id";
	$query = $con->query($sql);
	$fila=mysqli_fetch_row($query);
	if ($fila[0]!=null) {
		unlink("../files/seguridad/respaldo/$fila[0]");
	}
	$sql2= "DELETE FROM $tabla WHERE id_segu=$id";
	$query2 = $con->query($sql2);
	mysqli_close($con);
	if($query!=null && $query2!=null){
			print "<script>alert(\"Contrato de $tabla eliminado exitosamente\");window.location='../views/seguridad.php';</script>";
	}
	else{
			print "<script>alert(\"Error interno del sistema, consulte con el administrador\");window.location='../views/seguridad.php';</script>";
	}
?>
<?php 
	session_start();
	  if ($_SESSION['user_id']==null || $_SESSION['tipo']!=0) {
	    print "<script>alert(\"No puede realizar estas acciones como usuario.\");window.location='../views/view_user.php';</script>";
	    exit;
	  }
	$tabla="impuestoinmu";
	extract($_GET);
	include "conexion.php";
	$sql2= "DELETE FROM $tabla WHERE id_impin=$id";
	$query2 = $con->query($sql2);
	mysqli_close($con);
	if($query2!=null){
			print "<script>alert(\"Impuesto de inmuebles eliminado exitosamente\");window.location='../views/inmuebles.php';</script>";
	}
	else{
			print "<script>alert(\"Error interno del sistema, consulte con el administrador\");window.location='../views/inmuebles.php';</script>";
	}
?>
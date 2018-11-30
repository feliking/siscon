<?php 
	session_start();
	  if ($_SESSION['user_id']==null || $_SESSION['tipo']!=0) {
	    print "<script>alert(\"No puede realizar estas acciones como usuario.\");window.location='../views/view_user.php';</script>";
	    exit;
	  }
	extract($_GET);
	include "conexion.php";
	$sql= "select folio_real, respaldo from alquiler where id_alqui=$id";
	$query = $con->query($sql);
	$fila=mysqli_fetch_row($query);
	if ($fila[0]!=null) {
		unlink("../files/alquileres/folio_real/$fila[0]");
	}
	if ($fila[1]!=null) {
		unlink("../files/alquileres/respaldo/$fila[1]");
	}
	$sql2= "delete from alquiler where id_alqui=$id";
	$query2 = $con->query($sql2);
	mysqli_close($con);
	if($query!=null && $query2!=null){
			print "<script>alert(\"Contrato de alquiler eliminado exitosamente\");window.location='../views/alquileres.php';</script>";
	}
	else{
			print "<script>alert(\"Error interno del sistema, consulte con el administrador\");window.location='../views/alquileres.php';</script>";
	}
?>
<?php 
  $tabla="nit";
  extract($_GET);
  include "conexion.php";
  $sql= "SELECT respaldo FROM $tabla WHERE id_nit=$id";
  $query = $con->query($sql);
  $fila=mysqli_fetch_row($query);
  if ($fila[0]!=null) {
    unlink("../files/nit/respaldo/$fila[0]");
  }
  $sql2= "DELETE FROM $tabla WHERE id_nit=$id";
  $query2 = $con->query($sql2);
  mysqli_close($con);
  if($query!=null && $query2!=null){
      print "<script>alert(\"Contrato de $tabla eliminado exitosamente\");window.location='../views/nit.php';</script>";
  }
  else{
      print "<script>alert(\"Error interno del sistema, consulte con el administrador\");window.location='../views/nit.php';</script>";
  }
?>
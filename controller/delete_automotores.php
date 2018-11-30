<?php 
  session_start();
    if ($_SESSION['user_id']==null || $_SESSION['tipo']!=0) {
      print "<script>alert(\"No puede realizar estas acciones como usuario.\");window.location='../views/view_user.php';</script>";
      exit;
    }
  $tabla="automoviles";
  extract($_GET);
  include "conexion.php";
  $sql= "SELECT documento_escaneado_ruat,documento_escaneado,respaldo,documentos_de_propiedad FROM $tabla WHERE id_autom=$id";
  $query = $con->query($sql);
  $fila=mysqli_fetch_row($query);
  if ($fila[0]!=null) {
    unlink("../files/impuestoauto/ruat/$fila[0]");
  }
  if ($fila[1]!=null) {
    unlink("../files/impuestoauto/impuesto/$fila[1]");
  }
  if ($fila[2]!=null) {
    unlink("../files/impuestoauto/inspeccion/$fila[2]");
  }
  if ($fila[3]!=null) {
    unlink("../files/impuestoauto/propiedad/$fila[3]");
  }
  $sql2= "DELETE FROM $tabla WHERE id_autom=$id";
  $query2 = $con->query($sql2);
  mysqli_close($con);
  if($query!=null && $query2!=null){
      print "<script>alert(\"Contrato de $tabla eliminado exitosamente\");window.location='../views/automotores.php';</script>";
  }
  else{
      print "<script>alert(\"Error interno del sistema, consulte con el administrador\");window.location='../views/automotores.php';</script>";
  }
?>
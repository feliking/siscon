<?php 
	include "conexion.php";
	$respaldo=null;
	if (!$_FILES['aportacion']['error']==4) {
        if ($_FILES['aportacion']['type']=="image/jpeg"||$_FILES['aportacion']['type']=="image/png"||$_FILES['aportacion']['type']=="image/gif"||$_FILES['aportacion']['type']=="application/pdf") {
          $respaldo=time().$_FILES['aportacion']['name'];
          $origen=$_FILES['aportacion']['tmp_name'];
          $destino="../files/lineastel/aportacion/$respaldo";
          move_uploaded_file($origen,$destino);
        }
        else{
          print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/update_lineas.php?id=$_POST[ide]';</script>";
        }
      }
      else{
        $respaldo=$_POST['docu1'];
      }
      if(isset($_POST['permisos'])){
        $permiso=implode(", ",$_POST['permisos']);
      }
      $sql = "UPDATE lineas SET 
      region=\"$_POST[region]\",
      nombre_regional=\"$_POST[nombre_regional]\",
      numero_linea_externa=\"$_POST[numero_linea_externa]\",
      linea_actual=\"$_POST[numero_linea_actual]\",
      proveedor=\"$_POST[proveedor]\",
      descripcion=\"$_POST[descripcion]\",
      tipo=\"$_POST[tipo]\",
      permisos='$permiso',
      nro_contrato=\"$_POST[numero_contrato]\",
      estado=\"$_POST[propiedad]\",
      categoria=\"$_POST[categoria]\",
      nro_contrato2=\"$_POST[numero_contrato2]\",
      respaldo=\"$_POST[respaldo]\",
      respaldo_aportacion='$respaldo',
      valor_suscripcion=\"$_POST[valor]\"
      WHERE id_line=\"$_POST[ide]\"";
      $query = $con->query($sql);
      if($query!=null){
        print "<script>alert(\"El contrato fue actualizado exitosamente.\");window.location='../views/lineas.php';</script>";
      }
      else{
        echo "algo anda mal en la consulta";
      }
 ?>
<?php 
	include "conexion.php";
	$respaldo=null;
	if (!$_FILES['respaldo']['error']==4) {
        if ($_FILES['respaldo']['type']=="image/jpeg"||$_FILES['respaldo']['type']=="image/png"||$_FILES['respaldo']['type']=="image/gif"||$_FILES['respaldo']['type']=="application/pdf") {
          $respaldo=time().$_FILES['respaldo']['name'];
          $origen=$_FILES['respaldo']['tmp_name'];
          $destino="../files/limpieza/respaldo/$respaldo";
          move_uploaded_file($origen,$destino);
        }
        else{
          print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/update_limpieza.php?id=$_POST[ide]';</script>";
        }
      }
      else{
        $respaldo=$_POST['docu1'];
      }
      if ($_POST['fecha_fin']!=$_POST['fecha']) {
        $sqlc = "UPDATE limpieza SET noti1=0,noti2=0,noti3=0,noti4=0 WHERE id_lim=$_POST[ide]";
        $queryc = $con->query($sqlc);
      }
      $sql = "UPDATE limpieza SET region=\"$_POST[region]\",centro_focal=\"$_POST[centro_focal]\",tipo_centro_focal=\"$_POST[tipo_centro_focal]\",nombre_empresa=\"$_POST[nombre]\",fecha_ini=\"$_POST[fecha_ini]\",fecha_fin=\"$_POST[fecha_fin]\",canon_mensual=\"$_POST[canon_mensual]\",moneda=\"$_POST[moneda]\",respaldo='$respaldo',correo=\"$_POST[correo]\",correo2=\"$_POST[correo1]\" WHERE id_lim=\"$_POST[ide]\"";
      $query = $con->query($sql);
      if($query!=null){
        print "<script>alert(\"El contrato fue actualizado exitosamente.\");window.location='../views/limpieza.php';</script>";
      }
      else{
        echo "algo anda mal en la consulta";
      }
 ?>
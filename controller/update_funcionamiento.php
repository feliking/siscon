<?php 
	include "conexion.php";
	$respaldo=null;
	if (!$_FILES['respaldo']['error']==4) {
        if ($_FILES['respaldo']['type']=="image/jpeg"||$_FILES['respaldo']['type']=="image/png"||$_FILES['respaldo']['type']=="image/gif"||$_FILES['respaldo']['type']=="application/pdf") {
          $respaldo=time().$_FILES['respaldo']['name'];
          $origen=$_FILES['respaldo']['tmp_name'];
          $destino="../files/licenciafun/respaldo/$respaldo";
          move_uploaded_file($origen,$destino);
        }
        else{
          print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/update_funcionamiento.php?id=$_POST[ide]';</script>";
        }
      }
      else{
        $respaldo=$_POST['docu1'];
      }
      $respaldo_patentes=null;
          if (!$_FILES['respaldo_patentes']['error']==4) {
            if ($_FILES['respaldo_patentes']['type']=="image/jpeg"||$_FILES['respaldo_patentes']['type']=="image/png"||$_FILES['respaldo_patentes']['type']=="image/gif"||$_FILES['respaldo_patentes']['type']=="application/pdf") {
              $respaldo_patentes=time().$_FILES['respaldo_patentes']['name'];
              $origen3=$_FILES['respaldo_patentes']['tmp_name'];
              $destino3="../files/licenciafun/patentes/$respaldo_patentes";
              move_uploaded_file($origen3,$destino3);
            }
            else{
              print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/update_funcionamiento.php?id=$_POST[ide]';</script>";
            }
          }
          else{
            $respaldo_patentes="docu2";
          }
      $sql = "UPDATE licenciafun SET 
      region=\"$_POST[region]\",
      centro_focal=\"$_POST[centro_focal]\",
      tipo_centro_focal=\"$_POST[tipo_centro_focal]\",
      fecha_ini=\"$_POST[fecha_ini]\",
      fecha_fin=\"$_POST[fecha_fin]\",
      respaldo='$respaldo',
      pago_patentes=\"$_POST[pago_patentes]\",
      respaldo_patentes='$respaldo_patentes'
      WHERE id_licfu=\"$_POST[ide]\"";
      $query = $con->query($sql);
      if($query!=null){
        print "<script>alert(\"El contrato fue actualizado exitosamente.\");window.location='../views/funcionamiento.php';</script>";
      }
      else{
        echo "algo anda mal en la consulta";
      }
 ?>
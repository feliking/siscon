<?php 
	include "conexion.php";
	$respaldo=null;
	if (!$_FILES['respaldo']['error']==4) {
        if ($_FILES['respaldo']['type']=="image/jpeg"||$_FILES['respaldo']['type']=="image/png"||$_FILES['respaldo']['type']=="image/gif"||$_FILES['respaldo']['type']=="application/pdf") {
          $respaldo=time().$_FILES['respaldo']['name'];
          $origen=$_FILES['respaldo']['tmp_name'];
          $destino="../files/licenciapubli/adosada/$respaldo";
          move_uploaded_file($origen,$destino);
        }
        else{
          print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/update_publicidad.php?id=$_POST[ide]';</script>";
        }
      }
      else{
        $respaldo=$_POST['docu1'];
      }
      $archivo=null;
  if (!$_FILES['archivo']['error']==4) {
        if ($_FILES['archivo']['type']=="image/jpeg"||$_FILES['archivo']['type']=="image/png"||$_FILES['archivo']['type']=="image/gif"||$_FILES['archivo']['type']=="application/pdf") {
          $archivo=time().$_FILES['archivo']['name'];
          $origen2=$_FILES['archivo']['tmp_name'];
          $destino2="../files/licenciapubli/respaldo/$archivo";
          move_uploaded_file($origen2,$destino2);
        }
        else{
          print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/update_publicidad.php?id=$_POST[ide]';</script>";
        }
      }
      else{
        $archivo=$_POST['docu2'];
      }
      $respaldo_patentes=null;
          if (!$_FILES['respaldo_patentes']['error']==4) {
            if ($_FILES['respaldo_patentes']['type']=="image/jpeg"||$_FILES['respaldo_patentes']['type']=="image/png"||$_FILES['respaldo_patentes']['type']=="image/gif"||$_FILES['respaldo_patentes']['type']=="application/pdf") {
              $respaldo_patentes=time().$_FILES['respaldo_patentes']['name'];
              $origen3=$_FILES['respaldo_patentes']['tmp_name'];
              $destino3="../files/licenciapubli/patentes/$respaldo_patentes";
              move_uploaded_file($origen3,$destino3);
            }
            else{
              print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/update_publicidad.php?id=$_POST[ide]';</script>";
            }
          }
          else{
            $respaldo_patentes="docu3";
          }
      $sql = "UPDATE licenpu SET 
      region=\"$_POST[region]\",
      centro_focal=\"$_POST[centro_focal]\",
      licencia_publicidad=\"$_POST[cuenta]\",
      letreros=\"$_POST[adosada]\",
      vigencia_letreros=\"$_POST[vigencia]\",
      respaldo_adosada='$respaldo',
      pintada=\"$_POST[pintada]\",
      microperforadora=\"$_POST[microperforadora]\",
      autopartes=\"$_POST[autoportantes]\",
      fecha_emsion=\"$_POST[fecha_ini]\",
      fecha_vencimiento=\"$_POST[fecha_fin]\",
      respaldo='$archivo',
      observaciones=\"$_POST[observaciones]\",
      pago_patentes=\"$_POST[pago_patentes]\",
      respaldo_patentes='$respaldo_patentes'
      WHERE id_licenpub=\"$_POST[ide]\"";
      $query = $con->query($sql);
      if($query!=null){
        print "<script>alert(\"El contrato fue actualizado exitosamente.\");window.location='../views/publicidad.php';</script>";
      }
      else{
        echo "algo anda mal en la consulta";
      }
 ?>
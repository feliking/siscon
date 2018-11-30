<?php 
	include "conexion.php";
  
	   $ruat=null;
	   if (!$_FILES['ruat']['error']==4) {
        if ($_FILES['ruat']['type']=="image/jpeg"||$_FILES['ruat']['type']=="image/png"||$_FILES['ruat']['type']=="image/gif"||$_FILES['ruat']['type']=="application/pdf") {
          $ruat=time().$_FILES['ruat']['name'];
          $origen=$_FILES['ruat']['tmp_name'];
          $destino="../files/impuestoauto/ruat/$ruat";
          move_uploaded_file($origen,$destino);
        }
        else{
          print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/update_automotores.php?id=$_POST[ide]';</script>";
        }
      }
      else{
          $ruat=$_POST['docu1'];
      }
      $impuesto=null;
     if (!$_FILES['impuesto']['error']==4) {
        if ($_FILES['impuesto']['type']=="image/jpeg"||$_FILES['impuesto']['type']=="image/png"||$_FILES['impuesto']['type']=="image/gif"||$_FILES['impuesto']['type']=="application/pdf") {
          $impuesto=time().$_FILES['impuesto']['name'];
          $origen1=$_FILES['impuesto']['tmp_name'];
          $destino1="../files/impuestoauto/impuesto/$impuesto";
          move_uploaded_file($origen1,$destino1);
        }
        else{
          print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/update_automotores.php?id=$_POST[ide]';</script>";
        }
      }
      else{
        $impuesto=$_POST['docu2'];
      }
      $inspect=null;
     if (!$_FILES['inspect']['error']==4) {
        if ($_FILES['inspect']['type']=="image/jpeg"||$_FILES['inspect']['type']=="image/png"||$_FILES['inspect']['type']=="image/gif"||$_FILES['inspect']['type']=="application/pdf") {
          $inspect=time().$_FILES['inspect']['name'];
          $origen2=$_FILES['inspect']['tmp_name'];
          $destino2="../files/impuestoauto/inspeccion/$inspect";
          move_uploaded_file($origen2,$destino2);
        }
        else{
          print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/update_automotores.php?id=$_POST[ide]';</script>";
        }
      }
      else{
        $inspect=$_POST['docu3'];
      }
      $docprop=null;
     if (!$_FILES['docprop']['error']==4) {
        if ($_FILES['docprop']['type']=="image/jpeg"||$_FILES['docprop']['type']=="image/png"||$_FILES['docprop']['type']=="image/gif"||$_FILES['docprop']['type']=="application/pdf") {
          $docprop=time().$_FILES['docprop']['name'];
          $origen3=$_FILES['docprop']['tmp_name'];
          $destino3="../files/impuestoauto/propiedad/$docprop";
          move_uploaded_file($origen3,$destino3);
        }
        else{
          print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/update_automotores.php?id=$_POST[ide]';</script>";
        }
      }
      else{
        $docprop=$_POST['docu4'];
      }
      $sql = "UPDATE automoviles SET 
            propietario=\"$_POST[propietario]\",
            tipo=\"$_POST[tipo]\",
            marca=\"$_POST[marca]\",
            modelo=\"$_POST[modelo]\",
            placa=\"$_POST[placa]\",
            ano=\"$_POST[ano]\",
            motor=\"$_POST[motor]\",
            chasis=\"$_POST[chasis]\",
            color=\"$_POST[color]\",
            plaza_circulacion=\"$_POST[plaza]\",
            nro_ocupantes=\"$_POST[ocupantes]\",
            valor_comercial=\"$_POST[valor]\",
            documentos_propiedad=\"$_POST[docuprop]\",
            documento_escaneado_ruat='$ruat',
            pago_impuestos=\"$_POST[pagovig]\",
            documento_escaneado='$impuesto',
            observaciones=\"$_POST[obser]\",
            comodato=\"$_POST[comodato]\",
            monto=\"$_POST[montopagado]\",
            poliza=\"$_POST[poliza]\",
            otros_documentos=\"$_POST[otros]\",
            inspeccion_vehicular=\"$_POST[inspec]\",
            respaldo='$inspect',
            fecha_extintor=\"$_POST[fecha_extintor]\",
            fecha_vigencia=\"$_POST[vigext]\",
            triangulo=\"$_POST[triangulo]\",
            herramientas=\"$_POST[tools]\",
            documentos_de_propiedad='$docprop'
      WHERE id_autom=\"$_POST[ide]\"";
      $query = $con->query($sql);
      if($query!=null){
        print "<script>alert(\"El contrato fue actualizado exitosamente.\");window.location='../views/automotores.php';</script>";
      }
      else{
        echo "algo anda mal en la consulta";
      }
 ?>
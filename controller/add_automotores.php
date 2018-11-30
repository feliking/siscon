<?php
if(!empty($_POST)){
	if(isset($_POST["propietario"]) && isset($_POST["tipo"]) && isset($_POST["marca"]) && isset($_POST["modelo"]) && isset($_POST["placa"]) && isset($_POST["ano"]) && isset($_POST["motor"]) && isset($_POST["chasis"]) && isset($_POST["color"]) && isset($_POST["ide"])){
		if($_POST["ide"]!=""){
			include "conexion.php";
			$found=false;
			if($_POST["propietario"]==null){
				print "<script>alert(\"No introdució el propietario.\");window.location='../views/add_automotores.php';</script>";
			}
			else{
			$ruat=null;
	   if (!$_FILES['ruat']['error']==4) {
        if ($_FILES['ruat']['type']=="image/jpeg"||$_FILES['ruat']['type']=="image/png"||$_FILES['ruat']['type']=="image/gif"||$_FILES['ruat']['type']=="application/pdf") {
          $ruat=time().$_FILES['ruat']['name'];
          $origen=$_FILES['ruat']['tmp_name'];
          $destino="../files/impuestoauto/ruat/$ruat";
          move_uploaded_file($origen,$destino);
        }
        else{
          print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/add_automotores.php;</script>";
        }
      }
      else{
          $ruat="";
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
          print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/add_automotores.php;</script>";
        }
      }
      else{
        $impuesto="";
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
          print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/add_automotores.php;</script>";
        }
      }
      else{
        $inspect="";
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
          print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/add_automotores.php;</script>";
        }
      }
      else{
        $docprop="";
      }
      if ($_POST['valor']=="") {
        $_POST['valor']==0;
      }
      if ($_POST['montopagado']=="") {
        $_POST['montopagado']==0;
      }
			$sql = "insert into automoviles(propietario,tipo,marca,modelo,placa,ano,motor,chasis,color,plaza_circulacion,nro_ocupantes,valor_comercial,documentos_propiedad,documento_escaneado_ruat,pago_impuestos,documento_escaneado,observaciones,comodato,monto,poliza,otros_documentos,inspeccion_vehicular,respaldo,fecha_extintor,fecha_vigencia,triangulo,herramientas,documentos_de_propiedad,responsable) values (\"$_POST[propietario]\",\"$_POST[tipo]\",\"$_POST[marca]\",\"$_POST[modelo]\",\"$_POST[placa]\",\"$_POST[ano]\",\"$_POST[motor]\",\"$_POST[chasis]\",\"$_POST[color]\",\"$_POST[plaza]\",\"$_POST[ocupantes]\",\"$_POST[valor]\",\"$_POST[docuprop]\",'$ruat',\"$_POST[pagovig]\",'$impuesto',\"$_POST[obser]\",\"$_POST[comodato]\",\"$_POST[montopagado]\",\"$_POST[poliza]\",\"$_POST[otros]\",\"$_POST[inspec]\",'$inspect',\"$_POST[fecha_extintor]\",\"$_POST[vigext]\",\"$_POST[triangulo]\",\"$_POST[tools]\",'$docprop',\"$_POST[ide]\")";
      
      if ($_POST['fecha_extintor']=="") {
        $sql = "insert into automoviles(propietario,tipo,marca,modelo,placa,ano,motor,chasis,color,plaza_circulacion,nro_ocupantes,valor_comercial,documentos_propiedad,documento_escaneado_ruat,pago_impuestos,documento_escaneado,observaciones,comodato,monto,poliza,otros_documentos,inspeccion_vehicular,respaldo,fecha_vigencia,triangulo,herramientas,documentos_de_propiedad,responsable) values (\"$_POST[propietario]\",\"$_POST[tipo]\",\"$_POST[marca]\",\"$_POST[modelo]\",\"$_POST[placa]\",\"$_POST[ano]\",\"$_POST[motor]\",\"$_POST[chasis]\",\"$_POST[color]\",\"$_POST[plaza]\",\"$_POST[ocupantes]\",\"$_POST[valor]\",\"$_POST[docuprop]\",'$ruat',\"$_POST[pagovig]\",'$impuesto',\"$_POST[obser]\",\"$_POST[comodato]\",\"$_POST[montopagado]\",\"$_POST[poliza]\",\"$_POST[otros]\",\"$_POST[inspec]\",'$inspect',\"$_POST[vigext]\",\"$_POST[triangulo]\",\"$_POST[tools]\",'$docprop',\"$_POST[ide]\")";
      }
			$query = $con->query($sql);
			if($query!=null){
				print "<script>alert(\"El contrato fue registrado exitosamente.\");window.location='../views/add_automotores.php';</script>";
				mysqli_close($con);
			}
			else{
				echo "Hay problemas con la consulta";
			}
			}
		}
		else{
			echo "Hay probelmas en el tercer if";
		}
	}
	else{
		echo "Hay problemas en el segundo if";
	}
}
else{
	echo "Hay problemas en el primer if";
}
?>
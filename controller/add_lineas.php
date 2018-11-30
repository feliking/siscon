<?php
if(!empty($_POST)){
	if(isset($_POST["nombre_regional"]) && isset($_POST["numero_linea_externa"]) && isset($_POST["proveedor"]) && isset($_POST["descripcion"]) && isset($_POST["tipo"]) && isset($_POST["propiedad"]) && isset($_POST["categoria"]) && isset($_POST["numero_contrato2"]) && isset($_POST["respaldo"]) && isset($_POST["ide"])){
		if($_POST["ide"]!=""){
			include "conexion.php";
			$found=false;
			if($_POST["ide"]==null){
				print "<script>alert(\"No se encuentra identificado, por favor identifiquese\");window.location='../index.php';</script>";
			}
			else{
				if(isset($_POST['permisos'])){
					$permiso=implode(", ",$_POST['permisos']);
				}
				$respaldo=null;
				if (!$_FILES['aportacion']['error']==4) {
			        if ($_FILES['aportacion']['type']=="image/jpeg"||$_FILES['aportacion']['type']=="image/png"||$_FILES['aportacion']['type']=="image/gif"||$_FILES['aportacion']['type']=="application/pdf") {
			          $respaldo=time().$_FILES['aportacion']['name'];
			          $origen=$_FILES['aportacion']['tmp_name'];
			          $destino="../files/lineastel/aportacion/$respaldo";
			          move_uploaded_file($origen,$destino);
			        }
			        else{
			          print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/add_lineas.php;</script>";
			        }
			      }
			      else{
			        $respaldo="";
			      }
			if ($_POST['valor']=="") {
				$_POST['valor']==0;
			} 
			
			$sql = "insert into lineas(region,nombre_regional,numero_linea_externa,linea_actual,proveedor,descripcion,tipo,permisos,nro_contrato,estado,categoria,nro_contrato2,respaldo,respaldo_aportacion,valor_suscripcion,responsable) values (\"$_POST[region]\",\"$_POST[nombre_regional]\",\"$_POST[numero_linea_externa]\",\"$_POST[numero_linea_actual]\",\"$_POST[proveedor]\",\"$_POST[descripcion]\",\"$_POST[tipo]\",'$permiso',\"$_POST[numero_contrato]\",\"$_POST[propiedad]\",\"$_POST[categoria]\",\"$_POST[numero_contrato2]\",\"$_POST[respaldo]\",'$respaldo',\"$_POST[valor]\",\"$_POST[ide]\")";
			$query = $con->query($sql);
			if($query!=null){
				print "<script>alert(\"El contrato fue registrado exitosamente.\");window.location='../views/add_lineas.php';</script>";
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
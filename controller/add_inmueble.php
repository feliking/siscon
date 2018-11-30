<?php
if(!empty($_POST)){
	if(isset($_POST["region"]) && isset($_POST["contable"]) && isset($_POST["direccion"]) && isset($_POST["nro_inmu"]) && isset($_POST["descripcion"]) && isset($_POST["valor"]) && isset($_POST["vigente"]) && isset($_POST["gestion"]) && isset($_POST["envio"]) && isset($_POST["obs"]) && isset($_POST["pago"]) && isset($_POST["ide"])){
		if($_POST["ide"]!=""){
			include "conexion.php";
			$found=false;
			if($_POST["ide"]==null){
				print "<script>alert(\"No esta identificado, por favor identifiquese con el sistema.\");window.location='../views/add_inmueble.php';</script>";
			}
			else{
			if ($_POST['valor']=="") {
				$_POST['valor']==0;
			}
			if ($_POST['pago']=="") {
				$_POST['pago']==0;
			}
			$sql = "insert into impuestoinmu(region,contable,direccion,numero_inmuebles,descripcion_inmuebles,valor_inicial,pago_vigente,gestion,documento_escaneado,observaciones,impuestos_municipales,responsable) values (\"$_POST[region]\",\"$_POST[contable]\",\"$_POST[direccion]\",\"$_POST[nro_inmu]\",\"$_POST[descripcion]\",\"$_POST[valor]\",\"$_POST[vigente]\",\"$_POST[gestion]\",\"$_POST[envio]\",\"$_POST[obs]\",\"$_POST[pago]\",\"$_POST[ide]\")";
			$query = $con->query($sql);
			if($query!=null){
				print "<script>alert(\"El contrato fue registrado exitosamente.\");window.location='../views/add_inmueble.php';</script>";
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
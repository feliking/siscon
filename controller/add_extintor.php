<?php
if(!empty($_POST)){
	if(isset($_POST["region"]) && isset($_POST["centro_focal"]) && isset($_POST["tipo_extin"])&& isset($_POST["tipo_extin2"]) && isset($_POST["ubicacion"]) && isset($_POST["peso"])&&isset($_POST["fecha_ini"]) && isset($_POST["fecha_fin"]) && isset($_POST["nro_extintor"]) && isset($_POST["ide"])){
		if($_POST["ide"]!=""){
			include "conexion.php";
			$found=false;
			if($_POST["fecha_ini"]>$_POST["fecha_fin"]){
				print "<script>alert(\"Revise las fechas, la fecha de caducidad es mayor a la de recarga.\");window.location='../views/add_extintor.php';</script>";
			}
			else{
			$sql = "insert into extintores(region,tipo_region,tipo_extin,tipo_extin2,ubicacion,peso,fecha_recarga,fecha_valida,nro_extintor,responsable) values (\"$_POST[region]\",\"$_POST[centro_focal]\",\"$_POST[tipo_extin]\",\"$_POST[tipo_extin2]\",\"$_POST[ubicacion]\",\"$_POST[peso]\",\"$_POST[fecha_ini]\",\"$_POST[fecha_fin]\",\"$_POST[nro_extintor]\",\"$_POST[ide]\")";
			if ($_POST['fecha_ini']=="" && $_POST['fecha_fin']=="") {
				$sql = "insert into extintores(region,tipo_region,tipo_extin,tipo_extin2,ubicacion,peso,nro_extintor,responsable) values (\"$_POST[region]\",\"$_POST[centro_focal]\",\"$_POST[tipo_extin]\",\"$_POST[tipo_extin2]\",\"$_POST[ubicacion]\",\"$_POST[peso]\",\"$_POST[nro_extintor]\",\"$_POST[ide]\")";
			}
			if ($_POST['fecha_fin']=="" && !$_POST['fecha_ini']=="") {
				$sql = "insert into extintores(region,tipo_region,tipo_extin,tipo_extin2,ubicacion,peso,fecha_recarga,nro_extintor,responsable) values (\"$_POST[region]\",\"$_POST[centro_focal]\",\"$_POST[tipo_extin]\",\"$_POST[tipo_extin2]\",\"$_POST[ubicacion]\",\"$_POST[peso]\",\"$_POST[fecha_ini]\",\"$_POST[nro_extintor]\",\"$_POST[ide]\")";
			}
			if (!$_POST['fecha_fin']=="" && $_POST['fecha_ini']=="") {
				$sql = "insert into extintores(region,tipo_region,tipo_extin,tipo_extin2,ubicacion,peso,fecha_valida,nro_extintor,responsable) values (\"$_POST[region]\",\"$_POST[centro_focal]\",\"$_POST[tipo_extin]\",\"$_POST[tipo_extin2]\",\"$_POST[ubicacion]\",\"$_POST[peso]\",\"$_POST[fecha_fin]\",\"$_POST[nro_extintor]\",\"$_POST[ide]\")";
			}
			$query = $con->query($sql);
			if($query!=null){
				print "<script>alert(\"El contrato fue registrado exitosamente.\");window.location='../views/add_extintor.php';</script>";
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
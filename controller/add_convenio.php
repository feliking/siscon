<?php
if(!empty($_POST)){
	if(isset($_POST["region"]) && isset($_POST["nombre"]) && isset($_POST["cuenta"]) && isset($_POST["fecha_ini"]) && isset($_POST["fecha_fin"]) && isset($_POST["costo"]) && isset($_POST["observacion"])&& isset($_POST["ide"])){
		if($_POST["region"]!=""&& $_POST["nombre"]!=""&&$_POST["cuenta"]!=""&&$_POST["fecha_ini"]!=""&&$_POST["fecha_fin"]!=""&& $_POST["costo"]!=""&& $_POST["observacion"]!=""&&$_POST["ide"]!=""){
			include "conexion.php";
			$found=false;
			if($_POST["fecha_ini"]>$_POST["fecha_fin"]){
				print "<script>alert(\"Revise las fechas, la fecha de inicio es mayor a la del final.\");window.location='../views/add_convenio.php';</script>";
			}
			else{
			$respaldo=time().'.jpg';
			$sql = "insert into convenio(region,nombre_empresa,cuanta,respaldo,fecha_emision,fecha_vencimiento,costo,observacion,responsable) values (\"$_POST[region]\",\"$_POST[nombre]\",\"$_POST[cuenta]\",'$respaldo',\"$_POST[fecha_ini]\",\"$_POST[fecha_fin]\",\"$_POST[costo]\",\"$_POST[observacion]\",\"$_POST[ide]\")";
			$query = $con->query($sql);
			if($query!=null){
				$origen2=$_FILES['respaldo']['tmp_name'];
				$destino2="../files/convenio/respaldo/$respaldo";
				move_uploaded_file($origen2,$destino2);
				print "<script>alert(\"El contrato fue registrado exitosamente.\");window.location='../views/add_convenio.php';</script>";
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
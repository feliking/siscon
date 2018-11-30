<?php
if(!empty($_POST)){
	if(isset($_POST["region"]) && isset($_POST["centro_focal"]) && isset($_POST["licencia"]) && isset($_POST["fecha_ini"]) && isset($_POST["observacion"]) && isset($_POST["nit"]) && isset($_POST["observacion2"]) && isset($_POST["ide"])){
		if($_POST["ide"]!=""){
			include "conexion.php";
			$found=false;
			if($_POST["ide"]==null){
				print "<script>alert(\"Identifiquese por favor\");window.location='../index.php';</script>";
			}
			else{
			$respaldo=time().'.jpg';
			$sql = "insert into bajalicencia(region,centro_focal,licencia_de_funcionamiento,fecha_baja,documento_escaneado,observacion,nit,ifd,observacion2,responsable) values (\"$_POST[region]\",\"$_POST[centro_focal]\",\"$_POST[licencia]\",\"$_POST[fecha_ini]\",'$respaldo',\"$_POST[observacion]\",\"$_POST[nit]\",\"$_POST[ifd]\",\"$_POST[observacion2]\",\"$_POST[ide]\")";
			$query = $con->query($sql);
			if($query!=null){
				$origen2=$_FILES['respaldo']['tmp_name'];
				$destino2="../files/bajalicen/respaldo/$respaldo";
				move_uploaded_file($origen2,$destino2);
				print "<script>alert(\"El contrato fue registrado exitosamente.\");window.location='../views/add_baja.php';</script>";
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
<?php
if(!empty($_POST)){
	if(isset($_POST["ide"])){
		if($_POST["ide"]!=""){
			include "conexion.php";
			$found=false;
			if($_POST["fecha_ini"]>$_POST["fecha_fin"]){
				print "<script>alert(\"Revise las fechas, la fecha de inicio es mayor a la del final.\");window.location='../views/add_funionamiento.php';</script>";
			}
			else{
			$respaldo=null;
			if (!$_FILES['respaldo']['error']==4) {
		        if ($_FILES['respaldo']['type']=="image/jpeg"||$_FILES['respaldo']['type']=="image/png"||$_FILES['respaldo']['type']=="image/gif"||$_FILES['respaldo']['type']=="application/pdf") {
		          $respaldo=time().$_FILES['respaldo']['name'];
		          $origen=$_FILES['respaldo']['tmp_name'];
		          $destino="../files/licenciafun/respaldo/$respaldo";
		          move_uploaded_file($origen,$destino);
		        }
		        else{
		          print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/add_funcionamiento.php;</script>";
		        }
		      }
		      else{
		        $respaldo="";
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
		          print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/add_funcionamiento.php;</script>";
		        }
		      }
		      else{
		        $respaldo_patentes="";
		      }
			$sql = "insert into licenciafun(region,centro_focal,tipo_centro_focal,fecha_ini,fecha_fin,respaldo,pago_patentes,respaldo_patentes,responsable) values (\"$_POST[region]\",\"$_POST[centro_focal]\",\"$_POST[tipo_centro_focal]\",\"$_POST[fecha_ini]\",\"$_POST[fecha_fin]\",'$respaldo',\"$_POST[pago_patentes]\",'$respaldo_patentes',\"$_POST[ide]\")";
			if ($_POST['fecha_ini']=="" && $_POST['fecha_fin']=="") {
				$sql = "insert into licenciafun(region,centro_focal,tipo_centro_focal,respaldo,pago_patentes,respaldo_patentes,responsable) values (\"$_POST[region]\",\"$_POST[centro_focal]\",\"$_POST[tipo_centro_focal]\",'$respaldo',\"$_POST[pago_patentes]\",'$respaldo_patentes',\"$_POST[ide]\")";
			}
			if ($_POST['fecha_fin']=="" && !$_POST['fecha_ini']=="") {
				$sql = "insert into licenciafun(region,centro_focal,tipo_centro_focal,fecha_ini,respaldo,pago_patentes,respaldo_patentes,responsable) values (\"$_POST[region]\",\"$_POST[centro_focal]\",\"$_POST[tipo_centro_focal]\",\"$_POST[fecha_ini]\",'$respaldo',\"$_POST[pago_patentes]\",'$respaldo_patentes',\"$_POST[ide]\")";
			}
			if (!$_POST['fecha_fin']=="" && $_POST['fecha_ini']=="") {
				$sql = "insert into licenciafun(region,centro_focal,tipo_centro_focal,fecha_fin,respaldo,pago_patentes,respaldo_patentes,responsable) values (\"$_POST[region]\",\"$_POST[centro_focal]\",\"$_POST[tipo_centro_focal]\",\"$_POST[fecha_fin]\",'$respaldo',\"$_POST[pago_patentes]\",'$respaldo_patentes',\"$_POST[ide]\")";
			}
			$query = $con->query($sql);
			if($query!=null){
				print "<script>alert(\"El contrato fue registrado exitosamente.\");window.location='../views/add_funcionamiento.php';</script>";
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
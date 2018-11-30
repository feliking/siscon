<?php
if(!empty($_POST)){
	if(isset($_POST["ide"])){
		if($_POST["ide"]!=""){
			include "conexion.php";
			$found=false;
			if($_POST["fecha_ini"]>$_POST["fecha_fin"]){
				print "<script>alert(\"Revise las fechas, la fecha de emision es mayor a la del vencimiento.\");window.location='../views/add_publicidad.php';</script>";
				mysqli_close($con);
			}
			else{
			$respaldo=null;
			if (!$_FILES['respaldo']['error']==4) {
		        if ($_FILES['respaldo']['type']=="image/jpeg"||$_FILES['respaldo']['type']=="image/png"||$_FILES['respaldo']['type']=="image/gif"||$_FILES['respaldo']['type']=="application/pdf") {
		          $respaldo=time().$_FILES['respaldo']['name'];
		          $origen=$_FILES['respaldo']['tmp_name'];
		          $destino="../files/licenciapubli/adosada/$respaldo";
		          move_uploaded_file($origen,$destino);
		        }
		        else{
		          print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/add_publicidad.php;</script>";
		        }
		      }
		      else{
		        $respaldo="";
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
		          print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/add_publicidad.php;</script>";
		        }
		      }
		      else{
		        $archivo="";
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
		          print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/add_publicidad.php;</script>";
		        }
		      }
		      else{
		        $respaldo_patentes="";
		      }

			$sql = "insert into licenpu(region,centro_focal,licencia_publicidad,letreros,vigencia_letreros,respaldo_adosada,pintada,microperforadora,autopartes,fecha_emsion,fecha_vencimiento,respaldo,observaciones,pago_patentes,respaldo_patentes,responsable) values (\"$_POST[region]\",\"$_POST[centro_focal]\",\"$_POST[cuenta]\",\"$_POST[adosada]\",\"$_POST[vigencia]\",'$respaldo',\"$_POST[pintada]\",\"$_POST[microperforadora]\",\"$_POST[autoportantes]\",\"$_POST[fecha_ini]\",\"$_POST[fecha_fin]\",'$archivo',\"$_POST[observaciones]\",\"$_POST[pago_patentes]\",'$respaldo_patentes',\"$_POST[ide]\")";
			if ($_POST['fecha_ini']=="" && $_POST['fecha_fin']=="") {
				$sql = "insert into licenpu(region,centro_focal,licencia_publicidad,letreros,vigencia_letreros,respaldo_adosada,pintada,microperforadora,autopartes,respaldo,observaciones,pago_patentes,respaldo_patentes,responsable) values (\"$_POST[region]\",\"$_POST[centro_focal]\",\"$_POST[cuenta]\",\"$_POST[adosada]\",\"$_POST[vigencia]\",'$respaldo',\"$_POST[pintada]\",\"$_POST[microperforadora]\",\"$_POST[autoportantes]\",'$archivo',\"$_POST[observaciones]\",\"$_POST[pago_patentes]\",'$respaldo_patentes',\"$_POST[ide]\")";;
			}
			if ($_POST['fecha_fin']=="" && !$_POST['fecha_ini']=="") {
				$sql = "insert into licenpu(region,centro_focal,licencia_publicidad,letreros,vigencia_letreros,respaldo_adosada,pintada,microperforadora,autopartes,fecha_emsion,respaldo,observaciones,pago_patentes,respaldo_patentes,responsable) values (\"$_POST[region]\",\"$_POST[centro_focal]\",\"$_POST[cuenta]\",\"$_POST[adosada]\",\"$_POST[vigencia]\",'$respaldo',\"$_POST[pintada]\",\"$_POST[microperforadora]\",\"$_POST[autoportantes]\",\"$_POST[fecha_ini]\",$archivo',\"$_POST[observaciones]\",\"$_POST[pago_patentes]\",'$respaldo_patentes',\"$_POST[ide]\")";
			}
			if (!$_POST['fecha_fin']=="" && $_POST['fecha_ini']=="") {
				$sql = "insert into licenpu(region,centro_focal,licencia_publicidad,letreros,vigencia_letreros,respaldo_adosada,pintada,microperforadora,autopartes,fecha_vencimiento,respaldo,observaciones,pago_patentes,respaldo_patentes,responsable) values (\"$_POST[region]\",\"$_POST[centro_focal]\",\"$_POST[cuenta]\",\"$_POST[adosada]\",\"$_POST[vigencia]\",'$respaldo',\"$_POST[pintada]\",\"$_POST[microperforadora]\",\"$_POST[autoportantes]\",\"$_POST[fecha_fin]\",'$archivo',\"$_POST[observaciones]\",\"$_POST[pago_patentes]\",'$respaldo_patentes',\"$_POST[ide]\")";
			}
			$query = $con->query($sql);
			if($query!=null){
				print "<script>alert(\"El contrato fue registrado exitosamente.\");window.location='../views/add_publicidad.php';</script>";
				mysqli_close($con);
			}
			else{
				echo "Hay problemas con la consulta";
			}
			}
		}
		else{
			echo "Hay problemas en el tercer if";
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
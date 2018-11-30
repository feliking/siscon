<?php
if(!empty($_POST)){
	if(isset($_POST["region"]) && isset($_POST["centro_focal"]) &&isset($_POST["estado"])&&isset($_POST["sucursal"])&&isset($_POST["direccion"])&&isset($_POST["ide"])){
		if($_POST["ide"]!=""){
			include "conexion.php";
			$found=false;
			if($_POST["ide"]==null){
				print "<script>alert(\"Intenta insertar datos sin estar identificado, por seguridad se guardara su direccion IP.\");window.location='../views/add_nit.php';</script>";
				mysqli_close($con);
			}
			else{
			$respaldo=null;
			if (!$_FILES['respaldo']['error']==4) {
		        if ($_FILES['respaldo']['type']=="image/jpeg"||$_FILES['respaldo']['type']=="image/png"||$_FILES['respaldo']['type']=="image/gif"||$_FILES['respaldo']['type']=="application/pdf") {
		          $respaldo=time().$_FILES['respaldo']['name'];
		          $origen=$_FILES['respaldo']['tmp_name'];
		          $destino="../files/nit/respaldo/$respaldo";
		          move_uploaded_file($origen,$destino);
		        }
		        else{
		          print "<script>alert(\"El formato de archivo de respaldo no es admitido por el sistema\");window.location='../views/add_nit.php;</script>";
		        }
		      }
		      else{
		        $respaldo="";
		      }
		      if ($_POST['sucursal']==null) {
		      	$_POST['sucursal']==0;
		      }
			$sql = "insert into nit(region,centro_focal,respaldo,estado,nro_sucursal,direccion_registro,responsable) values (\"$_POST[region]\",\"$_POST[centro_focal]\",'$respaldo',\"$_POST[estado]\",\"$_POST[sucursal]\",\"$_POST[direccion]\",\"$_POST[ide]\")";
			$query = $con->query($sql);
			if($query!=null){
				print "<script>alert(\"El contrato fue registrado exitosamente.\");window.location='../views/add_nit.php';</script>";
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
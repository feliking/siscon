<?php
if(!empty($_POST)){
  if(isset($_POST["region"]) && isset($_POST["centro_focal"]) && isset($_POST["tipo_extin"])&& isset($_POST["tipo_extin2"]) && isset($_POST["ubicacion"]) && isset($_POST["peso"])&&isset($_POST["fecha_ini"]) && isset($_POST["fecha_fin"]) && isset($_POST["nro_extintor"]) && isset($_POST["ide"])){
    if($_POST["ide"]!=""){
      include "conexion.php";
      if($_POST["fecha_ini"]>$_POST["fecha_fin"]){
        print "<script>alert(\"Revise las fechas, la fecha de caducidad es mayor a la de recarga.\");window.location='../views/update_extintor.php?$_POST[ide]';</script>";
      }
      else{
      $sql = "update extintores set region=\"$_POST[region]\",tipo_region=\"$_POST[centro_focal]\",tipo_extin=\"$_POST[tipo_extin]\",tipo_extin2=\"$_POST[tipo_extin2]\",ubicacion=\"$_POST[ubicacion]\",peso=\"$_POST[peso]\",fecha_recarga=\"$_POST[fecha_ini]\",fecha_valida=\"$_POST[fecha_fin]\",nro_extintor=\"$_POST[nro_extintor]\" where id_ext=\"$_POST[ide]\"";
      $query = $con->query($sql);
      if($query!=null){
        print "<script>alert(\"El contrato fue actualizado exitosamente.\");window.location='../views/extintor.php';</script>";
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
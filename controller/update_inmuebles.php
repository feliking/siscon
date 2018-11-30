<?php 
	include "conexion.php";
      $sql = "UPDATE impuestoinmu SET 
      region=\"$_POST[region]\",
      contable=\"$_POST[contable]\",
      direccion=\"$_POST[direccion]\",
      numero_inmuebles=\"$_POST[nro_inmu]\",
      descripcion_inmuebles=\"$_POST[descripcion]\",
      valor_inicial=\"$_POST[valor]\",
      pago_vigente=\"$_POST[vigente]\",
      gestion=\"$_POST[gestion]\",
      documento_escaneado=\"$_POST[envio]\",
      observaciones=\"$_POST[obs]\",
      impuestos_municipales=\"$_POST[pago]\"
      WHERE id_impin=\"$_POST[ide]\"";
      $query = $con->query($sql);
      if($query!=null){
        print "<script>alert(\"El contrato fue actualizado exitosamente.\");window.location='../views/inmuebles.php';</script>";
      }
      else{
        echo "algo anda mal en la consulta";
      }
 ?>
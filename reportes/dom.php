<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Reporte Siscon</title>
    <style>
    body{
        font-size: 10px;
    }
    </style>
</head>
<body>
    <br>
    <br>
    <h1><center>CONTRATOS VENCIDOS Y APUNTO DE VENCER</center></h1>
    <br>
    <h2><center>CONTRATOS DE ALQUILER</center></h2>
    <br>
    <br>
  <table border="1" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>NRO</th>
                <th>REGIONAL</th>
                <th>NOMBRE</th>
                <th>FECHA DE INICIO</th>
                <th>FECHA FINAL</th>
                <th>BS</th>
                <th>$us</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $count=0;
            $campo=null;
            $sumabs=0;
            $sumasus=0;
            require("../controller/conexion.php");
            $sql=("SELECT * FROM alquiler ORDER BY fecha_fin");
            $query=mysqli_query($con,$sql);
            while($arreglo=mysqli_fetch_array($query)){
                $count++;
              $confi=date("Y-m-d");
              $nuevo=strtotime("+2 month",strtotime($confi));
              $nuevo=date("Y-m-d",$nuevo);
              $nuevo2=strtotime("+1 month",strtotime($confi));
              $nuevo2=date("Y-m-d",$nuevo2);
              if ($arreglo[6]>date("Y-m-d")) {
                  $campo=null;
              }
              if ($arreglo[6]<$nuevo && $arreglo[6]>date("Y-m-d")) {
                  $campo="notificado";
              }
              $nuevo3=strtotime("+1 week",strtotime($confi));
              $nuevo3=date("Y-m-d",$nuevo3);
              if ($arreglo[6]<date("Y-m-d")) {
                  $campo="vencido";
              }
              if ($arreglo[6]=="0000-00-00"||$arreglo[6]==null) {
                  $campo = null;
              }
              if(!$campo){
                  continue;
              }
              echo "<tr id='$campo'>";
              echo "<td>$count</td>";
              echo "<td>$arreglo[1]</td>";
              echo "<td>$arreglo[4]</td>";
              $fecha=strftime("%d/%m/%Y",strtotime($arreglo[5]));
              echo "<td>$fecha</td>";
              $fecha2=strftime("%d/%m/%Y",strtotime($arreglo[6]));
              echo "<td>$fecha2</td>";
                $monto=number_format((floatval($arreglo[7])),2,".",",");
                echo "<td class='valores'>$monto</td>";
                $monto2=number_format((floatval($arreglo[8])),2,".",",");
                echo "<td class='valores'>$monto2</td>";
              echo "</tr>";
            }
            ?>
            </tbody>
      </table>
      <!-- Extintor-->
      <br>
      <h2 class="titulo"><center>CONTRATOS DE EXTINTORES</center></h2>
      <br>
      <table border="1" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>NRO</th>
                <th>REGION</th>
                <th>CON AGUA</th>
                <th>APARATOS ELECTRONICOS</th>
                <th>PESO</th>
                <th>FECHA DE RECARGA</th>
                <th>FECHA DE VALIDEZ</th>
            </tr>
        </thead>
        <tbody>
        <?php  
            $count=0;
            require("../controller/conexion.php");
            $sql=("SELECT * FROM extintores ORDER BY fecha_valida");
            $query=mysqli_query($con,$sql);
            while($arreglo=mysqli_fetch_array($query)){
                $count++;
              $confi=date("Y-m-d");
              $nuevo=strtotime("+2 month",strtotime($confi));
              $nuevo=date("Y-m-d",$nuevo);
              if ($arreglo[8]>date("Y-m-d")) {
                  $campo=null;
              }
              if ($arreglo[8]<$nuevo && $arreglo[8]>date("Y-m-d")) {
                  $campo="notificado";
              }
              if ($arreglo[8]<date("Y-m-d")) {
                  $campo="vencido";
              }
              if ($arreglo[8]=="0000-00-00"||$arreglo[8]==null) {
                  $campo=null;
              } 
              if(!$campo){
                  continue;
              }
              echo "<tr id='$campo'>";
              echo "<td>$count</td>";
              echo "<td>$arreglo[1]</td>";
              echo "<td>$arreglo[3]</td>";
              echo "<td>$arreglo[4]</td>";
              echo "<td>$arreglo[6]</td>";
              $fecha=strftime("%d/%m/%Y",strtotime($arreglo[7]));
              echo "<td>$fecha</td>";
              $fecha2=strftime("%d/%m/%Y",strtotime($arreglo[8]));
              echo "<td>$fecha2</td>";
              echo "</tr>";
            }
            mysqli_close($con);
            ?>
      </tbody>
    </table>
    <br>
    <h2 class="titulo"><center>CONTRATOS DE LIMPIEZA</center></h2>
    <br>
    <table border="1" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>NRO</th>
                <th>REGIONAL</th>
                <th>CENTRO FOCAL</th>
                <th>NOMBRE DE LA EMPRESA</th>
                <th>FECHA DE INICIO</th>
                <th>FECHA FINAL</th>
                <th>BS</th>
                <th>$us</th>
            </tr>
        </thead>
        <tbody>
        <?php  
            $campo = null;
            $count=0;
            $sumabs=0;
            $sumasus=0;
            require("../controller/conexion.php");
            $sql=("SELECT * FROM limpieza ORDER BY fecha_fin");
            $query=mysqli_query($con,$sql);
            while($arreglo=mysqli_fetch_array($query)){
                $count ++;
                $confi=date("Y-m-d");
              $nuevo=strtotime("+2 month",strtotime($confi));
              $nuevo=date("Y-m-d",$nuevo);
              $nuevo2=strtotime("+1 month",strtotime($confi));
              $nuevo2=date("Y-m-d",$nuevo2);
              if ($arreglo[6]>date("Y-m-d")) {
                  $campo=null;
              }
              if ($arreglo[6]<$nuevo && $arreglo[6]>date("Y-m-d")) {
                  $campo="notificado";  
              }
              $nuevo3=strtotime("+1 week",strtotime($confi));
              $nuevo3=date("Y-m-d",$nuevo3);
              if ($arreglo[6]<date("Y-m-d")) {
                  $campo="vencido";
              }
              if ($arreglo[6]=="0000-00-00"||$arreglo[6]==null) {
                  $campo=null;
              }
              if(!$campo){
                  continue;
              }
              echo "<tr id='$campo'>";
              echo "<td>$count</td>";
              echo "<td>$arreglo[1]</td>";
              echo "<td>$arreglo[2]</td>";
              echo "<td>$arreglo[4]</td>";
              $fecha=strftime("%d/%m/%Y",strtotime($arreglo[5]));
              echo "<td>$fecha</td>";
              $fecha2=strftime("%d/%m/%Y",strtotime($arreglo[6]));
              echo "<td>$fecha2</td>";
              if ($arreglo[8]=="bs") {
                $monto=number_format((floatval($arreglo[7])),2,".",",");
                echo "<td class='valores'>$monto</td>";
                echo "<td></td>";
              }
              else{
                $monto=number_format((floatval($arreglo[7])),2,".",",");
                echo "<td></td>";
                echo "<td class='valores'>$monto</td>";
              }
              echo "</tr>";
            }
            ?>
      </tbody>
      </table>

      <br>
    <h2 class="titulo"><center>CONTRATOS DE SEGURIDAD</center></h2>
    <br>
      <table border="1" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>NRO</th>
                <th>REGIONAL</th>
                <th>CENTRO FOCAL</th>
                <th>NOMBRE DE LA EMPRESA</th>
                <th>FECHA DE INICIO</th>
                <th>FECHA FINAL</th>
                <th>NRO DE GUARDIAS</th>
                <th>BS</th>
                <th>$us</th>
            </tr>
        </thead>
        <tbody>
        <?php  
            $campo = null;
            $count=0;
            $sumabs=0;
            $sumasus=0;
            require("../controller/conexion.php");
            $sql=("SELECT * FROM seguridad ORDER BY fecha_fin");
            $query=mysqli_query($con,$sql);
            while($arreglo=mysqli_fetch_array($query)){
                $count++;
              $confi=date("Y-m-d");
              $nuevo=strtotime("+2 month",strtotime($confi));
              $nuevo=date("Y-m-d",$nuevo);
              $nuevo2=strtotime("+1 month",strtotime($confi));
              $nuevo2=date("Y-m-d",$nuevo2);
              if ($arreglo[6]>date("Y-m-d")) {
                  $campo=null;
              }
              if ($arreglo[6]<$nuevo && $arreglo[6]>date("Y-m-d")) {
                  $campo="notificado";   
              }
              $nuevo3=strtotime("+1 week",strtotime($confi));
              $nuevo3=date("Y-m-d",$nuevo3);
              if ($arreglo[6]<date("Y-m-d")) {
                  $campo="vencido";
              }
              if ($arreglo[6]=="0000-00-00") {
                  $campo=null;
              }
              if(!$campo){
                  continue;
              }
              echo "<tr id='$campo'>";
              echo "<td>$count</td>";
              echo "<td>$arreglo[1]</td>";
              echo "<td>$arreglo[2]</td>";
              echo "<td>$arreglo[4]</td>";
              $fecha=strftime("%d/%m/%Y",strtotime($arreglo[5]));
              echo "<td>$fecha</td>";
              $fecha2=strftime("%d/%m/%Y",strtotime($arreglo[6]));
              echo "<td>$fecha2</td>";
              echo "<td>$arreglo[7]</td>";
                $monto=number_format((floatval($arreglo[8])),2,".",",");
                echo "<td class='valores'>$monto</td>";
                $monto2=number_format((floatval($arreglo[9])),2,".",",");
                echo "<td class='valores'>$monto2</td>";
              echo "</tr>";
            }
            
            ?>
      </tbody>
    </table>
    <br>
    <h2 class="titulo"><center>CONTRATOS DE MONITOREO DE ALARMAS</center></h2>
    <br>
    <table border="1" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>NRO</th>
                <th>REGIONAL</th>
                <th>PROVEEDOR</th>
                <th>FECHA DE INICIO</th>
                <th>FECHA FINAL</th>
                <th>AÑOS</th>
                <th>BS</th>
                <th>$us</th>
            </tr>
        </thead>
        <tbody>
        <?php  
            $count=0;
            $sumabs=0;
            $sumasus=0;
            require("../controller/conexion.php");
            $sql=("SELECT * FROM monitoreo ORDER BY fecha_fin");
            $query=mysqli_query($con,$sql);
            while($arreglo=mysqli_fetch_array($query)){
                $count++;
                $confi=date("Y-m-d");
              $nuevo=strtotime("+2 month",strtotime($confi));
              $nuevo=date("Y-m-d",$nuevo);
              $nuevo2=strtotime("+1 month",strtotime($confi));
              $nuevo2=date("Y-m-d",$nuevo2);
              if ($arreglo[5]>date("Y-m-d")) {
                  $campo=null;
              }
              if ($arreglo[5]<$nuevo && $arreglo[5]>date("Y-m-d")) {
                  $campo="notificado";  
              }
              $nuevo3=strtotime("+1 week",strtotime($confi));
              $nuevo3=date("Y-m-d",$nuevo3);
              if ($arreglo[5]<date("Y-m-d")) {
                  $campo="vencido";
              }
              if ($arreglo[5]=="0000-00-00"||$arreglo[5]==null) {
                  $campo=null;
              }
              if(!$campo){
                  continue;
              }
              echo "<tr id='$campo'>";
              echo "<td>$count</td>";
              echo "<td>$arreglo[1]</td>";
              echo "<td>$arreglo[2]</td>";
              echo "<td>$arreglo[3]</td>";
              $fecha=strftime("%d/%m/%Y",strtotime($arreglo[4]));
              echo "<td>$fecha</td>";
              $fecha2=strftime("%d/%m/%Y",strtotime($arreglo[5]));
              echo "<td>$fecha2</td>";
              if ($arreglo[7]=="bs") {
                $monto=number_format((floatval($arreglo[6])),2,".",",");
                echo "<td class='valores'>$monto</td>";
                echo "<td></td>";
              }
              else{
                $monto=number_format((floatval($arreglo[6])),2,".",",");
                echo "<td></td>";
                echo "<td class='valores'>$monto</td>";
              }
              echo "</tr>";
            }
            ?>
      </tbody>
    </table>
    <br>
    <h2 class="titulo"><center>OTROS CONTRATOS</center></h2>
    <br>
    <table border="1" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>NRO</th>
                <th>EMPRESA</th>
                <th>DETALLE</th>
                <th>FECHA DE INICIO</th>
                <th>FECHA FINAL</th>
                <th>MONTO EN BS</th>
                <th>MONTO EN $US</th>
            </tr>
        </thead>
        <tbody>
        <?php  
            $count=0;
            require("../controller/conexion.php");
            $sql=("SELECT * FROM otros_contratos ORDER BY fecha_fin");
            $query=mysqli_query($con,$sql);
            while($arreglo=mysqli_fetch_array($query)){
                $count++;
                $confi=date("Y-m-d");
              $nuevo=strtotime("+2 month",strtotime($confi));
              $nuevo=date("Y-m-d",$nuevo);
              $nuevo2=strtotime("+1 month",strtotime($confi));
              $nuevo2=date("Y-m-d",$nuevo2);
              if ($arreglo[4]>date("Y-m-d")) {
                  $campo=null;
              }
              if ($arreglo[4]<$nuevo && $arreglo[4]>date("Y-m-d")) {
                  $campo="notificado";  
              }
              $nuevo3=strtotime("+1 week",strtotime($confi));
              $nuevo3=date("Y-m-d",$nuevo3);
              if ($arreglo[4]<date("Y-m-d")) {
                  $campo="vencido";
              }
              if ($arreglo[4]=="") {
                  $campo=null;
              }
              if(!$campo){
                  continue;
              }
              echo "<tr id='$campo'>";
              echo "<td>$count</td>";
              echo "<td>$arreglo[1]</td>";
              echo "<td>$arreglo[2]</td>";
              echo "<td>$arreglo[3]</td>";
              echo "<td>$arreglo[4]</td>";
              $monto=number_format((floatval($arreglo[7])),2,".",",");
              echo "<td class='valores'>$monto</td>";
              $monto2=number_format((floatval($arreglo[8])),2,".",",");
              echo "<td class='valores'>$monto2</td>";
              echo "</tr>";
            }
            mysqli_close($con);
            ?>
      </tbody>
    </table>
    <br>
    <h2 class="titulo"><center>CONTRATOS DE LICENCIA DE FUNCIONAMIENTO</center></h2>
    <br>
    <table border="1" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>NRO</th>
                <th>REGIONAL</th>
                <th>CENTRO FOCAL</th>
                <th>TIPO CENTRO FOCAL</th>
                <th>EMISION</th>
                <th>FECHA FINAL</th>
            </tr>
        </thead>
        <tbody>
        <?php  
            $count=0;
            require("../controller/conexion.php");
            $sql=("SELECT * FROM licenciafun ORDER BY fecha_fin");
            $query=mysqli_query($con,$sql);
            while($arreglo=mysqli_fetch_array($query)){
                $count++;
                $confi=date("Y-m-d");
              $nuevo=strtotime("+2 month",strtotime($confi));
              $nuevo=date("Y-m-d",$nuevo);
              if ($arreglo[5]>date("Y-m-d")) {
                  $campo=null;
              }
              if ($arreglo[5]<$nuevo && $arreglo[5]>date("Y-m-d")) {
                  $campo="notificado";
              }
              if ($arreglo[5]<date("Y-m-d")) {
                  $campo="vencido";
              }
              if ($arreglo[5]=="0000-00-00") {
                  $campo=null;
              }
              if(!$campo){
                  continue;
              }
              echo "<tr id='$campo'>";
              echo "<td>$count</td>";
              echo "<td>$arreglo[1]</td>";
              echo "<td>$arreglo[2]</td>";
              echo "<td>$arreglo[3]</td>";
              $fecha=strftime("%d/%m/%Y",strtotime($arreglo[4]));
              echo "<td>$fecha</td>";
              $fecha2=strftime("%d/%m/%Y",strtotime($arreglo[5]));
              echo "<td>$fecha2</td>";
              echo "</tr>";
            }
            mysqli_close($con);
            ?>
      </tbody>
    </table>
</body>
</html>
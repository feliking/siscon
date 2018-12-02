<?php
session_start();
if(!isset($_SESSION["tipo"])){
        print "<script>alert(\"Acceso denegado, Debe identificarse para ingresar al sistema\");window.location='../index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Reporte</title>
    <link rel="shortcut icon" href="../assets/favicono.ico">
    <link rel='stylesheet prefetch' href='../plugins/css/bootstrap.min.css'>
    <link rel='stylesheet prefetch' href='../plugins/css/jquery.dataTables.min.css'>
    <link rel='stylesheet prefetch' href='../plugins/css/buttons.dataTables.min.css'>
    <link rel="stylesheet" href="../css/reset.css"> <!-- CSS reset -->
    <link rel="stylesheet" href="../css/cabecera.css"> <!-- Resource style -->
    <script src="../js/modernizr.js"></script> <!-- Modernizr -->
    <style type="text/css">
        body{
            padding: 25px;
            background-color: #1DC0CA;
        }

        input{
            border: none;
            content: " adsfasdf";
            background: #eee;
            border: 1px solid #ccc;
            border-radius: 15px;
        }
        tr th{
            text-align: center;
        }
        .valores{
            text-align: right;
        }
        @font-face{
            font-family: fuentenueva;
            src: url(../font/quantifypremium/webdesignpro.ttf);
        }
        .titulo{
            font-size: 40px;
            font-family: fuentenueva;
        }
        #vigente{
            background-color: #1BFF6B;
        }
        #notificado{
            background-color: #FCFF0A;
        }
        #vencido{
            background-color: #FF7777;
        }
        #adorno{
            background-color: #fff;
        }
    </style>
</head>
<body>
    <nav class="cd-stretchy-nav">
        <a class="cd-nav-trigger" href="#0">
            
            <span aria-hidden="true"></span>
        </a>
        <ul>
            <li><a href="../views/page_user.php" class="active"><span><font color="red">Tareas Principales</font></span></a></li>
            <li><a href="../reportes/reporte.php"><span><font color="red">Generar archivo PDF</font></span></a></li>
            <li><a href="../views/update_password.php?id=<?php echo $_SESSION['user_id']; ?>"><span><font color="red">Cambiar contraseña</font></span></a></li>
            <li><a href="../controller/logout.php"><span><font color="red">Salir: <?php echo $_SESSION["nombres"]  ?></font></span></a></li>
        </ul>

        <span aria-hidden="true" class="stretchy-nav-bg"></span>
    </nav>
    <br>
    <br>
    <h1 class="titulo"><center>CONTRATOS VENCIDOS Y APUNTO DE VENCER</center></h1>
    <br>
    <h1 class="titulo"><center>CONTRATOS DE ALQUILER</center></h1>
    <br>
    <br>
  <table id="example" class="display table table-bordered table-hover nowrap compact" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th colspan="2">FECHA CONTRATO</th>
                <th>AÑOS</th>
                <th colspan="2">CANON MENSUAL ORIG.</th>
                <th>ESTADO DEL CTTO</th>
                <th colspan="2">SOLICITUD</th>
                <th></th>
                <th></th>
                <th></th>
                <?php if ($_SESSION["user_id"]==0) {
                    echo "<th></th>";
                    echo "<th></th>";
                } ?>
            </tr>
            <tr>
                <th>NRO</th>
                <th>REGIONAL</th>
                <th>CENTRO FOCAL</th>
                <th>TIPO CENTRO FOCAL</th>
                <th>NOMBRE</th>
                <th>FECHA DE INICIO</th>
                <th>FECHA FINAL</th>
                <th>DURACION</th>
                <th>BS</th>
                <th>$us</th>
                <th>CONFIRMAR DATO</th>
                <th>RESPALDO</th>
                <th>FOLIO REAL</th>
                <th>GARANTIA Bs</th>
                <th>GARANTIA $us</th>
                <th>DEVUELTO</th>
                <?php if ($_SESSION["user_id"]==0) {
                    echo "<th></th>";
                    echo "<th>AÑADIDO POR:</th>";
                } ?>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>NRO</th>
                <th>REGIONAL</th>
                <th>CENTRO FOCAL</th>
                <th>TIPO CENTRO FOCAL</th>
                <th>NOMBRE</th>
                <th>FECHA DE INICIO</th>
                <th>FECHA FINAL</th>
                <th>DURACION</th>
                <th>BS</th>
                <th>$us</th>
                <th>CONFIRMAR DATO</th>
                <th>RESPALDO</th>
                <th>FOLIO REAL</th>
                <th>GARANTIA Bs</th>
                <th>GARANTIA $us</th>
                <th>DEVUELTO</th>
                <?php if ($_SESSION["user_id"]==0) {
                    echo "<th></th>";
                    echo "<th>AÑADIDO POR:</th>";
                } ?>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th colspan="2">FECHA CONTRATO</th>
                <th>AÑOS</th>
                <th colspan="2">CANON MENSUAL ORIG.</th>
                <th>ESTADO DEL CTTO</th>
                <th colspan="2">SOLICITUD</th>
                <th></th>
                <th></th>
                <th></th>
                <?php if ($_SESSION["user_id"]==0) {
                    echo "<th></th>";
                    echo "<th></th>";
                } ?>
            </tr>
        </tfoot>
        <tbody>
        <?php
            $count=0;
            $campo=null;
            $sumabs=0;
            $sumasus=0;
            require("../controller/conexion.php");
            if ($_SESSION["user_id"]==0 || $_SESSION["regional"]=="OF. NACIONAL") {
                $sql=("SELECT * FROM alquiler ORDER BY fecha_fin");
            }
            else{
                $sql=("SELECT * FROM alquiler where region=\"$_SESSION[regional]\" ORDER BY fecha_fin");
            }
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
              echo "<td>$arreglo[2]</td>";
              echo "<td>$arreglo[3]</td>";
              echo "<td>$arreglo[4]</td>";
              $fecha=strftime("%d/%m/%Y",strtotime($arreglo[5]));
              echo "<td>$fecha</td>";
              $fecha2=strftime("%d/%m/%Y",strtotime($arreglo[6]));
              echo "<td>$fecha2</td>";
              $duracion=intval($arreglo[6])-intval($arreglo[5]);
              echo "<td>$duracion</td>";
                $monto=number_format((floatval($arreglo[7])),2,".",",");
                echo "<td class='valores'>$monto</td>";
                $monto2=number_format((floatval($arreglo[8])),2,".",",");
                echo "<td class='valores'>$monto2</td>";
              if($arreglo[6]>date("Y-m-d")){
                echo "<td>Contrato Vigente</td>";
              }
              else{
                echo "<td>Vencido</td>";
              }
              if ($arreglo[9]!=null) {
                echo "<td><a href='../files/alquileres/folio_real/$arreglo[9]' target='_blank'>Ver documento de folio real</td>";
              }
              else{
                echo "<td>No se subió documento de folio real</td>";
              }
              if ($arreglo[10]!=null) {
                echo "<td><a href='../files/alquileres/respaldo/$arreglo[10]' target='_blank'>Ver documento de respaldo</td>";
              }
              else{
                echo "<td>No se subió documento de respaldo</td>";
              }
              $monto=number_format((floatval($arreglo[11])),2,".",",");
                echo "<td class='valores'>$monto</td>";
                $monto2=number_format((floatval($arreglo[12])),2,".",",");
                echo "<td class='valores'>$monto2</td>";
                echo "<td>$arreglo[13]</td>";
              if ($_SESSION["user_id"]==0) {
                echo "<td><a href='../views/update_alquiler.php?id=$arreglo[0]'>Modificar</a><a href='../controller/delete_alquiler.php?id=$arreglo[0]'>Eliminar</a></td>";
                $sql2=("SELECT * FROM usuario where ci=\"$arreglo[14]\"");
                $query2=mysqli_query($con,$sql2);
                $nombre=mysqli_fetch_array($query2);
                echo "<td class='$campo'>$nombre[1] $nombre[2]</td>";
              }
              $sumabs=$sumabs+floatval($arreglo[7]);
              $sumasus=$sumasus+floatval($arreglo[8]);
              echo "</tr>";
            }
            ?>
            </tbody>
      </table>
      <!-- Extintor-->
      <br>
      <h1 class="titulo"><center>CONTRATOS DE EXTINTORES</center></h1>
      <br>
      <table class="display table table-bordered table-hover nowrap compact" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th colspan="2">TIPO DE EXTINTOR</th>
                <th></th>
                <th></th>
                <th colspan="2">FECHA CONTRATO</th>
                <th>VIGENTE/</th>
                <th></th>
                <?php if ($_SESSION["user_id"]==0) {
                    echo "<th></th>";
                    echo "<th></th>";
                } ?>
            </tr>
            <tr>
                <th>NRO</th>
                <th>REGION</th>
                <th>TIPO REGION</th>
                <th>CON AGUA</th>
                <th>APARATOS ELECTRONICOS</th>
                <th>UBICACION</th>
                <th>PESO</th>
                <th>FECHA DE RECARGA</th>
                <th>FECHA DE VALIDEZ</th>
                <th>VENCIDO</th>
                <th>NRO EXTINTOR</th>
                <?php if ($_SESSION["user_id"]==0) {
                    echo "<th></th>";
                    echo "<th>AÑADIDO POR:</th>";
                } ?>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>NRO</th>
                <th>REGION</th>
                <th>TIPO REGION</th>
                <th>CON AGUA</th>
                <th>APARATOS ELECTRONICOS</th>
                <th>UBICACION</th>
                <th>PESO</th>
                <th>FECHA DE RECARGA</th>
                <th>FECHA DE VALIDEZ</th>
                <th>VENCIDO</th>
                <th>NRO EXTINTOR</th>
                <?php if ($_SESSION["user_id"]==0) {
                    echo "<th></th>";
                    echo "<th>AÑADIDO POR:</th>";
                } ?>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th colspan="2">TIPO DE EXTINTOR</th>
                <th></th>
                <th></th>
                <th colspan="2">FECHA CONTRATO</th>
                <th>VIGENTE/</th>
                <th></th>
                <?php if ($_SESSION["user_id"]==0) {
                    echo "<th></th>";
                    echo "<th></th>";
                } ?>
            </tr>
        </tfoot>
        <tbody>
        <?php  
            $count=0;
            require("../controller/conexion.php");
            if ($_SESSION["user_id"]==0) {
                $sql=("SELECT * FROM extintores ORDER BY fecha_valida");
            }
            else{
                $sql=("SELECT * FROM extintores where region=\"$_SESSION[regional]\" ORDER BY fecha_valida");
            }
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
              echo "<td>$arreglo[2]</td>";
              echo "<td>$arreglo[3]</td>";
              echo "<td>$arreglo[4]</td>";
              echo "<td>$arreglo[5]</td>";
              echo "<td>$arreglo[6]</td>";
              $fecha=strftime("%d/%m/%Y",strtotime($arreglo[7]));
              echo "<td>$fecha</td>";
              $fecha2=strftime("%d/%m/%Y",strtotime($arreglo[8]));
              echo "<td>$fecha2</td>";
              if($arreglo[8]>date("Y-m-d")){
                echo "<td>Contrato Vigente</td>";
              }
              else{
                echo "<td>VENCIDO</td>";
              }
              echo "<td>$arreglo[9]</td>";
              if ($_SESSION["user_id"]==0) {
                echo "<td><a href='../views/update_extintor.php?id=$arreglo[0]'>Modificar</a><a href='../controller/delete_extintor.php?id=$arreglo[0]'>Eliminar</a></td>";
                $sql2=("SELECT * FROM usuario where ci=\"$arreglo[10]\"");
                $query2=mysqli_query($con,$sql2);
                $nombre=mysqli_fetch_array($query2);
                echo "<td>$nombre[1] $nombre[2]</td>";
              }
              echo "</tr>";
            }
            mysqli_close($con);
            ?>
      </tbody>
    </table>
    <br>
    <h1 class="titulo"><center>CONTRATOS DE LIMPIEZA</center></h1>
    <br>
    <table id="example" class="display table table-bordered table-hover nowrap compact" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th colspan="2">FECHA CONTRATO</th>
                <th>AÑOS</th>
                <th colspan="2">CANON MENSUAL ORIG.</th>
                <th>ESTADO DEL CTTO</th>
                <th>SOLICITUD</th>
                <?php if ($_SESSION["user_id"]==0) {
                    echo "<th></th>";
                    echo "<th></th>";
                } ?>
            </tr>
            <tr>
                <th>NRO</th>
                <th>REGIONAL</th>
                <th>CENTRO FOCAL</th>
                <th>TIPO CENTRO FOCAL</th>
                <th>NOMBRE DE LA EMPRESA</th>
                <th>FECHA DE INICIO</th>
                <th>FECHA FINAL</th>
                <th>DURACION</th>
                <th>BS</th>
                <th>$us</th>
                <th>CONFIRMAR DATO</th>
                <th>RESPALDO</th>
                <?php if ($_SESSION["user_id"]==0) {
                    echo "<th></th>";
                    echo "<th>AÑADIDO POR:</th>";
                } ?>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>NRO</th>
                <th>REGIONAL</th>
                <th>CENTRO FOCAL</th>
                <th>TIPO CENTRO FOCAL</th>
                <th>NOMBRE DE LA EMPRESA</th>
                <th>FECHA DE INICIO</th>
                <th>FECHA FINAL</th>
                <th>DURACION</th>
                <th>BS</th>
                <th>$us</th>
                <th>CONFIRMAR DATO</th>
                <th>RESPALDO</th>
                <?php if ($_SESSION["user_id"]==0) {
                    echo "<th></th>";
                    echo "<th>AÑADIDO POR:</th>";
                } ?>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th colspan="2">FECHA CONTRATO</th>
                <th>AÑOS</th>
                <th colspan="2">CANON MENSUAL ORIG.</th>
                <th>ESTADO DEL CTTO</th>
                <th>SOLICITUD</th>
                <?php if ($_SESSION["user_id"]==0) {
                    echo "<th></th>";
                    echo "<th></th>";
                } ?>
            </tr>
        </tfoot>
        <tbody>
        <?php  
            $campo = null;
            $count=0;
            $sumabs=0;
            $sumasus=0;
            require("../controller/conexion.php");
             if ($_SESSION["user_id"]==0 || $_SESSION["regional"]=="OF. NACIONAL") {
                $sql=("SELECT * FROM limpieza ORDER BY fecha_fin");
            }
            else{
                $sql=("SELECT * FROM limpieza where region=\"$_SESSION[regional]\" ORDER BY fecha_fin");
            }
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
              echo "<td>$arreglo[3]</td>";
              echo "<td>$arreglo[4]</td>";
              $fecha=strftime("%d/%m/%Y",strtotime($arreglo[5]));
              echo "<td>$fecha</td>";
              $fecha2=strftime("%d/%m/%Y",strtotime($arreglo[6]));
              echo "<td>$fecha2</td>";
              $duracion=intval($arreglo[6])-intval($arreglo[5]);
              echo "<td>$duracion</td>";
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
              if($arreglo[6]>date("Y-m-d")){
                echo "<td>Contrato Vigente</td>";
              }
              else{
                echo "<td>Vencido</td>";
              }
              if ($arreglo[9]!=null) {
                echo "<td><a href='../files/limpieza/respaldo/$arreglo[9]' target='_blank'>Ver documento de respaldo</td>";
              }
              else{
                echo "<td>No se subió documento de respaldo</td>";
              }
              
              if ($_SESSION["user_id"]==0) {
                echo "<td><a href='../views/update_limpieza.php?id=$arreglo[0]'>Modificar</a><a href='../controller/delete_limpieza.php?id=$arreglo[0]'>Eliminar</a></td>";
                $sql2=("SELECT * FROM usuario where ci=\"$arreglo[10]\"");
                $query2=mysqli_query($con,$sql2);
                $nombre=mysqli_fetch_array($query2);
                echo "<td>$nombre[1] $nombre[2]</td>";
              }
              if ($arreglo[8]=="bs") {
                  $sumabs=$sumabs+floatval($arreglo[7]);
              }
              if ($arreglo[8]=="sus") {
                  $sumasus=$sumasus+floatval($arreglo[7]);
              }
              echo "</tr>";
            }
            ?>
      </tbody>
      </table>

      <br>
    <h1 class="titulo"><center>CONTRATOS DE SEGURIDAD</center></h1>
    <br>
      <table id="example" class="display table table-bordered table-hover nowrap compact" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th colspan="2">FECHA CONTRATO</th>
                <th>AÑOS</th>
                <th></th>
                <th colspan="2">CANON MENSUAL ORIG.</th>
                <th>ESTADO DEL CTTO</th>
                <th>SOLICITUD</th>
                <?php if ($_SESSION["user_id"]==0) {
                    echo "<th></th>";
                    echo "<th></th>";
                } ?>
            </tr>
            <tr>
                <th>NRO</th>
                <th>REGIONAL</th>
                <th>CENTRO FOCAL</th>
                <th>TIPO CENTRO FOCAL</th>
                <th>NOMBRE DE LA EMPRESA</th>
                <th>FECHA DE INICIO</th>
                <th>FECHA FINAL</th>
                <th>DURACION</th>
                <th>NRO DE GUARDIAS</th>
                <th>BS</th>
                <th>$us</th>
                <th>CONFIRMAR DATO</th>
                <th>RESPALDO</th>
                <?php if ($_SESSION["user_id"]==0) {
                    echo "<th></th>";
                    echo "<th>AÑADIDO POR:</th>";
                } ?>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>NRO</th>
                <th>REGIONAL</th>
                <th>CENTRO FOCAL</th>
                <th>TIPO CENTRO FOCAL</th>
                <th>NOMBRE DE LA EMPRESA</th>
                <th>FECHA DE INICIO</th>
                <th>FECHA FINAL</th>
                <th>DURACION</th>
                <th>NRO DE GUARDIAS</th>
                <th>BS</th>
                <th>$us</th>
                <th>CONFIRMAR DATO</th>
                <th>RESPALDO</th>
                <?php if ($_SESSION["user_id"]==0) {
                    echo "<th></th>";
                    echo "<th>AÑADIDO POR:</th>";
                } ?>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th colspan="2">FECHA CONTRATO</th>
                <th>AÑOS</th>
                <th></th>
                <th colspan="2">CANON MENSUAL ORIG.</th>
                <th>ESTADO DEL CTTO</th>
                <th>SOLICITUD</th>
                <?php if ($_SESSION["user_id"]==0) {
                    echo "<th></th>";
                    echo "<th></th>";
                } ?>
            </tr>
        </tfoot>
        <tbody>
        <?php  
            $campo = null;
            $count=0;
            $sumabs=0;
            $sumasus=0;
            require("../controller/conexion.php");
            if ($_SESSION["user_id"]==0 || $_SESSION["regional"]=="OF. NACIONAL") {
                $sql=("SELECT * FROM seguridad ORDER BY fecha_fin");
            }
            else{
                $sql=("SELECT * FROM seguridad where region=\"$_SESSION[regional]\" ORDER BY fecha_fin");
            }
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
              echo "<td>$arreglo[3]</td>";
              echo "<td>$arreglo[4]</td>";
              $fecha=strftime("%d/%m/%Y",strtotime($arreglo[5]));
              echo "<td>$fecha</td>";
              $fecha2=strftime("%d/%m/%Y",strtotime($arreglo[6]));
              echo "<td>$fecha2</td>";
              $duracion=intval($arreglo[6])-intval($arreglo[5]);
              echo "<td>$duracion</td>";
              echo "<td>$arreglo[7]</td>";
                $monto=number_format((floatval($arreglo[8])),2,".",",");
                echo "<td class='valores'>$monto</td>";
                $monto2=number_format((floatval($arreglo[9])),2,".",",");
                echo "<td class='valores'>$monto2</td>";
              if($arreglo[6]>date("Y-m-d")){
                echo "<td>Contrato Vigente</td>";
              }
              else{
                echo "<td>Vencido</td>";
              }
              if ($arreglo[10]!=null) {
                echo "<td><a href='../files/seguridad/respaldo/$arreglo[10]' target='_blank'>Ver documento de respaldo</td>";
              }
              else{
                echo "<td>No se subió documento de respaldo</td>";
              }
               
              if ($_SESSION["user_id"]==0) {
                echo "<td><a href='../views/update_seguridad.php?id=$arreglo[0]'>Modificar</a><a href='../controller/delete_seguridad.php?id=$arreglo[0]'>Eliminar</a></td>";
                $sql2=("SELECT * FROM usuario where ci=\"$arreglo[11]\"");
                $query2=mysqli_query($con,$sql2);
                $nombre=mysqli_fetch_array($query2);
                echo "<td>$nombre[1] $nombre[2]</td>";
              }
              $sumabs=$sumabs+floatval($arreglo[8]);
              $sumasus=$sumasus+floatval($arreglo[9]);
              echo "</tr>";
            }
            
            ?>
      </tbody>
    </table>
    <br>
    <h1 class="titulo"><center>CONTRATOS DE MONITOREO DE ALARMAS</center></h1>
    <br>
    <table id="example" class="display table table-fixed table-bordered table-hover nowrap compact" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th colspan="2">FECHA CONTRATO</th>
                <th>VIGENCIA</th>
                <th colspan="2">COBRO</th>
                <th>ESTADO DEL CTTO</th>
                <th>DOCUMENTO</th>
                <?php if ($_SESSION["user_id"]==0) {
                    echo "<th></th>";
                    echo "<th></th>";
                } ?>
            </tr>
            <tr>
                <th>NRO</th>
                <th>REGIONAL</th>
                <th>CENTRO FOCAL</th>
                <th>PROVEEDOR</th>
                <th>FECHA DE INICIO</th>
                <th>FECHA FINAL</th>
                <th>AÑOS</th>
                <th>BS</th>
                <th>$us</th>
                <th>CONFIRMAR DATO</th>
                <th>ESCANEADO</th>
                <?php if ($_SESSION["user_id"]==0) {
                    echo "<th>AÑADIDO POR:</th>";
                    echo "<th></th>";
                } ?>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>NRO</th>
                <th>REGIONAL</th>
                <th>CENTRO FOCAL</th>
                <th>PROVEEDOR</th>
                <th>FECHA DE INICIO</th>
                <th>FECHA FINAL</th>
                <th>AÑOS</th>
                <th>BS</th>
                <th>$us</th>
                <th>CONFIRMAR DATO</th>
                <th>ESCANEADO</th>
                <?php if ($_SESSION["user_id"]==0) {
                    echo "<th>AÑADIDO POR:</th>";
                    echo "<th></th>";
                } ?>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th colspan="2">FECHA CONTRATO</th>
                <th>VIGENCIA</th>
                <th colspan="2">COBRO</th>
                <th>ESTADO DEL CTTO</th>
                <th>DOCUMENTO</th>
                <?php if ($_SESSION["user_id"]==0) {
                    echo "<th></th>";
                    echo "<th></th>";
                } ?>
            </tr>
        </tfoot>
        <tbody>
        <?php  
            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\Exception;
            require '../phpmailer/Exception.php';
            require '../phpmailer/PHPMailer.php';
            require '../phpmailer/SMTP.php';
            $count=0;
            $sumabs=0;
                $sumasus=0;
            require("../controller/conexion.php");
            if ($_SESSION["user_id"]==0) {
                $sql=("SELECT * FROM monitoreo ORDER BY fecha_fin");
            }
            else{
                $sql=("SELECT * FROM monitoreo where region=\"$_SESSION[regional]\" ORDER BY fecha_fin");
            }
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
              $duracion=intval($arreglo[5])-intval($arreglo[4]);
              echo "<td>$duracion</td>";
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
              if($arreglo[5]>date("Y-m-d")){
                echo "<td>Contrato Vigente</td>";
              }
              else{
                echo "<td>Vencido</td>";
              }
              if ($arreglo[8]!=null) {
                echo "<td><a href='../files/monitoreo/respaldo/$arreglo[8]' target='_blank'>Ver documento de respaldo</td>";
              }
              else{
                echo "<td>No se subió documento de respaldo</td>";
              }
              
              if ($_SESSION["user_id"]==0) {
                echo "<td><a href='../views/update_monitoreo.php?id=$arreglo[0]'>Modificar</a><a href='../controller/delete_monitoreo.php?id=$arreglo[0]'>Eliminar</a></td>";
                $sql2=("SELECT * FROM usuario where ci=\"$arreglo[9]\"");
                $query2=mysqli_query($con,$sql2);
                $nombre=mysqli_fetch_array($query2);
                echo "<td>$nombre[1] $nombre[2]</td>";
              }
              $sumabs=$sumabs+floatval($arreglo[6]);
              echo "</tr>";
            }
            ?>
      </tbody>
    </table>
    <br>
    <h1 class="titulo"><center>OTROS CONTRATOS</center></h1>
    <br>
    <table id="example" class="display table table-bordered table-hover nowrap compact" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>NRO</th>
                <th>EMPRESA</th>
                <th>DETALLE</th>
                <th>FECHA DE INICIO</th>
                <th>FECHA FINAL</th>
                <th>VALIDEZ CONTRATO</th>
                <th>VIGENTE/VENCIDO</th>
                <th>MONTO EN BS</th>
                <th>MONTO EN $US</th>
                <th></th>
                <?php if ($_SESSION["user_id"]==0) {
                    echo "<th>AÑADIDO POR:</th>";
                } ?>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>NRO</th>
                <th>EMPRESA</th>
                <th>DETALLE</th>
                <th>FECHA DE INICIO</th>
                <th>FECHA FINAL</th>
                <th>VALIDEZ CONTRATO</th>
                <th>VIGENTE/VENCIDO</th>
                <th>MONTO EN BS</th>
                <th>MONTO EN $US</th>
                <th></th>
                <?php if ($_SESSION["user_id"]==0) {
                    echo "<th>AÑADIDO POR:</th>";
                } ?>
            </tr>
        </tfoot>
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
              echo "<td>$arreglo[5]</td>";
              echo "<td>$arreglo[6]</td>";
              $monto=number_format((floatval($arreglo[7])),2,".",",");
              echo "<td class='valores'>$monto</td>";
              $monto2=number_format((floatval($arreglo[8])),2,".",",");
              echo "<td class='valores'>$monto2</td>";
              echo "<td><a href='../views/update_otros.php?id=$arreglo[0]'>Modificar</a><a href='../controller/delete_otros.php?id=$arreglo[0]'>Eliminar</a></td>";
              if ($_SESSION["user_id"]==0) {
                $sql2=("SELECT * FROM usuario where ci=\"$arreglo[9]\"");
                $query2=mysqli_query($con,$sql2);
                $nombre=mysqli_fetch_array($query2);
                echo "<td>$nombre[1] $nombre[2]</td>";
              }
              echo "</tr>";
            }
            mysqli_close($con);
            ?>
      </tbody>
    </table>
    <br>
    <h1 class="titulo"><center>CONTRATOS DE LICENCIA DE FUNCIONAMIENTO</center></h1>
    <br>
    <table id="example" class="display table table-bordered table-hover nowrap compact" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th colspan="2">FECHA</th>
                <th>ESTADO DEL CTTO</th>
                <th>SOLICITUD</th>
                <th>PAGO</th>
            </tr>
            <tr>
                <th>NRO</th>
                <th>REGIONAL</th>
                <th>CENTRO FOCAL</th>
                <th>TIPO CENTRO FOCAL</th>
                <th>EMISION</th>
                <th>VENCIMIENTO</th>
                <th>CONFIRMAR DATO</th>
                <th>RESPALDO</th>
                <th></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>NRO</th>
                <th>REGIONAL</th>
                <th>CENTRO FOCAL</th>
                <th>TIPO CENTRO FOCAL</th>
                <th>EMISION</th>
                <th>VENCIMIENTO</th>
                <th>CONFIRMAR DATO</th>
                <th>RESPALDO</th>
                <th></th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th colspan="2">FECHA</th>
                <th>ESTADO DEL CTTO</th>
                <th>SOLICITUD</th>
                <th>PAGO</th>
            </tr>
        </tfoot>
        <tbody>
        <?php  
            $count=0;
            require("../controller/conexion.php");
            if ($_SESSION["user_id"]==0 || $_SESSION["regional"]=="OF. NACIONAL") {
                $sql=("SELECT * FROM licenciafun ORDER BY fecha_fin");
            }
            else{
                $sql=("SELECT * FROM licenciafun where region=\"$_SESSION[regional]\" ORDER BY fecha_fin");
            }
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
              if($arreglo[5]>date("Y-m-d")){
                echo "<td>Contrato Vigente</td>";
              }
              else{
                echo "<td>Vencido</td>";
              }
              if ($arreglo[6]!=null) {
                echo "<td><a href='../files/licenciafun/respaldo/$arreglo[6]' target='_blank'>Ver documento de respaldo</td>";
              }
              else{
                echo "<td>No se subió documento de respaldo</td>";
              }
              
              if ($_SESSION["user_id"]==0) {
                echo "<td><a href='../views/update_funcionamiento.php?id=$arreglo[0]'>Modificar || </a><a href='../controller/baja_funcionamiento.php?id=$arreglo[0]'>Dar de baja</a></td>";
              }
              echo "</tr>";
            }
            mysqli_close($con);
            ?>
      </tbody>
    </table>
    <script src='../plugins/js/jquery-2.2.4.min.js'></script>
    <script src='../plugins/js/jquery.dataTables.min.js'></script>
    <script src='../plugins/js/dataTables.buttons.min.js'></script>
    <script src='../plugins/js/buttons.flash.min.js'></script>
    <script src='../plugins/js/jszip.min.js'></script>
    <script src='../plugins/js/pdfmake.min.js'></script>
    <script src='../plugins/js/vfs_fonts.js'></script>
    <script src='../plugins/js/buttons.html5.min.js'></script>
    <script src='../plugins/js/buttons.print.min.js'></script>
    <script src="../js/cabecera.js"></script> 
    <script type="text/javascript">
        $(document).ready(function() {
    $('#example').DataTable( {
        "paging":   false,
        "info":     false,
        language: {
        "decimal": ".",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    },
    //Añadir Scroll
        //"scrollY":        "50vh",//define el tamaño o dinamismo de la tabla
        //"scrollCollapse": true,
        //"paging":         false,
    dom: 'Bfrtip',
        buttons: [
            'csv', 'print',
    ]
    } );
} );
    </script>
    
</body>
</html>

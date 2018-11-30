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
  <title>Limpieza</title>
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
            <li><a href="../views/add_limpieza.php"><span><font color="red">Añadir contratos de limpieza</font></span></a></li>
            <li><a href="../views/update_password.php?id=<?php echo $_SESSION['user_id']; ?>"><span><font color="red">Cambiar contraseña</font></span></a></li>
            <li><a href="../controller/logout.php"><span><font color="red">Salir: <?php echo $_SESSION["nombres"]  ?></font></span></a></li>
        </ul>

        <span aria-hidden="true" class="stretchy-nav-bg"></span>
    </nav>
    <br>
    <br>
    <h1 class="titulo"><center>CONTRATOS DE LIMPIEZA</center></h1>
    <br>
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
            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\Exception;
            require '../phpmailer/Exception.php';
            require '../phpmailer/PHPMailer.php';
            require '../phpmailer/SMTP.php';
            $count=0;
            $sumabs=0;
            $sumasus=0;
            require("../controller/conexion.php");
             if ($_SESSION["user_id"]==0 || $_SESSION["regional"]=="OF. NACIONAL") {
                $sql=("SELECT * FROM limpieza");
            }
            else{
                $sql=("SELECT * FROM limpieza where region=\"$_SESSION[regional]\"");
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
                  $campo="vigente";
              }
              if ($arreglo[6]<$nuevo && $arreglo[6]>date("Y-m-d")) {
                  $campo="notificado";
                  if ($arreglo[11]!=""&&$arreglo[13]!=1) {
                    if ($arreglo[6]<$nuevo2 && $arreglo[6]>date("Y-m-d")) {
                            if ($arreglo[14]!=1) {
                                $mail = new PHPMailer(true);                              
                                try {
                                    include "mail_config.php";
                                    //Recipients
                                    $mail->setFrom($_SESSION["email"], $_SESSION["nombres"]);
                                    $varios = explode(";",$arreglo[11]);
                                    for ($i=0; $i <count($varios) ; $i++) { 
                                        $mail->addAddress($varios[$i], 'Remitente de ProMujer');
                                    }
                                    $mail->isHTML(true);
                                    $mail->Subject = "Notificacion de conclusion de contrato";
                                    $mail->Body    = "Promujer informa que su contrato de limpieza de $arreglo[4] para el centro focal $arreglo[2] vencerá en aproximadamente un mes, Que tenga una exelente jornada";
                                    $mail->send();
                                    $sql1= "UPDATE limpieza set noti2=1 where id_lim=$arreglo[0]";
                                    $query1 = $con->query($sql1);
                                    echo "<script>alert(\"Se envio un correo electronico de notificacion a $arreglo[4]\");window.location='../views/limpieza.php';</script>";
                                } catch (Exception $e) {
                                    echo "<h2>Error, No se puede enviar correos, verifique su conexion a internet o si los datos para el servidor son correctos</h2>"; 
                                    echo $mail->ErrorInfo;
                                }
                            }
                  }
                  else{
                                $mail = new PHPMailer(true);                              
                                try {
                                    include "mail_config.php";
                                    //Recipients
                                    $mail->setFrom($_SESSION["email"], $_SESSION["nombres"]);
                                    $varios = explode(";",$arreglo[11]);
                                    for ($i=0; $i <count($varios) ; $i++) { 
                                        $mail->addAddress($varios[$i], 'Remitente de ProMujer');
                                    }
                                    $mail->isHTML(true);
                                    $mail->Subject = "Notificacion de conclusion de contrato";
                                    $mail->Body    = "Promujer informa que su contrato de limpieza de $arreglo[4] para el centro focal $arreglo[2] vencerá en aproximadamente dos meses, Que tenga una exelente jornada";
                                    $mail->send();
                                    $sql1= "UPDATE limpieza set noti1=1 where id_lim=$arreglo[0]";
                                    $query1 = $con->query($sql1);
                                    echo "<script>alert(\"Se envio un correo electronico de notificacion a $arreglo[4]\");window.location='../views/limpieza.php';</script>";
                                } catch (Exception $e) {
                                    echo "<h2>Error, No se puede enviar correos, verifique su conexion a internet o si los datos para el servidor son correctos</h2>"; 
                                    echo $mail->ErrorInfo;
                                }
                  }
                    }    
              }
              $nuevo3=strtotime("+1 week",strtotime($confi));
              $nuevo3=date("Y-m-d",$nuevo3);
              if ($arreglo[6]<date("Y-m-d")) {
                  $campo="vencido";
                  if ($arreglo[12]!=""&&$arreglo[15]!=1) {
                        if ($arreglo[6]<$nuevo3 && $arreglo[6]<date("Y-m-d")) {
                            if ($arreglo[16]!=1) {
                                $mail = new PHPMailer(true);                              
                                try {
                                    include "mail_config.php";
                                    //Recipients
                                    $mail->setFrom($_SESSION["email"], $_SESSION["nombres"]);
                                    $varios = explode(";",$arreglo[12]);
                                    for ($i=0; $i <count($varios) ; $i++) { 
                                        $mail->addAddress($varios[$i], 'Remitente de ProMujer');
                                    }
                                    $mail->isHTML(true);
                                    $mail->Subject = "Notificacion de conclusion de contrato";
                                    $mail->Body    = "Promujer informa que su contrato de limpieza de $arreglo[4] para el centro focal $arreglo[2] lleva mas de una semana de vencido, Que tenga una exelente jornada";
                                    $mail->send();
                                    $sql1= "update limpieza set noti4=1 where id_lim=$arreglo[0]";
                                    $query1 = $con->query($sql1);
                                    echo "<script>alert(\"Se envio un correo electronico de notificacion a $arreglo[4]\");window.location='../views/limpieza.php';</script>";
                                } catch (Exception $e) {
                                    echo "<h2>Error, No se puede enviar correos, verifique su conexion a internet o si los datos para el servidor son correctos</h2>"; 
                                    echo $mail->ErrorInfo;
                                }
                            }
                        }
                        else{
                            $mail = new PHPMailer(true);                              
                                try {
                                    include "mail_config.php";
                                    //Recipients
                                    $mail->setFrom($_SESSION["email"], $_SESSION["nombres"]);
                                    $varios = explode(";",$arreglo[12]);
                                    for ($i=0; $i <count($varios) ; $i++) { 
                                        $mail->addAddress($varios[$i], 'Remitente de ProMujer');
                                    }
                                    $mail->isHTML(true);
                                    $mail->Subject = "Notificacion de conclusion de contrato";
                                    $mail->Body    = "Promujer informa que su contrato de limpieza de $arreglo[4] para el centro focal $arreglo[2] acaba de vencer, Que tenga una exelente jornada";
                                    $mail->send();
                                    $sql1= "update limpieza set noti3=1 where id_lim=$arreglo[0]";
                                    $query1 = $con->query($sql1);
                                    echo "<script>alert(\"Se envio un correo electronico de notificacion a $arreglo[4]\");window.location='../views/limpieza.php';</script>";
                                } catch (Exception $e) {
                                    echo "<h2>Error, No se puede enviar correos, verifique su conexion a internet o si los datos para el servidor son correctos</h2>"; 
                                    echo $mail->ErrorInfo;
                                }
                        }
                  }
              }
              if ($arreglo[6]=="0000-00-00"||$arreglo[6]==null) {
                  $campo=null;
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
      <table class="display table table-bordered table-hover nowrap compact" cellspacing="0" width="100%">
                <thead>
                    <th>REGIONAL</th>
                    <th>TOTAL BS</th>
                </thead>
                <tfoot>
                    <th>REGIONAL</th>
                    <th>TOTAL BS</th>
                </tfoot>
                <tbody>
                    <?php 
                        if ($_SESSION["user_id"]==0 || $_SESSION["regional"]=="OF. NACIONAL") {
                            $sql2=("SELECT region,sum(canon_mensual) from limpieza group by region");
                        }
                        else{
                            $sql2=("SELECT region,sum(canon_mensual) from limpieza where region=\"$_SESSION[regional]\"");
                        }
                        $query2=mysqli_query($con,$sql2);
                        while($arreglo2=mysqli_fetch_array($query2)){
                            echo "<tr id='adorno'>";
                            echo "<td>$arreglo2[0]</td>";
                            $monto=number_format((floatval($arreglo2[1])),2,".",",");
                            echo "<td class='valores'>$monto</td>";
                        }
                        echo "<tr>";
                        echo "<td><b>TOTAL</b></td>";
                        $monto=number_format((floatval($sumabs)),2,".",",");
                        echo "<td class='valores'>$monto</td>";
                        echo "</tr>";
                        mysqli_close($con);
                     ?>
                </tbody>
            </table>
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
            'excel',
    ]
    } );
} );
    </script>
    
</body>
</html>

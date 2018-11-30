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
  <title>Otros contratos</title>
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
            <li><a href="../views/add_otros.php"><span><font color="red">Añadir otros contratos</font></span></a></li>
            <li><a href="../views/update_password.php?id=<?php echo $_SESSION['user_id']; ?>"><span><font color="red">Cambiar contraseña</font></span></a></li>
            <li><a href="../controller/logout.php"><span><font color="red">Salir: <?php echo $_SESSION["nombres"]  ?></font></span></a></li>
        </ul>

        <span aria-hidden="true" class="stretchy-nav-bg"></span>
    </nav>
    <br>
    <br>
    <h1 class="titulo"><center>OTROS CONTRATOS</center></h1>
    <br>
    <br>
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
            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\Exception;
            require '../phpmailer/Exception.php';
            require '../phpmailer/PHPMailer.php';
            require '../phpmailer/SMTP.php';
            $count=0;
            require("../controller/conexion.php");
            $sql=("SELECT * FROM otros_contratos");
            $query=mysqli_query($con,$sql);
            while($arreglo=mysqli_fetch_array($query)){
                $count++;
                $confi=date("Y-m-d");
              $nuevo=strtotime("+2 month",strtotime($confi));
              $nuevo=date("Y-m-d",$nuevo);
              $nuevo2=strtotime("+1 month",strtotime($confi));
              $nuevo2=date("Y-m-d",$nuevo2);
              if ($arreglo[4]>date("Y-m-d")) {
                  $campo="vigente";
              }
              if ($arreglo[4]<$nuevo && $arreglo[4]>date("Y-m-d")) {
                  $campo="notificado";
                  if ($arreglo[10]!=""&&$arreglo[12]!=1) {
                    if ($arreglo[4]<$nuevo2 && $arreglo[4]>date("Y-m-d")) {
                            if ($arreglo[13]!=1) {
                                $mail = new PHPMailer(true);                              
                                try {
                                    include "mail_config.php";
                                    //Recipients
                                    $mail->setFrom($_SESSION["email"], $_SESSION["nombres"]);
                                    $varios = explode(";",$arreglo[10]);
                                    for ($i=0; $i <count($varios) ; $i++) { 
                                        $mail->addAddress($varios[$i], 'Remitente de ProMujer');
                                    }
                                    $mail->isHTML(true);
                                    $mail->Subject = "Notificacion de conclusion de contrato";
                                    $mail->Body    = "Promujer informa a la empresa $arreglo[1] por el concepto de $arreglo[2] que le quedan menos de un mes para su conclusion, Que tenga una excelente jornada";
                                    $mail->send();
                                    $sql1= "UPDATE otros_contratos set noti2=1 where id_ot=$arreglo[0]";
                                    $query1 = $con->query($sql1);
                                    echo "<script>alert(\"Se envio un correo electronico de notificacion a $arreglo[1]\");window.location='../views/otros.php';</script>";
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
                                    $varios = explode(";",$arreglo[10]);
                                    for ($i=0; $i <count($varios) ; $i++) { 
                                        $mail->addAddress($varios[$i], 'Remitente de ProMujer');
                                    }
                                    $mail->isHTML(true);
                                    $mail->Subject = "Notificacion de conclusion de contrato";
                                    $mail->Body    = "Promujer informa a la empresa $arreglo[1] por el concepto de $arreglo[2] que le quedan menos de dos meses para su conclusion, Que tenga una excelente jornada";
                                    $mail->send();
                                    $sql1= "UPDATE otros_contratos set noti1=1 where id_ot=$arreglo[0]";
                                    $query1 = $con->query($sql1);
                                    echo "<script>alert(\"Se envio un correo electronico de notificacion a $arreglo[1]\");window.location='../views/otros.php';</script>";
                                } catch (Exception $e) {
                                    echo "<h2>Error, No se puede enviar correos, verifique su conexion a internet o si los datos para el servidor son correctos</h2>"; 
                                    echo $mail->ErrorInfo;
                                }
                  }
                    }    
              }
              $nuevo3=strtotime("+1 week",strtotime($confi));
              $nuevo3=date("Y-m-d",$nuevo3);
              if ($arreglo[4]<date("Y-m-d")) {
                  $campo="vencido";
                  if ($arreglo[11]!=""&&$arreglo[14]!=1) {
                        if ($arreglo[4]<$nuevo3 && $arreglo[4]<date("Y-m-d")) {
                            if ($arreglo[15]!=1) {
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
                                    $mail->Body    = "Promujer informa a la empresa $arreglo[1] por el concepto de $arreglo[2] que lleva mas de una semana de vencido, Que tenga una excelente jornada";
                                    $mail->send();
                                    $sql1= "update otros_contratos set noti4=1 where id_ot=$arreglo[0]";
                                    $query1 = $con->query($sql1);
                                    echo "<script>alert(\"Se envio un correo electronico de notificacion a $arreglo[1]\");window.location='../views/otros.php';</script>";
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
                                    $mail->Body    = "Promujer informa a la empresa $arreglo[1] por el concepto de $arreglo[2] acaba de vencer, Que tenga una excelente jornada";
                                    $mail->send();
                                    $sql1= "update otros_contratos set noti3=1 where id_ot=$arreglo[0]";
                                    $query1 = $con->query($sql1);
                                    echo "<script>alert(\"Se envio un correo electronico de notificacion a $arreglo[1]\");window.location='../views/otros.php';</script>";
                                } catch (Exception $e) {
                                    echo "<h2>Error, No se puede enviar correos, verifique su conexion a internet o si los datos para el servidor son correctos</h2>"; 
                                    echo $mail->ErrorInfo;
                                }
                        }
                  }
              }
              if ($arreglo[4]=="") {
                  $campo=null;
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

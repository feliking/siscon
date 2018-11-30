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
  <title>Licencia de publicidad</title>
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
            background-color: #73C8A9;
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
    </style>
</head>
<body>
    <nav class="cd-stretchy-nav">
        <a class="cd-nav-trigger" href="#0">
            
            <span aria-hidden="true"></span>
        </a>

        <ul>
            <li><a href="../views/page_user.php" class="active"><span><font color="red">Tareas Principales</font></span></a></li>
            <li><a href="../views/add_publicidad.php"><span><font color="red">Añadir licencia de publicidad</font></span></a></li>
            <li><a href="../views/update_password.php?id=<?php echo $_SESSION['user_id']; ?>"><span><font color="red">Cambiar contraseña</font></span></a></li>
            <li><a href="../controller/logout.php"><span><font color="red">Salir: <?php echo $_SESSION["nombres"]  ?></font></span></a></li>
        </ul>

        <span aria-hidden="true" class="stretchy-nav-bg"></span>
    </nav>
    <br>
    <br>
    <h1 class="titulo"><center>LICENCIA DE PUBLICIDAD</center></h1>
    <br>
    <br>
    <br>
    <table id="example" class="display table table-bordered table-hover nowrap compact" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th rowspan="2">CUENTA CON LICENCIAS DE PUBLICIDAD, PERMISOS SI/NO</th>
                <th colspan="3">ADOSADA</th>
                <th>PINTADA</th>
                <th>MICROPERFORADA</th>
                <th>AUTOPORTANTES</th>
                <th rowspan="2">FECHA DE EMISION</th>
                <th rowspan="2">FECHA DE VENCIMIENTO</th>
                <th rowspan="2">AÑOS DE VIGENCIA</th>
                <th rowspan="2">SE CUENTA CON DOCUMENTO ESCANEADO EN ARCHIVO</th>
                <th rowspan="2">ESTADO DE LA LICENCIA</th>
                <th rowspan="2">OBSERVACIONES</th>
                <th>PAGO PATENTES</th>
                <th>RESPALDO PATENTES</th>
                <?php if ($_SESSION["user_id"]==0) {
                  echo "<th></th>";
                    echo "<th rowspan='2'>AÑADIDO POR:</th>";
                } ?>
            </tr>
            <tr>
                <th>NRO</th>
                <th>REGIONAL</th>
                <th>CENTRO FOCAL</th>
                <th>SI/NO</th>
                <th>VIGENCIA</th>
                <th>DOCUMENTO ESCANEADO</th>
                <th>SI/NO</th>
                <th>SI/NO</th>
                <th>SI/NO</th>
                <th></th>
                <th></th>
                <?php if ($_SESSION["user_id"]==0) {
                    echo "<th></th>";
                } ?>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th rowspan="2">CUENTA CON LICENCIAS DE PUBLICIDAD, PERMISOS SI/NO</th>
                <th colspan="3">ADOSADA</th>
                <th>PINTADA</th>
                <th>MICROPERFORADA</th>
                <th>AUTOPORTANTES</th>
                <th rowspan="2">FECHA DE EMISION</th>
                <th rowspan="2">FECHA DE VENCIMIENTO</th>
                <th rowspan="2">AÑOS DE VIGENCIA</th>
                <th rowspan="2">SE CUENTA CON DOCUMENTO ESCANEADO EN ARCHIVO</th>
                <th rowspan="2">ESTADO DE LA LICENCIA</th>
                <th rowspan="2">OBSERVACIONES</th>
                <th>PAGO PATENTES</th>
                <th>RESPALDO PATENTES</th>
                <?php if ($_SESSION["user_id"]==0) {
                  echo "<th></th>";
                    echo "<th rowspan='2'>AÑADIDO POR:</th>";
                } ?>
            </tr>
            <tr>
                <th>NRO</th>
                <th>REGIONAL</th>
                <th>CENTRO FOCAL</th>
                <th>SI/NO</th>
                <th>VIGENCIA</th>
                <th>DOCUMENTO ESCANEADO</th>
                <th>SI/NO</th>
                <th>SI/NO</th>
                <th>SI/NO</th>
                <th></th>
                <th></th>
                <?php if ($_SESSION["user_id"]==0) {
                    echo "<th></th>";
                } ?>
            </tr>
        </tfoot>
        <tbody>
        <?php  
            $count=0;
            require("../controller/conexion.php");
            if ($_SESSION["user_id"]==0 || $_SESSION["regional"]=="OF. NACIONAL") {
                $sql=("SELECT * FROM licenpu");
            }
            else{
                $sql=("SELECT * FROM licenpu where region=\"$_SESSION[regional]\"");
            }
            $query=mysqli_query($con,$sql);
            while($arreglo=mysqli_fetch_array($query)){
                $count++;
                 $confi=date("Y-m-d");
              $nuevo=strtotime("+2 month",strtotime($confi));
              $nuevo=date("Y-m-d",$nuevo);
              if ($arreglo[11]>date("Y-m-d")) {
                  $campo="vigente";
              }
              if ($arreglo[11]<$nuevo && $arreglo[11]>date("Y-m-d")) {
                  $campo="notificado";
              }
              if ($arreglo[11]<date("Y-m-d")) {
                  $campo="vencido";
              }
              if ($arreglo[11]=="0000-00-00") {
                  $campo=null;
              }
              echo "<tr id='$campo'>";
              echo "<td>$count</td>";
              echo "<td>$arreglo[1]</td>";
              echo "<td>$arreglo[2]</td>";
              echo "<td>$arreglo[3]</td>";
              echo "<td>$arreglo[4]</td>";
              echo "<td>$arreglo[5]</td>";
              if ($arreglo[6]!=null) {
                echo "<td><a href='../files/licenciapubli/adosada/$arreglo[6]' target='_blank'>Ver documento de respaldo</td>";
              }
              else{
                echo "<td>No se subió documento de respaldo</td>";
              }
              echo "<td>$arreglo[7]</td>";
              echo "<td>$arreglo[8]</td>";
              echo "<td>$arreglo[9]</td>";
              $fecha2=strftime("%d/%m/%Y",strtotime($arreglo[10]));
              echo "<td>$fecha2</td>";
              $fecha3=strftime("%d/%m/%Y",strtotime($arreglo[11]));
              echo "<td>$fecha3</td>";
              $duracion=intval($arreglo[11])-intval($arreglo[10]);
              echo "<td>$duracion</td>";
              if ($arreglo[12]!=null) {
                echo "<td><a href='../files/licenciapubli/respaldo/$arreglo[12]' target='_blank'>Ver documento de respaldo</td>";
              }
              else{
                echo "<td>No se subió documento de respaldo</td>";
              }
              if($arreglo[11]>date("Y-m-d")){
                echo "<td>Contrato Vigente</td>";
              }
              else{
                echo "<td>Vencido</td>";
              }
              echo "<td>$arreglo[13]</td>";
              echo "<td>$arreglo[14]</td>";
              if ($arreglo[15]!=null) {
                echo "<td><a href='../files/licenciapubli/patentes/$arreglo[15]' target='_blank'>Ver documento de respaldo</td>";
              }
              else{
                echo "<td>No se subió documento de respaldo</td>";
              }
              
              if ($_SESSION["user_id"]==0) {
                echo "<td><a href='../views/update_publicidad.php?id=$arreglo[0]'>Modificar</a><a href='../controller/delete_publicidad.php?id=$arreglo[0]'>Eliminar</a></td>";
                $sql2=("SELECT * FROM usuario where ci=\"$arreglo[16]\"");
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

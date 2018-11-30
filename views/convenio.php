<?php
session_start();
if(isset($_SESSION["tipo"])){
    if($_SESSION["tipo"]==null){
        print "<script>alert(\"Debe identificarse para ingresar al sistema\");window.location='../index.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Recojo de residuos</title>
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
    </style>
</head>
<body>
    <nav class="cd-stretchy-nav">
        <a class="cd-nav-trigger" href="#0">
            
            <span aria-hidden="true"></span>
        </a>

        <ul>
            <li><a href="../views/page_user.php" class="active"><span><font color="red">Tareas Principales</font></span></a></li>
            <li><a href="../views/add_convenio.php"><span><font color="red">Añadir contrato de recojo de residuos</font></span></a></li>
            <li><a href="../views/update_user.php"><span><font color="red">Cambiar contraseña</font></span></a></li>
            <li><a href="../controller/logout.php"><span><font color="red">Salir: <?php echo $_SESSION["nombres"]  ?></font></span></a></li>
        </ul>

        <span aria-hidden="true" class="stretchy-nav-bg"></span>
    </nav>
    <br>
    <br>
    <h1 class="titulo"><center>CONTRATOS DE RECOJO DE RESIDUOS</center></h1>
    <br>
    <br>
    <br>
  <table id="example" class="display table table-bordered table-hover nowrap compact" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>REGIONAL</th>
                <th>NOMBRE EMPRESA</th>
                <th colspan="2">CONVENIO</th>
                <th rowspan="2">EMITIDO FECHA</th>
                <th rowspan="2">FECHA VENCIMIENTO</th>
                <th rowspan="2">VIGENCIA AÑOS</th>
                <th rowspan="2">COSTO Bs.</th>
                <th rowspan="2">ESTADO</th>
                <th rowspan="2">OBSERVACION</th>
                <?php if ($_SESSION["user_id"]==0) {
                    echo "<th rowspan='2'>AÑADIDO POR</th>";
                } ?>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th>CUANTA SI/NO</th>
                <th>SOLICITUD RESPALDO</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>REGIONAL</th>
                <th>NOMBRE EMPRESA</th>
                <th colspan="2">CONVENIO</th>
                <th rowspan="2">EMITIDO FECHA</th>
                <th rowspan="2">FECHA VENCIMIENTO</th>
                <th rowspan="2">VIGENCIA AÑOS</th>
                <th rowspan="2">COSTO Bs.</th>
                <th rowspan="2">ESTADO</th>
                <th rowspan="2">OBSERVACION</th>
                <?php if ($_SESSION["user_id"]==0) {
                    echo "<th rowspan='2'>AÑADIDO POR</th>";
                } ?>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th>CUANTA SI/NO</th>
                <th>SOLICITUD RESPALDO</th>
            </tr>
        </tfoot>
        <tbody>
        <?php  
            require("../controller/conexion.php");
            $sql=("SELECT * FROM convenio");
            $query=mysqli_query($con,$sql);
            while($arreglo=mysqli_fetch_array($query)){
              echo "<tr>";
              echo "<td>$arreglo[1]</td>";
              echo "<td>$arreglo[2]</td>";
              echo "<td>$arreglo[3]</td>";
              if ($arreglo[4]!=null) {
                echo "<td><a href='../files/convenio/respaldo/$arreglo[4]' target='_blank'>Ver documento de respaldo</td>";
              }
              else{
                echo "<td>No se subió documento de respaldo</td>";
              }
              $fecha=strftime("%d/%m/%Y",strtotime($arreglo[5]));
              echo "<td>$fecha</td>";
              $fecha2=strftime("%d/%m/%Y",strtotime($arreglo[6]));
              echo "<td>$fecha2</td>";
              $duracion=intval($arreglo[6])-intval($arreglo[5]);
              echo "<td>$duracion</td>";
              $monto=number_format((floatval($arreglo[7])),2,".",",");
              echo "<td class='valores'>$monto</td>";
              if($arreglo[6]>date("Y-m-d")){
                echo "<td>Contrato Vigente</td>";
              }
              else{
                echo "<td>Vencido</td>";
              }
              echo "<td>$arreglo[8]</td>";
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

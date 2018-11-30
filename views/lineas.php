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
  <title>Líneas telefonicas</title>
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
            <li><a href="../views/add_lineas.php"><span><font color="red">Añadir contratos de lineas telefonicas</font></span></a></li>
            <li><a href="../views/update_password.php?id=<?php echo $_SESSION['user_id']; ?>"><span><font color="red">Cambiar contraseña</font></span></a></li>
            <li><a href="../controller/logout.php"><span><font color="red">Salir: <?php echo $_SESSION["nombres"]  ?></font></span></a></li>
        </ul>

        <span aria-hidden="true" class="stretchy-nav-bg"></span>
    </nav>
    <br>
    <br>
    <h1 class="titulo"><center>CONTRATOS DE LINEAS TELEFONICAS</center></h1>
    <br>
    <br>
    <br>
  <table id="example" class="display table table-bordered table-hover nowrap compact" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>NRO</th>
                <th>REGION</th>
                <th>NOMBRE REGIONAL</th>
                <th>NUMERO DE LINEA EXTERNA</th>
                <th>NUMERO DE LINEA ACTUAL</th>
                <th>PROVEEDOR</th>
                <th>DESCRIPCION</th>
                <th>TIPO</th>
                <th>PERMISOS</th>
                <th>NRO DE CONTRATO</th>
                <th>PROPIEDAD DE PROMUJER/ALQUILADA/GEMELA</th>
                <th>CATEGORÍA</th>
                <th>NRO. CONTRATO</th>
                <th>DOCUMENTO QUE RESPALDA</th>
                <th>CERTIFICADO DE APORTACION ESCANEADO</th>
                <th>VALOR DE SUSCRIPCION EN $us</th>
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
                <th>NOMBRE REGIONAL</th>
                <th>NUMERO DE LINEA EXTERNA</th>
                <th>NUMERO DE LINEA ACTUAL</th>
                <th>PROVEEDOR</th>
                <th>DESCRIPCION</th>
                <th>TIPO</th>
                <th>PERMISOS</th>
                <th>NRO DE CONTRATO</th>
                <th>PROPIEDAD DE PROMUJER/ALQUILADA/GEMELA</th>
                <th>CATEGORÍA</th>
                <th>NRO. CONTRATO</th>
                <th>DOCUMENTO QUE RESPALDA</th>
                <th>CERTIFICADO DE APORTACION ESCANEADO</th>
                <th>VALOR DE SUSCRIPCION EN $us</th>
                <?php if ($_SESSION["user_id"]==0) {
                    echo "<th></th>";
                    echo "<th>AÑADIDO POR:</th>";
                } ?>
            </tr>
        </tfoot>
        <tbody>
        <?php  
            $count=0;
            require("../controller/conexion.php");
            if ($_SESSION["user_id"]==0) {
                $sql=("SELECT * FROM lineas");
            }
            else{
                $sql=("SELECT * FROM lineas where region=\"$_SESSION[regional]\"");
            }
            $query=mysqli_query($con,$sql);
            while($arreglo=mysqli_fetch_array($query)){
                $count++;
              echo "<tr>";
              echo "<td>$count</td>";
              echo "<td>$arreglo[1]</td>";
              echo "<td>$arreglo[2]</td>";
              echo "<td>$arreglo[3]</td>";
              echo "<td>$arreglo[4]</td>";
              echo "<td>$arreglo[5]</td>";
              echo "<td>$arreglo[6]</td>";
              echo "<td>$arreglo[7]</td>";
              echo "<td>$arreglo[8]</td>";
              echo "<td>$arreglo[9]</td>";
              echo "<td>$arreglo[10]</td>";
              echo "<td>$arreglo[11]</td>";
              echo "<td>$arreglo[12]</td>";
              echo "<td>$arreglo[13]</td>";
              if ($arreglo[14]!=null) {
                echo "<td><a href='../files/lineastel/aportacion/$arreglo[14]' target='_blank'>Ver documento de respaldo</td>";
              }
              else{
                echo "<td>No se subió documento de respaldo</td>";
              }
              $monto=number_format((floatval($arreglo[15])),2,".",",");
              echo "<td class='valores'>$monto</td>";
              
              if ($_SESSION["user_id"]==0) {
                echo "<td><a href='../views/update_lineas.php?id=$arreglo[0]'>Modificar</a><a href='../controller/delete_lineas.php?id=$arreglo[0]'>Eliminar</a></td>";
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
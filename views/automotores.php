<?php
session_start();
if(!isset($_SESSION["tipo"])){
        print "<script>alert(\"Acceso denegado, Debe identificarse para ingresar al sistema\");window.location='../index.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Impuesto automotores</title>
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
            background-color: #FFC219;
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
            <li><a href="../views/add_automotores.php"><span><font color="red">Añadir impuestos automotores</font></span></a></li>
            <li><a href="../views/update_password.php?id=<?php echo $_SESSION['user_id']; ?>"><span><font color="red">Cambiar contraseña</font></span></a></li>
            <li><a href="../controller/logout.php"><span><font color="red">Salir: <?php echo $_SESSION["nombres"]  ?></font></span></a></li>
        </ul>

        <span aria-hidden="true" class="stretchy-nav-bg"></span>
    </nav>
    <br>
    <br>
    <h1 class="titulo"><center>IMPUESTOS AUTOMOTORES</center></h1>
    <br>
    <br>
    <br>
  <table id="example" class="display table table-bordered table-hover compact" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>NRO</th>
                <th>PROPIETARIO</th>
                <th>TIPO</th>
                <th>MARCA</th>
                <th>MODELO</th>
                <th>PLACA</th>
                <th>AÑO</th>
                <th>MOTOR</th>
                <th>CHASIS</th>
                <th>COLOR</th>
                <th>PLAZA DE CIRCULACION</th>
                <th>NRO DE OCUPANTES</th>
                <th>VALOR COMERCIAL EN $US</th>
                <th>DOCUMENTOS DE PROPIEDAD</th>
                <th>DOCUMENTO ESCANEADO RUAT</th>
                <th>PAGO DE IMPUESTO VIGENTE/GESTION</th>
                <th>IMPUESTO ESCANEADO</th>
                <th>OBSERVACIONES</th>
                <th>COMODATO</th>
                <th>MONTO PAGADO</th>
                <th>POLIZA</th>
                <th>OTROS DOCUMENTOS</th>
                <th>INSPECCION TECNICA VEHICULAR</th>
                <th>DOCUMENTO INSPECCION VEHICULAR</th>
                <th>FECHA EXTINTOR</th>
                <th>VIGENTE/VENCIDA(EXTINTOR)</th>
                <th>TRIANGULO</th>
                <th>HERRAMIENTAS</th>
                <th>DOCUMENTOS DE PROPIEDAD</th>
                <?php if ($_SESSION["user_id"]==0) {
                    echo "<th></th>";
                    echo "<th>AÑADIDO POR:</th>";
                } ?>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>NRO</th>
                <th>PROPIETARIO</th>
                <th>TIPO</th>
                <th>MARCA</th>
                <th>MODELO</th>
                <th>PLACA</th>
                <th>AÑO</th>
                <th>MOTOR</th>
                <th>CHASIS</th>
                <th>COLOR</th>
                <th>PLAZA DE CIRCULACION</th>
                <th>NRO DE OCUPANTES</th>
                <th>VALOR COMERCIAL EN $US</th>
                <th>DOCUMENTOS DE PROPIEDAD</th>
                <th>DOCUMENTO ESCANEADO RUAT</th>
                <th>PAGO DE IMPUESTO VIGENTE/GESTION</th>
                <th>IMPUESTO ESCANEADO</th>
                <th>OBSERVACIONES</th>
                <th>COMODATO</th>
                <th>MONTO PAGADO</th>
                <th>POLIZA</th>
                <th>OTROS DOCUMENTOS</th>
                <th>INSPECCION TECNICA VEHICULAR</th>
                <th>DOCUMENTO INSPECCION VEHICULAR</th>
                <th>FECHA EXTINTOR</th>
                <th>VIGENTE/VENCIDA(EXTINTOR)</th>
                <th>TRIANGULO</th>
                <th>HERRAMIENTAS</th>
                <th>DOCUMENTOS DE PROPIEDAD</th>
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
            if ($_SESSION["user_id"]==0 || $_SESSION["regional"]=="OF. NACIONAL") {
                $sql=("SELECT * FROM automoviles");
            }
            else{
                $sql=("SELECT * FROM automoviles where plaza_circulacion=\"$_SESSION[regional]\"");
            }
            $query=mysqli_query($con,$sql);
            while($arreglo=mysqli_fetch_array($query)){
                $count++;
              $confi=date("Y-m-d");
              $nuevo=strtotime("-1 year",strtotime($confi));
              $nuevo=date("Y-m-d",$nuevo);
              $confi=date("Y-m-d");
              $nuevo2=strtotime("-2 year",strtotime($confi));
              $nuevo2=date("Y-m-d",$nuevo2);
              if ($arreglo[15]>=date("Y")) {
                $campo="vigente";
              }
              if ($arreglo[15]<=$nuevo) {
                $campo="notificado";
              }
              if ($arreglo[15]<=$nuevo2) {
                $campo="vencido";
              }
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
              $monto2=number_format((floatval($arreglo[12])),2,".",",");
              echo "<td class='valores'>$monto2</td>";
              echo "<td>$arreglo[13]</td>";
              if ($arreglo[14]!=null) {
                echo "<td><a href='../files/impuestoauto/ruat/$arreglo[14]' target='_blank'>Ver documento de respaldo</td>";
              }
              else{
                echo "<td>No se subió documento de respaldo</td>";
              }
              echo "<td id='$campo'>$arreglo[15]</td>";
              if ($arreglo[16]!=null) {
                echo "<td><a href='../files/impuestoauto/impuesto/$arreglo[16]' target='_blank'>Ver documento de respaldo</td>";
              }
              else{
                echo "<td>No se subió documento de respaldo</td>";
              }
              echo "<td>$arreglo[17]</td>";
              echo "<td>$arreglo[18]</td>";
              echo "<td>$arreglo[19]</td>";
              echo "<td>$arreglo[20]</td>";
              echo "<td>$arreglo[21]</td>";
              echo "<td>$arreglo[22]</td>";
              if ($arreglo[23]!=null) {
                echo "<td><a href='../files/impuestoauto/inspeccion/$arreglo[23]' target='_blank'>Ver documento de respaldo</td>";
              }
              else{
                echo "<td>No se subió documento de respaldo</td>";
              }
              echo "<td>$arreglo[24]</td>";
              echo "<td>$arreglo[25]</td>";
              echo "<td>$arreglo[26]</td>";
              echo "<td>$arreglo[27]</td>";
               if ($arreglo[28]!=null) {
                echo "<td><a href='../files/impuestoauto/propiedad/$arreglo[28]' target='_blank'>Ver documento de respaldo</td>";
              }
              else{
                echo "<td>No se subió documento de respaldo</td>";
              }
              
              if ($_SESSION["user_id"]==0) {
                $sql2=("SELECT * FROM usuario where ci=\"$arreglo[29]\"");
                echo "<td><a href='../views/update_automotores.php?id=$arreglo[0]'>Modificar </a><a href='../controller/delete_automotores.php?id=$arreglo[0]'>Eliminar</a></td>";
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
    dom: 'Bfrtip',
        buttons: [
            'excel',
    ]
    } );
} );
    </script>
    
</body>
</html>

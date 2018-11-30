<?php
session_start();
if(isset($_SESSION["tipo"])){
    if($_SESSION["tipo"]!=0){
        print "<script>alert(\"No puede realizar estas acciones como usuario.\");window.location='../views/page_user.php';</script>";
    }
}
else{
  print "<script>alert(\"No puede tener acceso si no esta identificado.\");window.location='../index.php';</script>";
}
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Impuesto automotores</title>
  <link rel="shortcut icon" href="../assets/favicono.ico">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <link rel="stylesheet" href="../css/reset.css"> <!-- CSS reset -->
  <link rel="stylesheet" href="../css/cabecera.css"> <!-- Resource style -->
  <script src="../js/modernizr.js"></script> <!-- Modernizr -->
  
      <link rel="stylesheet" href="../css/form.css">

  
</head>

<body>
  <nav class="cd-stretchy-nav">
        <a class="cd-nav-trigger" href="#0">
            
            <span aria-hidden="true"></span>
        </a>

        <ul>
            <li><a href="../views/page_user.php"><span>Tareas Principales</span></a></li>
            <li><a href="../views/add_automotores.php" class="active"><span>Añadir impuestos automotores</span></a></li>
            <li><a href="../views/automotores.php"><span>Ver impuestos automotores</span></a></li>
            <li><a href="../views/update_password.php?id=<?php echo $_SESSION['user_id']; ?>"><span><font color="red">Cambiar contraseña</font></span></a></li>
            <li><a href="../controller/logout.php"><span>Salir: <?php echo $_SESSION["nombres"]  ?></span></a></li>
        </ul>

        <span aria-hidden="true" class="stretchy-nav-bg"></span>
    </nav>
    <div class="container">
    <div class="wrapper">
      <ul class="steps">
        <li class="is-active">Crear impuesto automotor</li>
      </ul>
      <form name="crea_automotor" class="form-wrapper" method="post" action="../controller/update_automotores.php" enctype="multipart/form-data">
        <?php 
          extract($_GET);
          require("../controller/conexion.php");
          $sql="SELECT * FROM automoviles WHERE id_autom=$id";
          $ressql=mysqli_query($con,$sql);
          while ($row=mysqli_fetch_row($ressql)) {
            $propietario=$row[1];
            $tipo=$row[2];
            $marca=$row[3];
            $modelo=$row[4];
            $placa=$row[5];
            $ano=$row[6];
            $motor=$row[7];
            $chasis=$row[8];
            $color=$row[9];
            $plaza_circulacion=$row[10];
            $nro_ocupantes=$row[11];
            $valor_comercial=$row[12];
            $documentos_propiedad=$row[13];
            $documento_escaneado_ruat=$row[14];
            $pago_impuestos=$row[15];
            $documento_escaneado=$row[16];
            $observaciones=$row[17];
            $comodato=$row[18];
            $monto=$row[19];
            $poliza=$row[20];
            $otros_documentos=$row[21];
            $inspeccion_vehicular=$row[22];
            $respaldo=$row[23];
            $fecha_extintor=$row[24];
            $fecha_vigencia=$row[25];
            $triangulo=$row[26];
            $herramientas=$row[27];
            $documentos_de_propiedad=$row[28];

          }
          mysqli_close($con);
         ?>
        <fieldset class="section is-active">
          <h3>Introduzca datos de los automotores</h3>
          <input type="text" name="propietario" id="propietario" placeholder="Propietario" value="<?php echo $propietario; ?>">
          <input type="text" name="tipo" id="tipo" placeholder="Tipo" value="<?php echo $tipo; ?>">
          <input type="text" name="marca" id="marca" placeholder="Marca" value="<?php echo $marca; ?>">
          <input type="text" name="modelo" id="modelo" placeholder="Modelo" value="<?php echo $modelo; ?>">
          <input type="text" name="placa" id="placa" placeholder="Placa" value="<?php echo $placa; ?>">
          <input type="number" name="ano" id="ano" placeholder="Año" value="<?php echo $ano; ?>">
          <input type="text" name="motor" id="motor" placeholder="Motor" value="<?php echo $motor; ?>">
          <input type="text" name="chasis" id="chasis" placeholder="Chasis" value="<?php echo $chasis; ?>">
          <input type="text" name="color" id="color" placeholder="Color" value="<?php echo $color; ?>">
          <select name="plaza" id="plaza">
            <option value="<?php echo $plaza_circulacion; ?>" selected><?php echo $plaza_circulacion; ?></option>
            <option value="OF. NACIONAL">OF. Nacional</option>
            <option value="EL ALTO">El Alto</option>
            <option value="LA PAZ">La Paz</option>
            <option value="COCHABAMBA">Cochabamba</option>
            <option value="SANTA CRUZ">Santa Cruz</option>
            <option value="ORURO">Oruro</option>
            <option value="BENI">Beni</option>
            <option value="PANDO">Pando</option>
            <option value="SUCRE">Sucre</option>
            <option value="TARIJA">Tarija</option>
            <option value="POTOSI">Potosi</option>
          </select>
          <input type="number" name="ocupantes" id="ocupantes" placeholder="Numero de ocupantes" value="<?php echo $nro_ocupantes; ?>">
          <input type="number" name="valor" id="valor" placeholder="Valor comercial en $us" step="0.01" value="<?php echo $valor_comercial; ?>">
          <select name="docuprop" id="docuprop">
            <option value="<?php echo $documentos_propiedad; ?>" selected><?php echo $documentos_propiedad; ?></option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
          </select>
          <h3>Seleccione archivo de RUAT</h3>
          <input type="file" name="ruat" id="ruat" accept="image/*, application/pdf" >
          <input type="number" name="pagovig" id="pagovig" placeholder="Pago de impuestos vigente/Gestion" value="<?php echo $pago_impuestos; ?>">
          <h3>Seleccione archivo de IMPUESTO</h3>
          <input type="file" name="impuesto" id="impuesto" accept="image/*, application/pdf">
          <select name="obser" id="obser">
            <option value="<?php echo $observaciones; ?>" selected><?php echo $observaciones; ?></option>
            <option value="PAGADO">PAGADO</option>
            <option value="VENCIDO">VENCIDO</option>
          </select>
          <input type="number" name="comodato" id="comodato" placeholder="Comodato" value="<?php echo $comodato; ?>">
          <input type="number" name="montopagado" id="montopagado" placeholder="Monto Pagado" value="<?php echo $monto; ?>">
          <select name="poliza" id="poliza">
            <option value="<?php echo $poliza; ?>" selected><?php echo $poliza; ?></option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
          </select>
          <input type="text" name="otros" id="otros" placeholder="Otros documentos" value="<?php echo $otros_documentos; ?>">
          <select name="inspec" id="inspec">
            <option value="<?php echo $inspeccion_vehicular; ?>" selected><?php echo $inspeccion_vehicular; ?></option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
          </select>
          <h3>Archivo Inspeccion tecnica vehicular</h3>
          <input type="file" name="inspect" id="inspect" accept="image/*, application/pdf">
          <h3>Extintor vehiculos</h3>
          <input type="text" name="fecha_extintor" placeholder="Fecha del extintor" value="<?php echo $fecha_extintor; ?>" onfocus="(this.type='date')">
          <select name="vigext" id="vigext">
            <option value="<?php echo $fecha_vigencia; ?>" selected><?php echo $fecha_vigencia; ?></option>
            <option value="VIGENTE">VIGENTE</option>
            <option value="VENCIDA">VENCIDA</option>
          </select>
          <input type="text" name="triangulo" id="triangulo" placeholder="Triangulo" value="<?php echo $triangulo; ?>">
          <input type="text" name="tools" id="tools" placeholder="Herramientas" value="<?php echo $herramientas; ?>">
          <h3>Documentos de propiedad</h3>
          <input type="file" name="docprop" id="docprop" accept="image/*, application/pdf">
          <input class="submit button" type="submit" value="Actualizar contrato">
          <div class="row cf" style="color: red"><p id="error"></p></div>
          <input type="hidden" name="ide" id="ide" value="<?php echo $id; ?>">
          <input type="hidden" name="docu1" value="<?php echo $documento_escaneado_ruat; ?>">
          <input type="hidden" name="docu2" value="<?php echo $documento_escaneado; ?>">
          <input type="hidden" name="docu3" value="<?php echo $respaldo; ?>">
          <input type="hidden" name="docu4" value="<?php echo $documentos_de_propiedad; ?>">
        </fieldset>
      </form>
    </div>
  </div>
  
  
  <script type="text/javascript" src="../js/jquery-2.2.3.min.js"></script>
  <script src="../js/cabecera.js"></script> 
    
</body>
</html>

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
            <li><a href="../views/search.php"><span>Búsqueda avanzada</span></a></li>
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
      <form name="crea_automotor" class="form-wrapper" method="post" action="../controller/add_automotores.php" enctype="multipart/form-data">
        <fieldset class="section is-active">
          <h3>Introduzca datos de los automotores</h3>
          <input type="text" name="propietario" id="propietario" placeholder="Propietario">
          <input type="text" name="tipo" id="tipo" placeholder="Tipo">
          <input type="text" name="marca" id="marca" placeholder="Marca">
          <input type="text" name="modelo" id="modelo" placeholder="Modelo">
          <input type="text" name="placa" id="placa" placeholder="Placa">
          <input type="number" name="ano" id="ano" placeholder="Año">
          <input type="text" name="motor" id="motor" placeholder="Motor">
          <input type="text" name="chasis" id="chasis" placeholder="Chasis">
          <input type="text" name="color" id="color" placeholder="Color">
          <select name="plaza" id="plaza">
            <option value="No definido" selected>Plaza de circulacion</option>
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
          <input type="number" name="ocupantes" id="ocupantes" placeholder="Numero de ocupantes">
          <input type="number" name="valor" id="valor" placeholder="Valor comercial en $us" step="0.01">
          <select name="docuprop" id="docuprop">
            <option value="No definido" selected>Documentos de propiedad</option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
          </select>
          <h3>Seleccione archivo de RUAT</h3>
          <input type="file" name="ruat" id="ruat" accept="image/*, application/pdf" >
          <input type="number" name="pagovig" id="pagovig" placeholder="Pago de impuestos vigente/Gestion">
          <h3>Seleccione archivo de IMPUESTO</h3>
          <input type="file" name="impuesto" id="impuesto" accept="image/*, application/pdf">
          <select name="obser" id="obser">
            <option value="No definido" selected>Observaciones</option>
            <option value="PAGADO">PAGADO</option>
            <option value="VENCIDO">VENCIDO</option>
          </select>
          <input type="text" name="comodato" id="comodato" placeholder="Comodato">
          <input type="number" name="montopagado" id="montopagado" placeholder="Monto Pagado" step="0.01">
          <select name="poliza" id="poliza">
            <option value="No definido" selected>Poliza</option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
          </select>
          <input type="text" name="otros" id="otros" placeholder="Otros documentos">
          <select name="inspec" id="inspec">
            <option value="No definido" selected>Inspeccion vehicular</option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
          </select>
          <h3>Archivo Inspeccion tecnica vehicular</h3>
          <input type="file" name="inspect" id="inspect" accept="image/*, application/pdf">
          <h3>Extintor vehiculos</h3>
          <input type="text" name="fecha_extintor" placeholder="Fecha del extintor" onfocus="(this.type='date')">
          <select name="vigext" id="vigext">
            <option value="No definido" selected>Fecha vigencia</option>
            <option value="VIGENTE">VIGENTE</option>
            <option value="VENCIDA">VENCIDA</option>
          </select>
          <input type="text" name="triangulo" id="triangulo" placeholder="Triangulo">
          <input type="text" name="tools" id="tools" placeholder="Herramientas">
          <h3>Documentos de propiedad</h3>
          <input type="file" name="docprop" id="docprop" accept="image/*, application/pdf">
          <input class="submit button" type="submit" value="Añadir contrato">
          <div class="row cf" style="color: red"><p id="error"></p></div>
          <input type="hidden" name="ide" id="ide" value="<?php echo $_SESSION['user_id']; ?>">
        </fieldset>
      </form>
    </div>
  </div>
  
  
  <script type="text/javascript" src="../js/jquery-2.2.3.min.js"></script>
  <script src="../js/cabecera.js"></script> 
    
</body>
</html>

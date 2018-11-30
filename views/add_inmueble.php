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
?>?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Impuestos inmuebles</title>
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
            <li><a href="../views/add_inmueble.php" class="active"><span>Añadir impuesto inmueble</span></a></li>
            <li><a href="../views/inmuebles.php"><span>Ver impuestos inmuebles</span></a></li>
            <li><a href="../views/search.php"><span>Búsqueda avanzada</span></a></li>
            <li><a href="../views/update_password.php?id=<?php echo $_SESSION['user_id']; ?>"><span><font color="red">Cambiar contraseña</font></span></a></li>
            <li><a href="../controller/logout.php"><span>Salir: <?php echo $_SESSION["nombres"]  ?></span></a></li>
        </ul>

        <span aria-hidden="true" class="stretchy-nav-bg"></span>
    </nav>
    <div class="container">
    <div class="wrapper">
      <ul class="steps">
        <li class="is-active">Añadir impuesto inmuebles</li>
      </ul>
      <form name="crea_inmueble" class="form-wrapper" method="post" action="../controller/add_inmueble.php" enctype="multipart/form-data">
        <fieldset class="section is-active">
          <h3>Introduzca los datos impuesto</h3>
          <select name="region" id="region">
            <option value="No definido" selected>Regional</option>
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
          <input type="text" name="contable" id="contable" placeholder="Contable">
          <input type="text" name="direccion" id="direccion" placeholder="Dirección">
          <input type="number" name="nro_inmu" id="nro_inmu" placeholder="Numero de inmuebles">
          <input type="text" name="descripcion" id="descripcion" placeholder="Descripcion del inmueble">
          <input type="number" name="valor" id="valor" placeholder="Valor inicial" step="0.01">
          <input type="text" name="vigente" id="vigente" placeholder="Pago de impuesto vigente">
          <input type="number" name="gestion" id="gestion" placeholder="Gestión">
          <input type="text" name="envio" id="envio" placeholder="Envio de documento escaneado">
          <input type="text" name="obs" id="obs" placeholder="Observaciones" required>
          <input type="number" name="pago" id="pago" placeholder="Pago de impuestos municipales">
          <input class="submit button" type="submit" value="Añadir impuesto">
          <div class="row cf" style="color: red"><p id="error"></p></div>
          <input type="hidden" name="ide" id="ide" value="<?php echo $_SESSION["user_id"]; ?>">
        </fieldset>
      </form>
    </div>
  </div>
  
  
  <script type="text/javascript" src="../js/jquery-2.2.3.min.js"></script>
  <script src="../js/cabecera.js"></script> 
    
</body>
</html>

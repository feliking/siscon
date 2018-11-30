<?php
session_start();
if(isset($_SESSION["tipo"])){
    if($_SESSION["tipo"]==null){
        print "<script>alert(\"No puede ingresar sin identificarse\");window.location='../index.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Baja de licencias</title>
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
            <li><a href="../views/add_baja.php" class="active"><span>Añadir baja de licencias</span></a></li>
            <li><a href="../views/baja.php"><span>Ver baja de licencias</span></a></li>
            <li><a href="../views/search.php"><span>Búsqueda avanzada</span></a></li>
            <li><a href="../views/update_user.php"><span>Cambiar contraseña</span></a></li>
            <li><a href="../controller/logout.php"><span>Salir: <?php echo $_SESSION["nombres"]  ?></span></a></li>
        </ul>

        <span aria-hidden="true" class="stretchy-nav-bg"></span>
    </nav>
    <div class="container">
    <div class="wrapper">
      <ul class="steps">
        <li class="is-active">Crear baja de licencia</li>
      </ul>
      <form name="crea_baja" class="form-wrapper" method="post" action="../controller/add_baja.php" enctype="multipart/form-data">
        <fieldset class="section is-active">
          <h3>Introduzca los datos del contrato</h3>
          <select name="region" id="region" required>
            <option value="" disabled selected>Regional</option>
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
          <input type="text" name="centro_focal" id="centro_focal" placeholder="Centro Focal" required>
          <input type="text" name="licencia" id="licencia" placeholder="Licencia funcionamiento" required">
          <input type="text" name="fecha_ini" id="fecha_ini" placeholder="Fecha de inicio del contrato" onfocus="(this.type='date')" required>
          <h3>Seleccione el archivo escaneado</h3>
          <input type="file" name="respaldo" id="respaldo" accept="image/*, application/pdf">
          <input type="text" name="observacion" id="observacion" placeholder="Observacion" required>
          <input type="text" name="nit" id="nit" placeholder="NIT" required>
          <input type="text" name="ifd" id="ifd" placeholder="IFD" required>
          <input type="text" name="observacion2" id="observacion2" placeholder="Observacion" required>
          <input class="submit button" type="submit" value="Añadir contrato">
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

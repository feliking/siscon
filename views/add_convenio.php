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
  <title>Recojo de residuos</title>
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
            <li><a href="../views/add_convenio.php" class="active"><span>Añadir contratos de recojo de residuos</span></a></li>
            <li><a href="../views/convenio.php"><span>Ver contratos de recojo de residuos</span></a></li>
            <li><a href="../views/search.php"><span>Búsqueda avanzada</span></a></li>
            <li><a href="../views/update_user.php"><span>Cambiar contraseña</span></a></li>
            <li><a href="../controller/logout.php"><span>Salir: <?php echo $_SESSION["nombres"]  ?></span></a></li>
        </ul>

        <span aria-hidden="true" class="stretchy-nav-bg"></span>
    </nav>
    <div class="container">
    <div class="wrapper">
      <ul class="steps">
        <li class="is-active">Crear nuevo contrato de recojo de residuos</li>
      </ul>
      <form name="crea_convenio" class="form-wrapper" method="post" action="../controller/add_convenio.php" enctype="multipart/form-data">
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
          <input type="text" name="nombre" id="nombre" placeholder="Nombre de la empresa" required>
          <select name="cuenta" id="cuenta">
            <option value="" disabled selected>Cuenta</option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
          </select>
          <h3>Seleccione el archivo de respaldo</h3>
          <input type="file" name="respaldo" id="respaldo" accept="image/*, application/pdf">
          <input type="text" name="fecha_ini" id="fecha_ini" placeholder="Fecha de inicio del contrato" onfocus="(this.type='date')" required>
          <input type="text" name="fecha_fin" id="fecha_fin" placeholder="Fecha de fin de contrato" onfocus="(this.type='date')" required>
          <input type="number" name="costo" id="costo" placeholder="Introduzca costo en Bs" step="0.01" required>
          <input type="text" name="observacion" id="observacion" placeholder="Observación" required>
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
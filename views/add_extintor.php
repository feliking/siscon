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
  <title>Extintores</title>
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
            <li><a href="../views/add_extintor.php" class="active"><span>Añadir contratos de extintores</span></a></li>
            <li><a href="../views/extintor.php"><span>Ver contratos de extintores</span></a></li>
            <li><a href="../views/search.php"><span>Búsqueda avanzada</span></a></li>
            <li><a href="../views/update_password.php?id=<?php echo $_SESSION['user_id']; ?>"><span><font color="red">Cambiar contraseña</font></span></a></li>
            <li><a href="../controller/logout.php"><span>Salir: <?php echo $_SESSION["nombres"]  ?></span></a></li>
        </ul>

        <span aria-hidden="true" class="stretchy-nav-bg"></span>
    </nav>
    <div class="container">
    <div class="wrapper">
      <ul class="steps">
        <li class="is-active">Crear nuevo contrato de extintores</li>
      </ul>
      <form name="crea_extintor" class="form-wrapper" method="post" action="../controller/add_extintor.php" enctype="multipart/form-data">
        <fieldset class="section is-active">
          <h3>Introduzca los datos del contrato</h3>
           <select name="region" id="region">
            <option value="No definido" selected>Regional*</option>
            <option value="OF. NACIONAL">Of. Nacional</option>
            <option value="EL ALTO">El Alto</option>
            <option value="LA PAZ">La Paz</option>
            <option value="COCHABAMBA">Cochabamba</option>
            <option value="SANTA CRUZ">Santa Cruz</option>
            <option value="ORURO">Oruro</option>
            <option value="BENI">Beni</option>
            <option value="PANDO">Pando</option>
            <option value="SUCRE">Chuquisaca</option>
            <option value="TARIJA">Tarija</option>
            <option value="POTOSI">Potosi</option>
          </select>
          <input type="text" name="centro_focal" id="centro_focal" placeholder="Centro Focal">
          <h3>Introduzca la cantidad de cada tipo de extintor</h3>
          <input type="text" name="tipo_extin" id="tipo_extin" placeholder="Cantidad de extintores tipo 1">
          <input type="text" name="tipo_extin2" id="tipo_extin2" placeholder="Cantidad de extintores tipo 2">
          <input type="text" name="ubicacion" id="ubicacion" placeholder="Ubicacion del extintor" required>
          <input type="text" name="peso" id="peso" placeholder="Peso en kilogramos" required>
          <input type="text" name="fecha_ini" id="fecha_ini" placeholder="Fecha de recarga" onfocus="this.type='date'">
          <input type="text" name="fecha_fin" id="fecha_fin" placeholder="Fecha de válidez" onfocus="this.type='date'">
          <input type="number" name="nro_extintor" id="nro_extintor" placeholder="Numero extintor" required>
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

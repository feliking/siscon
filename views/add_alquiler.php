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
  <title>SisCon || Admin</title>
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
            <li><a href="../views/add_alquiler.php" class="active"><span>Añadir contratos de alquiler</span></a></li>
            <li><a href="../views/alquileres.php"><span>Ver contratos de alquiler</span></a></li>
            <li><a href="../views/search.php"><span>Búsqueda avanzada</span></a></li>
            <li><a href="../views/update_password.php?id=<?php echo $_SESSION['user_id']; ?>"><span><font color="red">Cambiar contraseña</font></span></a></li>
            <li><a href="../controller/logout.php"><span>Salir: <?php echo $_SESSION["nombres"]  ?></span></a></li>
        </ul>

        <span aria-hidden="true" class="stretchy-nav-bg"></span>
    </nav>
    <div class="container">
    <div class="wrapper">
      <ul class="steps">
        <li class="is-active">Crear nuevo contrato de alquiler</li>
      </ul>
      <form name="crea_alquiler" class="form-wrapper" method="post" action="../controller/add_alquiler.php" enctype="multipart/form-data">
        <fieldset class="section is-active">
          <h3>Introduzca los datos del contrato</h3>
          <select name="region" id="region">
            <option value="No definido" selected>Regional*</option>
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
          <input type="text" name="centro_focal" id="centro_focal" placeholder="Centro Focal*">
          <input type="text" name="tipo_centro_focal" id="tipo_centro_focal" placeholder="Tipo del centro focal*">
          <input type="text" name="nombre" id="nombre" placeholder="Nombre del propietario*">
          <input type="text" name="fecha_ini" id="fecha_ini" placeholder="Fecha de inicio del contrato*" onfocus="(this.type='date')">
          <input type="text" name="fecha_fin" id="fecha_fin" placeholder="Fecha de fin de contrato*" onfocus="(this.type='date')">
          
          <h3>Canon mensual (solo llene un espacio)</h3>
          <input type="number" name="canon_mensualbs" id="canon_mensualbs" placeholder="Introduzca monto en Bs Ej. 1000.5" step="0.01">
          <input type="number" name="canon_mensualsus" id="canon_mensualsus" placeholder="Introduzca monto en $us Ej. 2000.55" step="0.01">
          <br>
          <h3>Seleccione el archivo del folio real</h3>
          <input type="file" name="folio_real" id="folio_real" accept="image/*,application/pdf">
          <br>
          <h3>Seleccione el archivo de respaldo</h3>
          <input type="file" name="respaldo" id="respaldo" accept="image/*,application/pdf">
          <input type="text" name="garantiabs" id="garantiabs" placeholder="Garantía en Bs">
          <input type="text" name="garantiasus" id="garantiasus" placeholder="Garantía en $us">
          <select name="devuelto" id="devuelto" required>
            <option value="No definido" selected>Devuelto/No devuelto</option>
            <option value="DEVUELTO">Devuelto</option>
            <option value="NO DEVUELTO"> No devuelto</option>
          </select>
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

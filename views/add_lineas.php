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
  <title>Líneas telefonicas</title>
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
            <li><a href="../views/add_lineas.php" class="active"><span>Añadir contratos de líneas telefonicas</span></a></li>
            <li><a href="../views/lineas.php"><span>Ver contratos de líneas telefonicas</span></a></li>
            <li><a href="../views/search.php"><span>Búsqueda avanzada</span></a></li>
            <li><a href="../views/update_password.php?id=<?php echo $_SESSION['user_id']; ?>"><span><font color="red">Cambiar contraseña</font></span></a></li>
            <li><a href="../controller/logout.php"><span>Salir: <?php echo $_SESSION["nombres"]  ?></span></a></li>
        </ul>

        <span aria-hidden="true" class="stretchy-nav-bg"></span>
    </nav>
    <div class="container">
    <div class="wrapper">
      <ul class="steps">
        <li class="is-active">Crear nuevo contrato de líneas telefonicas</li>
      </ul>
      <form name="crea_lineas" class="form-wrapper" method="post" action="../controller/add_lineas.php" enctype="multipart/form-data">
        <fieldset class="section is-active">
          <h3>Introduzca los datos del contrato</h3>
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
          <input type="text" name="nombre_regional" id="nombre_regional" placeholder="Nombre regional">
          <input type="number" name="numero_linea_externa" id="numero_linea_externa" placeholder="Número de linea externa">
          <input type="number" name="numero_linea_actual" id="numero_linea_actual" placeholder="Número de linea actual">
          <input type="text" name="proveedor" id="proveedor" placeholder="Proveedor">
          <input type="text" name="descripcion" id="descripcion" placeholder="Descripcion">
          <select name="tipo" id="tipo">
            <option value="No definido" selected>Tipo</option>
            <option value="E1">E1</option>
            <option value="FXO">FXO</option>
          </select>
           <h3>Permisos</h3>
          <input type="checkbox" name="permisos[]" id="LOCAL" value="LOCAL">Local
          <input type="checkbox" name="permisos[]" id="CELULAR" value="CELULAR">Celular
          <input type="checkbox" name="permisos[]" id="NACIONAL" value="NACIONAL">Nacional
          <input type="checkbox" name="permisos[]" id="INTERNACIONAL" value="INTERNACIONAL">Internacional
          <input type="number" name="numero_contrato" id="numero_contrato" placeholder="Número de contrato">
          <select name="propiedad" id="propiedad">
            <option value="No definido" selected>Propiedad</option>
            <option value="GEMELA">Gemela</option>
            <option value="TITULAR">Titular</option>
          </select>
          <input type="text" name="categoria" id="categoria" placeholder="Categoría">
          <input type="number" name="numero_contrato2" id="numero_contrato2" placeholder="Número de contrato">
          <input type="text" name="respaldo" id="respaldo" placeholder="Documento que respalda">
           <h3>Seleccione certificado de aportacion escaneado</h3>
          <input type="file" name="aportacion" id="aportacion" accept="image/*, application/pdf">
          <input type="number" name="valor" id="valor" placeholder="Valor de suscripcion en $us" step="0.01">
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
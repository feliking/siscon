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
  <title>Licencia de publicidad</title>
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
            <li><a href="../views/add_publicidad.php" class="active"><span>Añadir licencia de publicidad</span></a></li>
            <li><a href="../views/publicidad.php"><span>Ver licencias de publicidad</span></a></li>
            <li><a href="../views/search.php"><span>Búsqueda avanzada</span></a></li>
            <li><a href="../views/update_password.php?id=<?php echo $_SESSION['user_id']; ?>"><span><font color="red">Cambiar contraseña</font></span></a></li>
            <li><a href="../controller/logout.php"><span>Salir: <?php echo $_SESSION["nombres"]  ?></span></a></li>
        </ul>

        <span aria-hidden="true" class="stretchy-nav-bg"></span>
    </nav>
    <div class="container">
    <div class="wrapper">
      <ul class="steps">
        <li class="is-active">Crear nueva licencia de publicidad</li>
      </ul>
      <form name="crea_publicidad" class="form-wrapper" method="post" action="../controller/add_publicidad.php" enctype="multipart/form-data">
        <fieldset class="section is-active">
          <h3>Introduzca los datos de la licencia</h3>
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
          <input type="text" name="centro_focal" id="centro_focal" placeholder="Centro Focal">
          <select name="cuenta" id="cuenta">
            <option value="No definido" selected>Cuenta con licencias o permisos</option>
            <option value="SI">Si</option>
            <option value="NO">No</option>
            <option value="TRAMITE">En tramite</option>
          </select>
          <select name="adosada" id="adosada">
            <option value="No definido" selected>Adosada(letreros)</option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
          </select>
          <input type="text" name="vigencia" id="vigencia" placeholder="Vigencia(letreros)" onfocus="(this.type='date')">
          <h3>Seleccione el documento escaneado</h3>
          <input type="file" name="respaldo" id="respaldo" accept="image/*, application/pdf">
          <select name="pintada" id="pintada">
            <option value="No definido" selected>Pintada</option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
          </select>
          <select name="microperforadora" id="microperforadora">
            <option value="No definido" selected>Microperforadora</option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
          </select>
          <select name="autoportantes" id="autoportantes">
            <option value="No definido" selected>Autoportantes</option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
          </select>
          <input type="text" name="fecha_ini" id="fecha_ini" placeholder="Fecha de emision" onfocus="(this.type='date')">
          <input type="text" name="fecha_fin" id="fecha_fin" placeholder="Fecha de vencimiento" onfocus="(this.type='date')">
          <h3>Se cuenta con documento escaneado en archivo</h3>
          <input type="file" name="archivo" id="archivo" accept="image/*, application/pdf">
          <input type="text" name="observaciones" id="observaciones" placeholder="Observaciones">
          <input type="number" name="pago_patentes" id="pago_patentes" placeholder="Año pago de patentes">
          <h3>Suba el archivo de pago de patentes</h3>
          <input type="file" name="respaldo_patentes" accept="application/pdf, image/*">
          <input class="submit button" type="submit" value="Añadir licencia">
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

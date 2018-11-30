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
  <title>Licencia de funcionamiento</title>
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
            <li><a href="../views/add_funcionamiento.php" class="active"><span>Añadir contratos de licencia de funcionamiento</span></a></li>
            <li><a href="../views/funcionamiento.php"><span>Ver licencias de funcionamiento</span></a></li>
            <li><a href="../views/update_password.php?id=<?php echo $_SESSION['user_id']; ?>"><span><font color="red">Cambiar contraseña</font></span></a></li>
            <li><a href="../controller/logout.php"><span>Salir: <?php echo $_SESSION["nombres"]  ?></span></a></li>
        </ul>

        <span aria-hidden="true" class="stretchy-nav-bg"></span>
    </nav>
    <div class="container">
    <div class="wrapper">
      <ul class="steps">
        <li class="is-active">Crear nuevo contrato de licencia de funcionamiento</li>
      </ul>
      <form name="crea_funcionamiento" class="form-wrapper" method="post" action="../controller/update_funcionamiento.php" enctype="multipart/form-data">
        <?php 
          extract($_GET);
          require("../controller/conexion.php");
          $sql="SELECT * FROM licenciafun WHERE id_licfu=$id";
          $ressql=mysqli_query($con,$sql);
          while ($row=mysqli_fetch_row($ressql)) {
            $region=$row[1];
            $centro_focal=$row[2];
            $tipo_centro_focal=$row[3];
            $fecha_ini=$row[4];
            $fecha_fin=$row[5];
            $respaldo=$row[6];
            $pago_patentes=$row[7];
            $respaldo_patentes=$row[8];
          }
          mysqli_close($con);
         ?>
        <fieldset class="section is-active">
          <h3>Introduzca los datos del contrato</h3>
          <select name="region" id="region" required>
            <option value="<?php echo $region; ?>" selected><?php echo $region; ?></option>
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
          <input type="text" name="centro_focal" id="centro_focal" placeholder="Centro Focal" value="<?php echo $centro_focal; ?>" required>
          <input type="text" name="tipo_centro_focal" id="tipo_centro_focal" placeholder="Tipo del centro focal" value="<?php echo $tipo_centro_focal; ?>" required">
          <input type="text" name="fecha_ini" id="fecha_ini" placeholder="Emision" onfocus="(this.type='date')" value="<?php echo $fecha_ini; ?>" required>
          <input type="text" name="fecha_fin" id="fecha_fin" placeholder="Vencimiento" onfocus="(this.type='date')" value="<?php echo $fecha_fin; ?>" required>
          <br>
          <h3>Seleccione el archivo de respaldo</h3>
          <input type="file" name="respaldo" id="respaldo" accept="image/*, application/pdf">
          <input type="number" name="pago_patentes" id="pago_patentes" placeholder="Año pago de patentes" value="<?php echo $pago_patentes; ?>">
          <h3>Suba el archivo de pago de patentes</h3>
          <input type="file" name="respaldo_patentes" accept="application/pdf, image/*">
          <input class="submit button" type="submit" value="Actualizar contrato">
          <div class="row cf" style="color: red"><p id="error"></p></div>
          <input type="hidden" name="ide" id="ide" value="<?php echo $id; ?>">
          <input type="hidden" name="docu1" id="docu1" value="<?php echo $respaldo; ?>">
          <input type="hidden" name="docu2" id="docu2" value="<?php echo $respaldo_patentes; ?>">
        </fieldset>
      </form>
    </div>
  </div>
  
  
  <script type="text/javascript" src="../js/jquery-2.2.3.min.js"></script>
  <script src="../js/cabecera.js"></script> 
    
</body>
</html>

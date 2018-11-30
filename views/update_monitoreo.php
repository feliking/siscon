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
  <title>Monitoreo de alarmas</title>
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
            <li><a href="../views/add_monitoreo.php" class="active"><span>Añadir contratos de monitoreo</span></a></li>
            <li><a href="../views/monitoreo.php"><span>Ver contratos de monitoreo de alarmas</span></a></li>
            <li><a href="../views/update_password.php?id=<?php echo $_SESSION['user_id']; ?>"><span><font color="red">Cambiar contraseña</font></span></a></li>
            <li><a href="../controller/logout.php"><span>Salir: <?php echo $_SESSION["nombres"]  ?></span></a></li>
        </ul>

        <span aria-hidden="true" class="stretchy-nav-bg"></span>
    </nav>
    <div class="container">
    <div class="wrapper">
      <ul class="steps">
        <li class="is-active">Crear nuevo contrato de monitoreo de alarmas</li>
      </ul>
      <form name="crea_monitoreo" class="form-wrapper" method="post" action="../controller/update_monitoreo.php" enctype="multipart/form-data">
        <?php 
          extract($_GET);
          require("../controller/conexion.php");
          $sql="SELECT * FROM monitoreo WHERE id_moni=$id";
          $ressql=mysqli_query($con,$sql);
          while ($row=mysqli_fetch_row($ressql)) {
            $region=$row[1];
            $centro_focal=$row[2];
            $proveedor=$row[3];
            $fecha_ini=$row[4];
            $fecha_fin=$row[5];
            $cobro=$row[6];
            $moneda=$row[7];
            $respaldo=$row[8];
            $correo=$row[10];
            $correo2=$row[11];
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
          <input type="text" name="nombre" id="nombre" placeholder="Proveedor" value="<?php echo $proveedor; ?>" required>
          <input type="date" name="fecha_ini" id="fecha_ini" placeholder="Fecha de inicio del contrato" value="<?php echo $fecha_ini; ?>" required>
          <input type="date" name="fecha_fin" id="fecha_fin" placeholder="Fecha de fin de contrato" value="<?php echo $fecha_fin; ?>" required>
          <br>
          <h3>Cobro</h3>
          <select name="moneda" id="moneda" required>
            <option value="<?php echo $moneda; ?>" selected>Moneda seleccionada: <?php echo $moneda; ?></option>
            <option value="bs">Bolivianos</option>
            <option value="sus">Dolares</option>
          </select>
          <input type="number" name="canon_mensual" id="canon_mensual" placeholder="Introduzca monto" step="0.01" value="<?php echo $cobro; ?>" required>
          <br>
          <h3>Seleccione el archivo de respaldo</h3>
          <input type="file" name="respaldo" id="respaldo" accept="image/*, application/pdf">
          <input type="email" name="correo" id="correo" placeholder="Correo electronico del encargado" value="<?php echo $correo; ?>">
          <input type="email" name="correo2" id="correo2" placeholder="Correo electronico del gerente" value="<?php echo $correo2; ?>">
          <input class="submit button" type="submit" value="Actualizar contrato">
          <div class="row cf" style="color: red"><p id="error"></p></div>
          <input type="hidden" name="ide" id="ide" value="<?php echo $id; ?>">
          <input type="hidden" name="docu1" id="docu1" value="<?php echo $respaldo; ?>">
          <input type="hidden" name="fecha" id="fecha" value="<?php echo $fecha_fin; ?>">
        </fieldset>
      </form>
    </div>
  </div>
  
  
  <script type="text/javascript" src="../js/jquery-2.2.3.min.js"></script>
  <script src="../js/cabecera.js"></script> 
    
</body>
</html>

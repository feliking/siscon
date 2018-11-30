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
  <title>Limpieza</title>
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
            <li><a href="../views/add_limpieza.php" class="active"><span>Añadir contratos de limpieza</span></a></li>
            <li><a href="../views/limpieza.php"><span>Ver contratos de limpieza</span></a></li>
            <li><a href="../views/update_password.php?id=<?php echo $_SESSION['user_id']; ?>"><span><font color="red">Cambiar contraseña</font></span></a></li>
            <li><a href="../controller/logout.php"><span>Salir: <?php echo $_SESSION["nombres"]  ?></span></a></li>
        </ul>

        <span aria-hidden="true" class="stretchy-nav-bg"></span>
    </nav>
    <div class="container">
    <div class="wrapper">
      <ul class="steps">
        <li class="is-active">Crear nuevo contrato de limpieza</li>
      </ul>
      <form name="crea_limpieza" class="form-wrapper" method="post" action="../controller/update_limpieza.php" enctype="multipart/form-data">
        <?php 
          extract($_GET);
          require("../controller/conexion.php");
          $sql="SELECT * FROM limpieza WHERE id_lim=$id";
          $ressql=mysqli_query($con,$sql);
          while ($row=mysqli_fetch_row($ressql)) {
            $regional=$row[1];
            $centro_focal=$row[2];
            $tipo_centro_focal=$row[3];
            $nombre_empresa=$row[4];
            $fecha_ini=$row[5];
            $fecha_fin=$row[6];
            $canon_mensual=$row[7];
            $moneda=$row[8];
            $respaldo=$row[9];
            $correo=$row[11];
            $correo1=$row[12];
          }
          mysqli_close($con);
         ?>
        <fieldset class="section is-active">
          <h3>Introduzca los datos del contrato</h3>
          <select name="region" id="region" required>
            <option value="<?php echo $regional; ?>" selected><?php echo $regional; ?></option>
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
          <input type="text" name="centro_focal" id="centro_focal" placeholder="Centro Focal" value="<?php echo $centro_focal;?>">
          <input type="text" name="tipo_centro_focal" id="tipo_centro_focal" placeholder="Tipo del centro focal" value="<?php echo $tipo_centro_focal;?>">
          <input type="text" name="nombre" id="nombre" placeholder="Nombre de la empresa" value="<?php echo $nombre_empresa;?>">
          <input type="date" name="fecha_ini" id="fecha_ini" placeholder="Fecha de inicio del contrato" value="<?php echo $fecha_ini;?>">
          <input type="date" name="fecha_fin" id="fecha_fin" placeholder="Fecha de fin de contrato" value="<?php echo $fecha_fin;?>">
          <br>
          <h3>Canon mensual orig.</h3>
          <select name="moneda" id="moneda" required>
            <option value="<?php echo $moneda;?>" selected>Moneda seleccionada: <?php echo $moneda;?></option>
            <option value="bs">Bolivianos</option>
            <option value="sus">Dolares</option>
            <option value="nn">No definido</option>
          </select>
          <input type="number" name="canon_mensual" id="canon_mensual" placeholder="Introduzca monto" value="<?php echo $canon_mensual;?>" step="0.01">
          <br>
          <h3>Seleccione el archivo de respaldo</h3>
          <input type="file" name="respaldo" id="respaldo" accept="image/*,application/pdf">
          <input type="text" name="correo" id="correo" placeholder="Correo electronico del encargado" value="<?php echo $correo; ?>">
          <input type="text" name="correo1" id="correo1" placeholder="Correo electronico del gerente" value="<?php echo $correo1; ?>">
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

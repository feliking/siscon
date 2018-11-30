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
  <title>Otros contratos</title>
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
            <li><a href="../views/add_otros.php" class="active"><span>Añadir otros contratos</span></a></li>
            <li><a href="../views/otros.php"><span>Ver otros contratos</span></a></li>
            <li><a href="../views/update_password.php?id=<?php echo $_SESSION['user_id']; ?>"><span><font color="red">Cambiar contraseña</font></span></a></li>
            <li><a href="../controller/logout.php"><span>Salir: <?php echo $_SESSION["nombres"]  ?></span></a></li>
        </ul>
        <span aria-hidden="true" class="stretchy-nav-bg"></span>
    </nav>
    <div class="container">
    <div class="wrapper">
      <ul class="steps">
        <li class="is-active">Crear nuevo contrato</li>
      </ul>
      <form name="crea_otros" class="form-wrapper" method="post" action="../controller/update_otros.php" enctype="multipart/form-data">
        <?php 
          extract($_GET);
          require("../controller/conexion.php");
          $sql="SELECT * FROM otros_contratos WHERE id_ot=$id";
          $ressql=mysqli_query($con,$sql);
          while ($row=mysqli_fetch_row($ressql)) {
            $empresa=$row[1];
            $detalle=$row[2];
            $fecha_ini=$row[3];
            $fecha_fin=$row[4];
            $observacion=$row[5];
            $estado=$row[6];
            $montobs=$row[7];
            $montosus=$row[8];
            $correo=$row[10];
            $correo2=$row[11];
          }
          mysqli_close($con);
         ?>
        <fieldset class="section is-active">
          <h3>Introduzca los datos del contrato</h3>
          <input type="text" name="empresa" id="empresa" placeholder="Nombre de la empresa" value="<?php echo $empresa; ?>" required>
          <input type="text" name="detalle" id="detalle" placeholder="Detalle" value="<?php echo $detalle; ?>" required>
          <input type="text" name="fecha_ini" id="fecha_ini" placeholder="Fecha de inicio del contrato" value="<?php echo $fecha_ini; ?>" required>
          <input type="text" name="fecha_fin" id="fecha_fin" placeholder="Fecha de fin de contrato" value="<?php echo $fecha_fin; ?>" required>
          <input type="text" name="observacion" id="observacion" placeholder="Observacion" value="<?php echo $observacion; ?>">
          <input type="text" name="estado" id="estado" placeholder="Estado del contrato" value="<?php echo $estado; ?>" required>
          <input type="number" name="monto" id="monto" placeholder="Introduzca monto en Bs" step="0.01" value="<?php echo $montobs ?>" onfocus="monto2.value=0" required>
          <input type="number" name="monto2" id="monto2" placeholder="Introduzca monto en $us" step="0.01" value="<?php echo $montosus; ?>" onfocus="monto.value=0" required>
          <input type="text" name="correo" id="correo" placeholder="Correo electronico del encargado" value="<?php echo $correo; ?>">
          <input type="text" name="correo2" id="correo2" placeholder="Correo electronico del gerente" value="<?php echo $correo2; ?>">
          <input class="submit button" type="submit" value="Actualizar contrato">
          <div class="row cf" style="color: red"><p id="error"></p></div>
          <input type="hidden" name="ide" id="ide" value="<?php echo $id; ?>">
          <input type="hidden" name="fecha" id="fecha" value="<?php echo $fecha_fin; ?>">
        </fieldset>
      </form>
    </div>
  </div>
  
  
  <script type="text/javascript" src="../js/jquery-2.2.3.min.js"></script>
  <script src="../js/cabecera.js"></script> 
    
</body>
</html>

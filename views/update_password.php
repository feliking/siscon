<?php
session_start();
extract($_GET);
if (isset($_SESSION["user_id"])) {
	if ($_SESSION["user_id"]!=$id) {
		session_destroy();
		print "<script>alert(\"Esta intentando ingresar a la privacidad de otro usuario, Esto se considera una falta grave, será reportado a la entidad a cargo\");window.location='../index.php';</script>";
	}
} else{
	print "<script>alert(\"Acceso denegado, No puede ingresar sin identificarse.\");window.location='../index.php';</script>";
}
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>SISCON || Cambiar contraseña</title>
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
      <li><a href="../views/page_user.php"><span>Tareas principales</span></a></li>
            <?php 
                if ($_SESSION['tipo']==0) {
                    echo "<li><a href='../views/page_admin.php'><span>Volver al Panel de administrador</span></a></li>";
                }
             ?>
      <li><a href="../controller/logout.php"><span>Salir: <?php echo $_SESSION["nombres"]  ?></span></a></li>
    </ul>
    <span aria-hidden="true" class="stretchy-nav-bg"></span>
  </nav>
    <div class="container">
    <div class="wrapper">
      <ul class="steps">
        <li class="is-active">Cambiar su contraseña</li>
      </ul>
      <form name="update_adm" class="form-wrapper" method="post" action="../controller/update_password.php">
      	<?php 
          extract($_GET);
          require("../controller/conexion.php");
          $sql="SELECT * FROM usuario WHERE ci=$id";
          $ressql=mysqli_query($con,$sql);
          while ($row=mysqli_fetch_row($ressql)) {
            $ci=$row[0];
            $nombres=$row[1];
            $apellidos=$row[2];
            $sexo=$row[3];
            $email=$row[4];
            $fecha_nac=$row[5];
            $nacionalidad=$row[6];
            $tipo=$row[7];
            $regional=$row[8];
            $usuario=$row[9];
            $password=$row[10];
          }
          mysqli_close($con);
         ?>
        <fieldset class="section is-active">
          <h3>Carnet de identidad</h3>
          <input type="text" name="ci" id="ci" value="<?php echo $ci; ?>" readonly><br>
          <h3>Esta registrado en el sistema a nombre de:</h3>
          <input type="text" name="nombres" id="nombres" value="<?php echo $nombres; ?>" readonly><br>
          <h3>Introduzca su nuevo nombre de usuario</h3>
          <input type="text" name="usuario" id="usuario" value="<?php echo $usuario; ?>" required><br>
          <h3>Introduzca su contraseña actual</h3>
          <input type="password" name="pass1" id="pass1" placeholder="Introduzca contraseña actual" required>
          <h3>Introduzca su nueva contraseña</h3>
          <input type="password" name="pass2" id="pass2" placeholder="Introduzca nueva contraseña" required>
          <input type="password" name="pass3" id="pass3" placeholder="Repita la nueva contraseña" required>
          <input class="submit button" type="submit" value="Cambiar contraseña">
          <div class="row cf" style="color: red"><p id="error"></p></div>
        </fieldset>
      </form>
    </div>
  </div>
  
  <script type="text/javascript">
      with(document.update_adm){
        onsubmit = function(e){
        e.preventDefault();
        var x=true;
        if (pass1.value!="<?php echo $_SESSION["password"]; ?>") {
          x=false;
          document.getElementById("error").innerHTML="Contraseña actual incorrecta, vuelva a escribirla por favor";
        }
        if(pass2.value!=pass3.value){
          x=false;
          document.getElementById("error").innerHTML="Las contraseñas no son iguales, verifique por favor";
        }
        if (x){ 
          submit(); 
        }
  }
}
    </script>
  <script type="text/javascript" src="../js/jquery-2.2.3.min.js"></script>
  <script src="../js/cabecera.js"></script> 
    
</body>
</html>

<?php
session_start();
if(isset($_SESSION["tipo"])){
    if($_SESSION["tipo"]==1){
        print "<script>alert(\"Acceso Restringido, No cuenta con estos privilegios\");window.location='../index.php';</script>";
    }
}
else{
    print "<script>alert(\"No puede ingresar a los dominios sin identificarse\");window.location='../index.php';</script>";
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
      <li><a href="../views/page_admin.php"><span>Tareas Principales</span></a></li>
      <li><a href="add_user.php" class="active"><span>Registrar nuevos usuarios</span></a></li>
      <li><a href="view_user.php"><span>Usuarios Registrados</span></a></li>
      <li><a href="../controller/logout.php"><span>Salir: <?php echo $_SESSION["nombres"]  ?></span></a></li>
    </ul>
    <span aria-hidden="true" class="stretchy-nav-bg"></span>
  </nav>
    <div class="container">
    <div class="wrapper">
      <ul class="steps">
        <li class="is-active">Actualizar datos del administrador</li>
      </ul>
      <form name="update_adm" class="form-wrapper" method="post" action="../controller/update_admin.php">
        <fieldset class="section is-active">
          <h3>Nombre</h3>
          <input type="text" name="ci" id="ci" placeholder="<?php echo $_SESSION["nombres"]; ?>" readonly="readonly"><br>
          <h3>Actualizar correo electronico(Este correo electronico se usara para enviar correos automaticamente)</h3>
          <input type="text" name="correo" id="correo" placeholder="Introduzca correo electronico" required><br>
          <h3>Actualizar nombre de usuario del administrador</h3>
          <input type="text" name="nombre_adm" id="nombre_adm" placeholder="Introduzca nuevo nombre de usuario" required><br>
          <h3>Actualizar contraseña del administrador (Esta contraseña se usará para acceder al servidor smtp de Promujer)</h3>
          <input type="password" name="pass1" id="pass1" placeholder="Introduzca contraseña actual" required>
          <input type="password" name="pass2" id="pass2" placeholder="Introduzca nueva contraseña" required>
          <input type="password" name="pass3" id="pass3" placeholder="Repita la nueva contraseña" required>
          <input class="submit button" type="submit" value="Actualizar Datos">
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
          document.getElementById("error").innerHTML="Contraseña actual incorrecta, vuelva a escribirla";
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

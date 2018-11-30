<?php
session_start();
if(isset($_SESSION["tipo"])){
    if($_SESSION["tipo"]!=0){
        print "<script>alert(\"No esta autorizado para ver esta página, consulte con el administrador\");window.location='../index.php';</script>";
    }
}
else{
  print "<script>alert(\"Acceso denegado, debe identificarse\");window.location='../index.php';</script>";
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
      <li><a href="../views/update_password.php" class="active"><span>Cambiar contraseña</span></a></li>
      <li><a href="../views/view_user.php" class="active"><span>Ver usuarios con acceso al sistema</span></a></li>
      <li><a href="../controller/logout.php"><span>Salir: <?php echo $_SESSION["nombres"]  ?></span></a></li>
    </ul>
    <span aria-hidden="true" class="stretchy-nav-bg"></span>
  </nav>
    <div class="container">
    <div class="wrapper">
      <ul class="steps">
        <li class="is-active">Actualizar datos del usuario</li>
      </ul>
      <form name="update_user" class="form-wrapper" method="post" action="../controller/add_user.php">
        <fieldset class="section is-active">
          <input type="number" name="ci" id="ci" placeholder="Carnet de identidad" title="Carnet de identidad" required>
          <input type="text" name="nombres" id="nombres" placeholder="Nombres" title="Nombres">
          <input type="text" name="apellidos" id="apellidos" placeholder="Apellidos" title="Apellidos">
          <select name="sexo" id="sexo" title="Genero" required>
            <option value="" selected disabled>Elija el género</option>
            <option value="M">Masculino</option>
            <option value="F">Femenino</option>
          </select>
          <input type="email" name="email" id="email" placeholder="Correo electronico" title="Correo Electronico">
          <input type="text" name="fecha_nac" id="fecha_nac" placeholder="Fecha de nacimiento" title="Fecha de nacimiento" onfocus="(this.type='date')" required>
          <select name="nacionalidad" id="nacionalidad" title="Nacionalidad" required>
            <option value="" disabled selected>Seleccione la nacionalidad</option>
            <option value="LA PAZ">LA PAZ</option>
            <option value="EL ALTO">EL ALTO</option>
            <option value="ORURO">ORURO</option>
            <option value="COCHABAMBA">COCHABAMBA</option>
            <option value="SANTA CRUZ">SANTA CRUZ</option>
            <option value="SUCRE">SUCRE</option>
            <option value="TARIJA">TARIJA</option>
            <option value="POTOSI">POTOSI</option>
            <option value="PANDO">PANDO</option>
            <option value="BENI">BENI</option>
          </select>
          <select name="tipo" id="tipo" title="Tipo" required>
            <option value="" disabled selected>Seleccione el tipo de usuario</option>
            <option value="0">Administrador</option>
            <option value="1">Usuario</option>
          </select>
          <select name="region" id="region" title="Regional" required>
            <option value="" selected disabled>Seleccione region de acceso</option>
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
          <input type="text" name="usuario" id="usuario" placeholder="Nombre de usuario" title="Nombre de usuario">
          <input type="password" name="pass2" id="pass2" placeholder="Introduzca contraseña" required title="Contraseña">
          <input type="password" name="pass3" id="pass3" placeholder="Repita la contraseña" required title="Repita la contraseña por favor">
          <input class="submit button" type="submit" value="Añadir usuario">
          <div class="row cf" style="color: red"><p id="error"></p></div>
        </fieldset>
      </form>
    </div>
  </div>
  
  <script type="text/javascript">
      with(document.update_user){
        onsubmit = function(e){
        e.preventDefault();
        var x=true;
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

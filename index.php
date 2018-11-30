<?php
session_start();
if(isset($_SESSION["tipo"])){
    if($_SESSION["tipo"]!=null){
      if($_SESSION["tipo"]==0){
        print "<script>alert(\"Hay una sesion activa, por favor cierrela\");window.location='views/page_admin.php';</script>";
      }
      else{
        print "<script>alert(\"Hay una sesion activa, por favor cierrela\");window.location='views/page_user.php';</script>";
      }
      }
    }
?>
<!DOCTYPE html>
<html >
<head>
 <meta charset="UTF-8">
 <title>SisCon | ProMujer</title>

 <link rel="shortcut icon" href="assets/favicono.ico">
 <link rel='stylesheet' href='css/normalize.min.css'>
 <link rel='stylesheet' href='css/typicons.min.css'>
 <link rel="stylesheet" href="css/style.css">


</head>

<body>
     <header id="header">
      <div class="main_nav">
       <div class="container">
        <div class="mobile-toggle"> <span></span> <span></span> <span></span> </div>
     </div>
  </div>
  <div class="title">

    <div class="heading"><img src="images/LOGOPROMUJER.png" width="60%"></div>
    <div class="smallsep heading"></div>
    <h1 class="heading"> SISCON</h1>
    <h2 class="heading">SISTEMA DE CONTROL DE CONTRATOS</h2>
    <center>
    <div class="btn">

  <div class="btn-back">
    <form name="login" method="post" action="controller/login.php" class="login">
      <br>
      <br>
    <h4>INGRESE SUS DATOS POR FAVOR</h4>
    <input type="text" name="nombre_usuario" id="nombre_usuario" class="login-input" placeholder="Nombre de Usuario" autofocus><br>
    <input type="password" name="password" class="login-input" placeholder="Contraseña"><br>
    <input type="submit" value="Entrar" class="login-submit">
    <font color="red">
    <div id="msg"></div>
    </font>
    <font color="red">
    <div id="msg"></div>
    </font>
  </form>
  </div>
  <div class="btn-front">Ingresar</div>

</div>
</center>
</div>

</div>

 </header>

<script src="js/valida_login.js"></script>
<script src='js/jquery.min.js'></script>
<script src='js/TweenMax.min.js'></script>
<script src="js/index.js"></script>

</body>
</html>


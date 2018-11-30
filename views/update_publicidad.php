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
      <form name="crea_publicidad" class="form-wrapper" method="post" action="../controller/update_publicidad.php" enctype="multipart/form-data">
        <?php 
          extract($_GET);
          require("../controller/conexion.php");
          $sql="SELECT * FROM licenpu WHERE id_licenpub=$id";
          $ressql=mysqli_query($con,$sql);
          while ($row=mysqli_fetch_row($ressql)) {
            $region=$row[1];
            $centro_focal=$row[2];
            $licencia_publicidad=$row[3];
            $letreros=$row[4];
            $vigencia_letreros=$row[5];
            $respaldo_adosada=$row[6];
            $pintada=$row[7];
            $microperforadora=$row[8];
            $autopartes=$row[9];
            $fecha_emision=$row[10];
            $fecha_vencimiento=$row[11];
            $respaldo=$row[12];
            $observaciones=$row[13];
            $pago_patentes=$row[14];
            $respaldo_patentes=$row[15];
          }
          mysqli_close($con);
         ?>
        <fieldset class="section is-active">
          <h3>Introduzca los datos de la licencia</h3>
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
          <input type="text" name="centro_focal" id="centro_focal" placeholder="Centro Focal" value="<?php echo $centro_focal; ?>">
          <select name="cuenta" id="cuenta" required>
            <option value="<?php echo $licencia_publicidad; ?>" selected><?php echo $licencia_publicidad; ?></option>
            <option value="SI">Si</option>
            <option value="NO">No</option>
            <option value="TRAMITE">En tramite</option>
          </select>
          <select name="adosada" id="adosada" required>
            <option value="<?php echo $letreros; ?>" selected><?php echo $letreros; ?></option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
          </select>
          <input type="text" name="vigencia" id="vigencia" placeholder="Vigencia(letreros)" onfocus="(this.type='date')" value="<?php echo $vigencia_letreros; ?>">
          <h3>Seleccione el documento escaneado</h3>
          <input type="file" name="respaldo" id="respaldo" accept="image/*, application/pdf">
          <select name="pintada" id="pintada" required>
            <option value="<?php echo $pintada; ?>" selected><?php echo $pintada; ?></option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
          </select>
          <select name="microperforadora" id="microperforadora" required>
            <option value="<?php echo $microperforadora; ?>" selected><?php echo $microperforadora; ?></option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
          </select>
          <select name="autoportantes" id="autoportantes" required>
            <option value="<?php echo $autopartes; ?>" selected><?php echo $autopartes; ?></option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
          </select>
          <input type="text" name="fecha_ini" id="fecha_ini" placeholder="Fecha de emision" onfocus="(this.type='date')" value="<?php echo $fecha_emision; ?>">
          <input type="text" name="fecha_fin" id="fecha_fin" placeholder="Fecha de vencimiento" onfocus="(this.type='date')" value="<?php echo $fecha_vencimiento; ?>">
          <h3>Se cuenta con documento escaneado en archivo</h3>
          <input type="file" name="archivo" id="archivo" accept="image/*, application/pdf">
          <input type="text" name="observaciones" id="observaciones" placeholder="Observaciones" value="<?php echo $observaciones; ?>">
          <input type="number" name="pago_patentes" id="pago_patentes" placeholder="Año pago de patentes" value="<?php echo $pago_patentes; ?>">
          <h3>Suba el archivo de pago de patentes</h3>
          <input type="file" name="respaldo_patentes" accept="application/pdf, image/*">
          <input class="submit button" type="submit" value="Actualizar licencia">
          <div class="row cf" style="color: red"><p id="error"></p></div>
          <input type="hidden" name="ide" id="ide" value="<?php echo $id; ?>">
          <input type="hidden" name="docu1" id="docu1" value="<?php echo $respaldo_adosada; ?>">
          <input type="hidden" name="docu2" id="docu2" value="<?php echo $respaldo; ?>">
          <input type="hidden" name="docu3" id="docu3" value="<?php echo $respaldo_patentes; ?>">
        </fieldset>
      </form>
    </div>
  </div>
  <script type="text/javascript" src="../js/jquery-2.2.3.min.js"></script>
  <script src="../js/cabecera.js"></script> 
    <script type="text/javascript">
      with(document.crea_publicidad){
        onsubmit = function(e){
        e.preventDefault();
        if(fecha_ini.value=="0000-00-00"){
          document.getElementById("fecha_ini").innerHTML=null;
        }
        if(fecha_fin.value=="0000-00-00"){
          document.getElementById("fecha_fin").innerHTML=null;
        }
        submit(); 
  }
}
    </script>
</body>
</html>

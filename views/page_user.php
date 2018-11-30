<?php
session_start();
if(!isset($_SESSION["tipo"])){
        print "<script>alert(\"Acceso denegado, Debe identificarse para ingresar al sistema\");window.location='../index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Usuario</title>
    <link rel="shortcut icon" href="../assets/favicono.ico">
    

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="../css/mdb.min.css" rel="stylesheet">

    <!-- Template styles -->
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="../css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="../css/cabecera.css"> <!-- Resource style -->
    <link rel="stylesheet" type="text/css" href="../css/page_user.css">
	<script src="../js/modernizr.js"></script> <!-- Modernizr -->
    <style>
        /* TEMPLATE STYLES */
        
        html,
        body,
        .view {
            height: 100%;
        }
        /* Navigation*/
        
        .navbar {
            background-color: transparent;
        }
        
        .scrolling-navbar {
            -webkit-transition: background .5s ease-in-out, padding .5s ease-in-out;
            -moz-transition: background .5s ease-in-out, padding .5s ease-in-out;
            transition: background .5s ease-in-out, padding .5s ease-in-out;
        }
        
        .top-nav-collapse {
            background-color: #3c4f74;
        }
        
        footer.page-footer {
            background-color: #3c4f74;
            margin-top: 2rem;
        }
        
        @media only screen and (max-width: 768px) {
            .navbar {
                background-color: #1C2331;
            }
        }
        /*Call to action*/
        
        .flex-center {
            color: #fff;
        }
        
        .view {
            background: url("../images/Administrador.jpg")no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        /*Contact section*/
        
        #contact .fa {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #1C2331;
        }
    </style>
</head>

<body>
	<nav class="cd-stretchy-nav">
		<a class="cd-nav-trigger" href="#0">
			
			<span aria-hidden="true"></span>
		</a>

		<ul>
			<li><a href="#" class="active"><span>Tareas Principales</span></a></li>
			<li><a href="../views/update_password.php?id=<?php echo $_SESSION['user_id']?>"><span>Cambiar contraseña</span></a></li>
            <?php 
                if ($_SESSION['tipo']==0) {
                    echo "<li><a href='../views/page_admin.php'><span>Volver al Panel de administrador</span></a></li>";
                }
             ?>
			<li><a href="../controller/logout.php"><span>Salir: <?php echo $_SESSION["nombres"]  ?></span></a></li>
		</ul>

		<span aria-hidden="true" class="stretchy-nav-bg"></span>
	</nav>
    <!--Mask-->
    <div class="view hm-black-strong">
        <div class="full-img flex-center">
            <ul>
                <li>
                    <h1 class="h1-responsive wow fadeInDown" data-wow-delay="0.2s"><?php if(strcmp("M",$_SESSION["sexo"])==0){ echo "Bienvenido: ";}else{ echo "Bienvenida: ";} echo $_SESSION["nombres"]?></h1>
                </li>
                <li>
                    <p class="wow fadeInUp">Elija que tareas desea hacer</p>
                    <br>
                    <br>
                    <div style="height: 500px;">
                    <section class="">

    <dl class=" fadeInDown list nigiri">
        <dt>Contratos</dt>
        <dd><a href="../views/alquileres.php">Alquileres</a></dd>
        <dd><a href="../views/limpieza.php">Limpieza</a></dd>
        <dd><a href="../views/seguridad.php">Seguridad</a></dd>
        <dd><a href="../views/monitoreo.php">Monitoreo de alarmas</a></dd>
        <dd><a href="../views/extintor.php">Extintores</a></dd>
        <dd><a href="../views/lineas.php">Lineas Telefonicas</a></dd>
        <dd><a href="../views/otros.php">Otros contratos</a></dd>
    </dl>

    <dl class="fadeInDown list maki">
        <dt>Impuestos</dt>
        <dd><a href="../views/automotores.php">Automotores</a></dd>
        <dd><a href="../views/inmuebles.php">Inmuebles</a></dd>
        <dd><a href="../views/nit.php">NIT</a></dd>
    </dl>

    <dl class="fadeInDown list sashimi">
        <dt>Licencias</dt>
        <dd><a href="../views/funcionamiento.php">Funcionamiento</a></dd>
        <dd><a href="../views/publicidad.php">Publicidad</a></dd>
        <dd><a href="../views/baja.php">Baja licencias</a></dd>
    </dl>


</section>

</div>
                </li>
            </ul>
            
        </div>

    </div>


    <!--/.Mask-->
    
	
    



   


    <!-- SCRIPTS -->

    <!-- JQuery -->
    <script type="text/javascript" src="../js/jquery-2.2.3.min.js"></script>

    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="../js/tether.min.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="../js/mdb.min.js"></script>
   
	<script src="../js/cabecera.js"></script> 
	<script>
        new WOW().init();
    </script>
    <script type="text/javascript" src="../js/page_user.js"></script>


</body>

</html>
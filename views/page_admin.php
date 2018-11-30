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
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Administrador</title>
    <link rel="shortcut icon" href="../assets/favicono.ico">
    <link rel="stylesheet" type="text/css" href="../css/page_admin.css">

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
			<li><a href="#0" class="active"><span>Tareas Principales</span></a></li>
			<li><a href="../views/update_password.php?id=<?php echo $_SESSION['user_id']?>"><span>Cambiar contraseña</span></a></li>
			<li><a href="../controller/logout.php"><span>Salir: <?php echo $_SESSION["nombres"]  ?></span></a></li>
		</ul>

		<span aria-hidden="true" class="stretchy-nav-bg"></span>
	</nav>
    
    <!--Mask-->
    <div class="view hm-black-strong">
        <div class="full-img flex-center">
            <ul>
                <li>
                    <h1 class="h1-responsive wow fadeInDown" data-wow-delay="0.2s">Bienvenido: <?php echo $_SESSION["nombres"] ?></h1>
                </li>
                <li>
                    <p class="wow fadeInUp">Elija que tareas desea hacer</p>
                    <br>
                    <br>
       <a href="../views/add_user.php">
	<div class="wow fadeInUp cover atvImg">
		<div class="atvImg-layer" data-img="../images/option_request.png"></div>
		<div class="atvImg-layer" data-img="../images/options/option1.png"></div>
	</div></a>
	<a href="../views/view_user.php">
	<div class="wow fadeInUp cover atvImg">
		<div class="atvImg-layer" data-img="../images/option_request.png"></div>
		<div class="atvImg-layer" data-img="../images/options/option2.png"></div>
	</div></a>
	<a href="../views/page_user.php">
	<div class="wow fadeInUp cover atvImg">
		<div class="atvImg-layer" data-img="../images/option_request.png"></div>
		<div class="atvImg-layer" data-img="../images/options/option3.png"></div>
	</div></a>

	
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
    <script type="text/javascript" src="../js/page_admin.js"></script>
	<script type="text/javascript" src="../js/jquery-2.2.3.min.js"></script>
	<script src="../js/cabecera.js"></script> 
	<script>
        new WOW().init();
    </script>
    


</body>

</html>
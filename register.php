<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);

require('_assets/classes/register.class.php');
require('_assets/classes/phpCommon/BlockXSS.class.php');
require('_assets/classes/phpCommon/MySqlPdoHandler.class.php');

$database_name = "photogram";
$MySqlHandler =  MySqlPdoHandler::getInstance(); 
$MySqlHandler->connect($database_name);
$MySqlHandler->Query("SET NAMES utf8");

$Register = new Register($MySqlHandler);
$Register->setData();
$process = $Register->process();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Photogram | Crear Cuenta</title>

    <!-- begin CSS-->
	<link rel="stylesheet" type="text/css" href="_assets/css/bootstrap.css">
	<!-- font icons-->
	<link rel="stylesheet" type="text/css" href="_assets/fonts/icomoon.css">
	<link rel="stylesheet" type="text/css" href="_assets/fonts/flag-icon-css/css/flag-icon.min.css">
	<link rel="stylesheet" type="text/css" href="_assets/vendors/css/extensions/pace.css">

	<link rel="stylesheet" type="text/css" href="_assets/css/bootstrap-extended.css">
	<link rel="stylesheet" type="text/css" href="_assets/css/app.css">
	<link rel="stylesheet" type="text/css" href="_assets/css/colors.css">

	<link rel="stylesheet" type="text/css" href="_assets/css/core/menu/menu-types/vertical-menu.css">
	<link rel="stylesheet" type="text/css" href="_assets/css/core/menu/menu-types/vertical-overlay-menu.css">
	<link rel="stylesheet" type="text/css" href="_assets/css/core/colors/palette-gradient.css">

	<link rel="stylesheet" type="text/css" href="_assets/css/style.css">
	<!-- end CSS-->

	<link rel="shortcut icon" type="image/png" href="_assets/img/brand/logo_icon.png">
</head>


<body data-open="click" data-menu="vertical-menu" data-col="1-column" class="vertical-layout vertical-menu 1-column  blank-page blank-page">
<? error_reporting(E_ALL ^ E_NOTICE); ?>

	<div class="app-content content container-fluid" style="padding:20px;">
		<div class="content-wrapper">

			<div class="content-body">
				<section class="flexbox-container">
					<div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1  box-shadow-2 p-0">
						<div class="card border-grey border-lighten-3 m-0">

							<div class="card-header no-border">
								<div class="card-title text-xs-center">
								    <div class="p-1"><img src="_assets/img/brand/logo.png" alt="branding logo" width="180"></div>
								</div>
							</div>

                            <?php print $process; ?>

							<div class="card-footer">
                                <p class="float-sm-left text-xs-center m-0">¿Ya tienes cuenta? <a href="./" class="card-link">Empieza a usar Photogram!</a></p>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>


    
    <!-- begin JS-->
	<script src="_assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
	<script src="_assets/vendors/js/ui/tether.min.js" type="text/javascript"></script>
	<script src="_assets/js/core/libraries/bootstrap.min.js" type="text/javascript"></script>
	<script src="_assets/vendors/js/ui/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
	<script src="_assets/vendors/js/ui/unison.min.js" type="text/javascript"></script>
	<script src="_assets/vendors/js/ui/blockUI.min.js" type="text/javascript"></script>
	<script src="_assets/vendors/js/ui/jquery.matchHeight-min.js" type="text/javascript"></script>
	<script src="_assets/vendors/js/ui/screenfull.min.js" type="text/javascript"></script>
	<script src="_assets/vendors/js/extensions/pace.min.js" type="text/javascript"></script>
    
	<script type="text/javascript" src="_assets/vendors/js/ui/prism.min.js"></script>
    
	<script src="_assets/js/core/app-menu.js" type="text/javascript"></script>
	<script src="_assets/js/core/app.js" type="text/javascript"></script>
    
	<script src="_assets/js/scripts/pages/dashboard-lite.js" type="text/javascript"></script>
	<!-- end JS-->
    
    
</body>

</html>
<!DOCTYPE html>
<html>

<head>
    <title>Photogram | Login</title>

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

	<div class="app-content content container-fluid">
		<div class="content-wrapper">
			<div class="content-header row">
			</div>

			<div class="content-body">
				<section class="flexbox-container">
					<div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1  box-shadow-2 p-0">
						<div class="card border-grey border-lighten-3 m-0">

							<div class="card-header no-border">
								<div class="card-title text-xs-center">
								    <div class="p-1"><img src="_assets/img/brand/logo.png" alt="branding logo" width="180"></div>
								</div>
							</div>

							<div class="card-body collapse in">
								<div class="card-block">
									<form method="post" role="form" class="form-horizontal form-simple" action="./">
										<fieldset class="form-group position-relative has-icon-left mb-0">
											<input type="email" class="form-control" name="email" placeholder="Correo Electrónico" required>
											<div class="form-control-position">
												<i class="icon-head"></i>
											</div>
										</fieldset>
                                        <br>
										<fieldset class="form-group position-relative has-icon-left">
											<input type="password" class="form-control" name="password" placeholder="Contraseña" required>
											<div class="form-control-position">
												<i class="icon-key3"></i>
											</div>
										</fieldset>
										<center>
											<p style="color:darkred;"><?php echo ($_GET['error']?$_GET['error']:''); ?></p>
											<?php
											/*require_once 'vendor/autoload.php';
											require_once 'config.php';
											
											// create Client Request to access Google API 
											$client = new Google_Client();
											$client->setClientId($clientID);
											$client->setClientSecret($clientSecret);
											$client->setRedirectUri($redirectUri);
											$client->addScope("email");
											$client->addScope("profile");
											// authenticate code from Google OAuth Flow 
											if (isset($_GET['code'])) {
												$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
												$client->setAccessToken($token['access_token']);
												
												// get profile info 
												$google_oauth = new Google_Service_Oauth2($client);
												$google_account_info = $google_oauth->userinfo->get();
												$email =  $google_account_info->email;
												$name =  $google_account_info->name;
												// now you can use this profile info to create account in your website and make user logged in. 
											} else {
												print "<a href='".$client->createAuthUrl()."' target='_blank' class='btn btn-danger btn-block'><i class='icon-google'></i>&nbsp; Iniciar Sesión Con Google</a>";
											}*/
											?>
										</center>
										<hr>

										<fieldset class="form-group row">
											<div class="col-md-6 col-xs-12 text-xs-center text-md-left">
												<fieldset>
													<input name="remember_me" type="checkbox" value="Remember Me" checked>
													<label for="remember_me"> Mantener la sesión iniciada</label>
												</fieldset>
											</div>

											<div class="col-md-6 col-xs-12 text-xs-center text-md-right">
												<!-- <a href="recover-password.html" class="card-link">Forgot Password?</a> -->
											</div>
										</fieldset>
									<button type="submit" class="btn btn-success btn-lg btn-block"><i class="icon-unlock2"></i> Iniciar Sesión</button>
									</form>
								</div>
							</div>
							<div class="card-footer">
                                <p class="float-sm-left text-xs-center m-0">¿No tienes cuenta? <a href="register.php" class="card-link">Crea Una   </a></p>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>

	<!-- ////////////////////////////////////////////////////////////////////////////-->


    
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
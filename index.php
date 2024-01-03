<?php include ('_assets/classes/header.inc.php');
$Posts->setData();
$process = $Posts->process();

$key_api = "e75bcd4507fc98c8f2ca8039d3ded024";
$id_city = 4013708;
$owApiUrl = "http://api.openweathermap.org/data/2.5/weather?id=".$id_city."&lang=en&units=metric&APPID=". $key_api;

/* Curl connection */
$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $owApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
curl_close($ch);

/* Decode and check cod */
$data = json_decode($response);
//if($data->cod != 200) exit("An error has occurred: ".$data->message);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Photogram | Index</title>

    <!-- begin CSS-->
	<link rel="stylesheet" type="text/css" href="_assets/css/bootstrap.css">
	<!-- font icons-->
	<link rel="stylesheet" type="text/css" href="_assets/fonts/icomoon.css">
	<link rel="stylesheet" type="text/css" href="_assets/fonts/flag-icon-css/css/flag-icon.min.css">
	<link rel="stylesheet" type="text/css" href="_assets/vendors/css/extensions/pace.css">

	<link rel="stylesheet" type="text/css" href="_assets/css/bootstrap-extended.css">
	<link rel="stylesheet" type="text/css" href="_assets/css/app.css">
	<link rel="stylesheet" type="text/css" href="_assets/css/colors.css">

	<link rel="stylesheet" type="text/css" href="_assets/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="_assets/css/alertify.min.css">
	<link rel="stylesheet" type="text/css" href="_assets/css/alertify.rtl.css">
	<link rel="stylesheet" type="text/css" href="_assets/css/alertify.rtl.min.css">

	<link rel="stylesheet" type="text/css" href="_assets/css/core/menu/menu-types/vertical-menu.css">
	<link rel="stylesheet" type="text/css" href="_assets/css/core/menu/menu-types/vertical-overlay-menu.css">
	<link rel="stylesheet" type="text/css" href="_assets/css/core/colors/palette-gradient.css">

	<link rel="stylesheet" type="text/css" href="_assets/css/style.css">
	<!-- end CSS-->

	<link rel="shortcut icon" type="image/png" href="_assets/img/brand/logo_icon.png">

	<script src="./_assets/js/vue.global.js"></script>
</head>

<body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">
    <?php include ('_assets/includes/top-navbar.inc.php'); ?>

    <?php include ('_assets/includes/side-navbar.inc.php'); ?>

    <!-- /Content Of Dashboard Page -->
    <div id="app" class="app-content content container-fluid">
		<div class="content-wrapper">
            <?php print $process; ?>
			<!-- {{ message }} -->
        </div>
    </div>
    <!-- /End Of Content Of Dashboard Page -->


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
	
	<!-- AlertifyJS -->
	<script src="_assets/js/alertify.js" type="text/javascript"></script>
	<script src="_assets/js/alertify.min.js" type="text/javascript"></script>

	<script src="_assets/js/myfunctions.js" type="text/javascript"></script>
	<!-- end JS-->

	<script>
		var app = new Vue({
			el: '#app',
			delimiters:["[[", "]]"],
			data: {
				postID : '',
			},
			mounted: function(){
				//this.getProductFamily();
				alert(this.postID);
			},
			methods: {
				likePost: function () {
					let success =  (response) => {
						alert("te gusta este post");
					};

					let error =  (response) => { 
						alert(response);
					}; 

					this.$http.post("./?action=like_post").then(success, error); 
				},				
			}
		});
	</script>
</body>

</html>
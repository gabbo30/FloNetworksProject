<?php include ('_assets/classes/header.inc.php');
$Profile->setData();
$process = $Profile->process();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Photogram | Perfil</title>

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

<body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">
    <?php include ('_assets/includes/top-navbar.inc.php'); ?>

    <?php include ('_assets/includes/side-navbar.inc.php'); ?>

    <!-- /Content Of Dashboard Page -->
    <div class="app-content content container-fluid">
		<div class="content-wrapper">
            <?php print $process; ?>
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
	<script src="_assets/js/myfunctions.js" type="text/javascript"></script>

	<script type="text/javascript" src="_assets/vendors/js/ui/prism.min.js"></script>
	<script src="_assets/js/core/app-menu.js" type="text/javascript"></script>
	<script src="_assets/js/core/app.js" type="text/javascript"></script>
	<script src="_assets/js/scripts/pages/dashboard-lite.js" type="text/javascript"></script>


	<!-- / API de Google Maps consumida directamente de Google APIs / -->
	<script>
		/*var lat_actual = document.getElementById('user_lat').value;
		var lon_actual = document.getElementById('user_lon').value;
		var direccion_actual = new google.maps.LatLng(lat_actual, lon_actual);
		document.getElementById('user_location').value = direccion_actual;*/

		function iniciarmapa()
		{
			var latitud = 31.73770530314156;
			var longitud = -106.43338401349182;
			coor = {
				lat: latitud,
				lng: longitud
			}
			generarmapa(coor);
		}

		function generarmapa(coor)
		{
			var mapa = new google.maps.Map(document.getElementById('mapa'), {
				zoom: 18,
				center: new google.maps.LatLng(coor.lat, coor.lng),
			});
			marcador = new google.maps.Marker({
				map: mapa,
				draggable: true,
				position: new google.maps.LatLng(coor.lat, coor.lng), 
			});
			//var direccion_actual = new google.maps.LatLng(coor.lat, coor.long);
			marcador.addListener('dragend', function(event){
				document.getElementById('lat').value = this.getPosition().lat();
				document.getElementById('lon').value = this.getPosition().lng();
				//document.getElementById('dir').value = direccion_actual;
			});
		}
	</script>

	<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvmV4kM5AFewdngA_RxOVcU0UNowOBdz4&callback=iniciarmapa">
    </script>
	<!-- end JS-->
</body>
<!-- Mi Secret Key de Google Maps APIs: AIzaSyCvmV4kM5AFewdngA_RxOVcU0UNowOBdz4 -->
</html>
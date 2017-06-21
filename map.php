<!DOCTYPE html>
<? $data = parse_ini_file('config.ini'); ?>
<html lang="<?= $data['lang'] ?>">
<head>
	<meta charset="<?= $data['charset'] ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Google maps dojazd</title>
	<link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdn.rawgit.com/driftyco/ionicons/3.0/dist/css/ionicons.css">
	<link rel="stylesheet" href="assets/css/gmRoute.css">
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<h1>Google maps dojazd</h1>
		<div id="map_canvas"></div>
	</div>
	<form onSubmit="calcRoute();return false;" id="routeForm">
		<div class="row">
			<div class="col-4 ml-auto">
				<div class="row" style="overflow: hidden">
					<div class="col-12">
						<label>
							Twoja lokalizacja: <br />
							<input type="text" id="routeStart" value="Bielsko-Biała" placeholder="Wpisz nazwę miasta">
						</label>
					</div>
					<div class="col-12">
						<div class="h5">Środek transportu<!-- Travel mode -->:</div>
							<label>
								<input type="radio" name="travelMode" value="DRIVING" hidden checked />
								<span class="icon-check icon-car" data-toggle="tooltip" title="Samochód"></span><!-- Driving -->
							</label>
							<label>
								<input type="radio" name="travelMode" value="TRANSIT" hidden />
								<span class="icon-check icon-transit" data-toggle="tooltip" title="Transport publiczny"></span><!-- Public transport -->
							</label>
							<label>
								<input type="radio" name="travelMode" value="BICYCLING" hidden />
								<span class="icon-check icon-bike" data-toggle="tooltip" title="Rower"></span><!--Bicylcing -->
							</label>
							<label>
								<input type="radio" name="travelMode" value="WALKING" hidden />
								<span class="icon-check icon-walking" tdata-toggle="tooltip" itle="Pieszo"></span><!-- Walking -->
							</label>
					</div>
					<div class="col-12">
						<button type="submit" class="btn btn-secondary">
							<i class="icon ion-ios-search"></i>
							Oblicz trase
						</button><!-- Calculate route -->
					</div>
				</div>
			</div>
		</div>
	</form>
	<div id="directionsPanel">
		s
		<!-- Enter a destination and click "Calculate route". -->
	</div>
</div>
<footer class="text-center">
	<a href="https://spoko.space">spoko.space</a>
</footer>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<!-- <script src="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js"></script> -->
	<script src="https://maps.google.com/maps/api/js?key=<?= $data['key'] ?>"></script>
	<script src="assets/js/gmRoute.js"></script>
</body>
</html>
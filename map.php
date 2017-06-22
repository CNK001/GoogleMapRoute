<!DOCTYPE html>
<? $data = parse_ini_file('config.ini'); ?>
<html lang="<?= $data['lang'] ?>">
<head>
	<meta charset="<?= $data['charset'] ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Google maps dojazd</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.rawgit.com/driftyco/ionicons/3.0/dist/css/ionicons.css">
	<link rel="stylesheet" href="assets/css/gmRoute.css">
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<h1>Google maps dojazd</h1>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div id="map_canvas"></div>
	</div>
	<div class="gmRoute-form">
		<div id="routeForm">
			<div class="row">
				<div class="gmRoute-forum__widget text-right">
					<div class="row">
						<div class="col-12">
							<div><small>Twoja lokalizacja:</small></div>
							<div class="input-group">
								<input type="text" id="routeStart" class="form-control" placeholder="Twoja lokalizacja...">
								<span class="input-group-btn"><!-- Calculate route -->
									<button class="btn btn-secondary btn-calculate-route" id="calculate-route">
										<span class="icon ion-ios-search"></span>
									</button>
								</span>
							</div>
						</div>
						<div class="col-12">
							<div><small>Środek transportu</small><!-- Travel mode -->:</div>
								<label>
									<input type="radio" name="travelMode" value="DRIVING" hidden checked />
									<span class="icon-travel-mode icon-check icon-car" data-toggle="tooltip" title="Samochód"></span><!-- Driving -->
								</label>
								<label>
									<input type="radio" name="travelMode" value="TRANSIT" hidden />
									<span class="icon-travel-mode icon-check icon-transit" data-toggle="tooltip" title="Transport publiczny"></span><!-- Public transport -->
								</label>
								<label>
									<input type="radio" name="travelMode" value="BICYCLING" hidden />
									<span class="icon-travel-mode icon-check icon-bike" data-toggle="tooltip" title="Rower"></span><!--Bicylcing -->
								</label>
								<label>
									<input type="radio" name="travelMode" value="WALKING" hidden />
									<span class="icon-travel-mode icon-check icon-walking" data-toggle="tooltip" title="Pieszo"></span><!-- Walking -->
								</label>

								<button id="show-more" class="btn btn-primary btn-sm invisible" data-toggle="modal" data-target=".modal-show-directions">Pokaż szczegóły dojazdu</button>
						</div><!-- Calculate route -->
					</div>
				</div>
			</div>
		</div>
	</div>

<div class="modal fade modal-show-directions" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true" class="ion-ios-close-outline"></span>
			</button>
			<div class="modal-body">
				<div id="directionsPanel">...</div>
			</div>
		</div>
	</div>
</div>

</div>
<footer class="text-center">
	<a href="https://spoko.space">spoko.space</a>
</footer>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
	<script src="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js"></script>
	<script src="https://maps.google.com/maps/api/js?key=<?= $data['key'] ?>"></script>
	<script src="assets/js/gmRoute.js"></script>
</body>
</html>
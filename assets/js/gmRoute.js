var lat = 50.2638321;
var lng = 19.0328274;
var default_icon = 'navyblue';
var map;
var directionDisplay;
var directionsService = new google.maps.DirectionsService(lat,lng);
var show_more = document.getElementById('show-more');
var iconBase = 'https://cnk.net.pl/testy/img/';
var input_places_searchbox = document.getElementById('pac-input');
var icons = {
	darkgrey: {
		icon: iconBase + 'dark-grey-marker.png'
	},
	silver: {
		icon: iconBase + 'silver-marker.png'
	},
	grey: {
		icon: iconBase + 'grey-marker.png'
	},
	orange: {
		icon: iconBase + 'orange-marker.png'
	},
	caribbeanblue: {
		icon: iconBase + 'caribbean-blue-marker.png'
	},
	navyblue: {
		icon: iconBase + 'navy-blue-marker.png'
	}
};

var travelMode_radios = document.getElementsByName("travelMode");
x = travelMode_radios.length;
while(x--) {
	travelMode_radios[x].addEventListener("change",function() {
		console.log("Checked: "+this.checked);
		console.log("Name: "+this.name);
		console.log("Value: "+this.value);
	},0);
}

function initialize() {
	var latlng = new google.maps.LatLng(lat,lng);
	// set direction render options
	var rendererOptions = {	draggable: true	};
	directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);
	var myOptions = {
		zoom: 15,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP, //or HYBRID
		mapTypeControl: true //Map & Satellite labels
	};

	// add the map to the map placeholder
	var map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
	directionsDisplay.setMap(map);
	directionsDisplay.setPanel(document.getElementById("directionsPanel"));

	// Add a marker to the map for the end-point of the directions.
	var marker = new google.maps.Marker({
		position: latlng,
		map: map,
		icon: icons[default_icon].icon
	});

	// Create the search box and link it to the UI element.
	var searchBox = new google.maps.places.SearchBox(input_places_searchbox);
	map.controls[google.maps.ControlPosition.TOP_LEFT].push(input_places_searchbox);

	// Bias the SearchBox results towards current map's viewport.
	map.addListener('bounds_changed', function() {
		searchBox.setBounds(map.getBounds());
	});

	var markers = [];
	// Listen for the event fired when the user selects a prediction and retrieve
	// more details for that place.
	searchBox.addListener('places_changed', function() {
		var places = searchBox.getPlaces();

		if (places.length == 0) {
		return;
		}

	// Clear out the old markers.
	markers.forEach(function(marker) {
		marker.setMap(null);
	});
		markers = [];

	// For each place, get the icon, name and location.
	var bounds = new google.maps.LatLngBounds();
		places.forEach(function(place) {
			if (!place.geometry) {
				console.log("Returned place contains no geometry");
				return;
			}
			var icon = {
				url: place.icon,
				size: new google.maps.Size(71, 71),
				origin: new google.maps.Point(0, 0),
				anchor: new google.maps.Point(17, 34),
				scaledSize: new google.maps.Size(25, 25)
			};

			// Create a marker for each place.
			markers.push(new google.maps.Marker({
				map: map,
				icon: icon,
				title: place.name,
				position: place.geometry.location
			}));

			if (place.geometry.viewport) {
				// Only geocodes have viewport.
				bounds.union(place.geometry.viewport);
			} else {
				bounds.extend(place.geometry.location);
			}
		});
		map.fitBounds(bounds);
		calcRoute();return false; //show directions from selected place
	});

}

input_places_searchbox.onkeypress = function(e){
	if (!e) e = window.event;
	var keyCode = e.keyCode || e.which;
	if (keyCode == '13') {
		calcRoute();return false;
	}
}

function calcRoute() {

	// get the travelmode, startpoint and via point from the form
	var travelMode = $('input[name="travelMode"]:checked').val();
	var start = document.getElementById("pac-input").value
	var end = lat+','+lng; // endpoint is a geolocation
	var waypoints = []; // init an empty waypoints array
	var request = {
		origin: start,
		destination: end,
		waypoints: waypoints,
		unitSystem: google.maps.UnitSystem.METRIC, //IMPERIAL for miles, METRIC for km
		travelMode: google.maps.DirectionsTravelMode[travelMode]
	};
	directionsService.route(request, function(response, status) {
		if (status == google.maps.DirectionsStatus.OK) {
			$('#directionsPanel').empty(); // clear the directions panel before adding new directions
			directionsDisplay.setDirections(response);
			//clean A and B markers
			directionsDisplay.setOptions( { suppressMarkers: true } );
			show_more.classList.remove("invisible");
		} else {
			// alert an error message when the route could nog be calculated.
			if (status == 'ZERO_RESULTS') {
				alert('No route could be found between the origin and destination.');
			} else if (status == 'UNKNOWN_ERROR') {
				alert('A directions request could not be processed due to a server error. The request may succeed if you try again.');
			} else if (status == 'REQUEST_DENIED') {
				alert('This webpage is not allowed to use the directions service.');
			} else if (status == 'OVER_QUERY_LIMIT') {
				alert('The webpage has gone over the requests limit in too short a period of time.');
			} else if (status == 'NOT_FOUND') {
				alert('At least one of the origin, destination, or waypoints could not be geocoded.');
			} else if (status == 'INVALID_REQUEST') {
				alert('The DirectionsRequest provided was invalid.');
			} else {
				alert("There was an unknown error in your request. Requeststatus: \n\n"+status);
			}
		}
	});
}

google.maps.event.addDomListener(window, 'load', initialize);

document.addEventListener('DOMContentLoaded', function() {
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
}, false);

var button_calculate = document.getElementById("calculate-route");
button_calculate.addEventListener("click",function(e) {
	calcRoute();return false;
},false);
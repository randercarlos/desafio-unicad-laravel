/******************************************************************************
How to get Driving Navigation using Javascript and Google Map API
Bytutorial.com - Share and learn web and mobile programming.
*******************************************************************************/

//Init the geocoder library
var geocoder = new google.maps.Geocoder();

//array to hold the geo address
var geoAddress = [];

//function framework
bytutorialMap = {
	initNavigateMap: function (mapID, panelDirectionID, startLatitude, startLongitude, endLatitude, endLongitude) {
		var directionsDisplay = new google.maps.DirectionsRenderer;
		var directionsService = new google.maps.DirectionsService;
		
		//initialize the map
		var map = new google.maps.Map(document.getElementById(mapID), {
		  center: {lat: startLatitude, lng: startLongitude},
		  zoom: 13,
		  mapTypeId: google.maps.MapTypeId.ROADMAP

		}); 
		
		//clear the direction panel
		$("#" + panelDirectionID).html("");
		directionsDisplay.setMap(map);
		directionsDisplay.setPanel(document.getElementById(panelDirectionID));

		//prepare the latitude and longitude data
		start = startLatitude + ", " + startLongitude;
		end = endLatitude + ", " + endLongitude;
		bytutorialMap.calculateAndDisplayRoute(directionsService, directionsDisplay, start, end);
	},

	//function to get the driving route
	calculateAndDisplayRoute: function (directionsService, directionsDisplay, start, end) {
		directionsService.route({
		  origin: start,
		  destination: end,
		  travelMode: 'DRIVING'
		}, function(response, status) {
			
		  if (status === 'OK') {
			directionsDisplay.setDirections(response);
		  } else {
			alert('Solicitação para obter as direções falhou por causa de ' + status);
		  }
		  
		});
	},

	//get geolocation based on address
	codeAddress: function (address) {
		return new Promise(function(resolve, reject) {
			
			geocoder.geocode({ 'address': address }, function (results, status) {
				
				if (status == google.maps.GeocoderStatus.OK) {
					resolve(results);
				} else {
					reject(Error("Geocode para o endereço " + address + " não foi bem sucedido pela seguinte razão: " 
							+ status));
				}
				
			});
			
		});
	},
	
	//function to get geolocation of both addresses.
	getGeolocationData: function(endereco_ponto_inicial, endereco_ponto_final){
		
		if(endereco_ponto_inicial != "" && endereco_ponto_final != ""){
			
			geoAddress = [];
			
			bytutorialMap.codeAddress(endereco_ponto_inicial).then(function(response){
				
				var geoData = {
					latitude: response[0].geometry.location.lat(),
					longitude: response[0].geometry.location.lng()
				}
				
				geoAddress.push(geoData);
				
			}).then(function() {
				
				return bytutorialMap.codeAddress(endereco_ponto_final).then(function(response) {
					
					var geoData2 = {
						latitude: response[0].geometry.location.lat(),
						longitude: response[0].geometry.location.lng()
					}
					
					geoAddress.push(geoData2);
					
				});
				
			}).then(function(){
				bytutorialMap.initNavigateMap("map", "panel-direction", geoAddress[0].latitude, geoAddress[0].longitude, 
						geoAddress[1].latitude, geoAddress[1].longitude);
			});
			
		} else {
			
			alert("Favor, informar os dois endereços");
			
		}
	},
	
	//clear entries and map display
	clearEntries: function(){
		//$("#txtStartingPoint, #txtDestinationPoint").val("");
		//$("#map, #panel-direction").html("");
	}
}

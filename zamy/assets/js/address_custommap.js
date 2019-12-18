google.maps.event.addDomListener(window, 'load', function () {
	 
	var options = {
	  //types: ['geocode'],
	  "types" : ["establishment"],
	  componentRestrictions: {country: "in"}
	 };
	 
	var places = new google.maps.places.Autocomplete(document.getElementById('searchInput_address'),options);
	google.maps.event.addListener(places, 'place_changed', function () {
		var place = places.getPlace();
		
		var address = '';
        if (place.address_components) {
			
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }
		
		for (var i = 0; i < place.address_components.length; i++) {
					 
			if(place.address_components[i].types[0] == 'sublocality_level_1'){
               // document.getElementById('searchInput_address').innerHTML = place.address_components[i].long_name;
                document.getElementById('search_address').value = place.address_components[i].long_name;
				 
            }
			
			if(place.address_components[i].types[0] == 'postal_code'){
                document.getElementById('postcode').value = place.address_components[i].long_name;
            }
            if(place.address_components[i].types[0] == 'country'){
                document.getElementById('country').innerHTML = place.address_components[i].long_name;
            }
        }
		
		var latitude = place.geometry.location.lat();
		var longitude = place.geometry.location.lng();
		
        
		var searchInput_address = $('#searchInput_address').val();
		
		document.getElementById('search_address').value = searchInput_address;
		 
        document.getElementById('address_lat').value = latitude;
        document.getElementById('address_lng').value = longitude;
		
		$("#address_lat").val(latitude);
		$("#address_lng").val(longitude);
		
		initialize(latitude,longitude);
		
	});
});

var geocoder;
var map;
function initialize(latitude,longitude) {
	
	geocoder = new google.maps.Geocoder();
	$('#map_wrap').show();
	
	var latLng = new google.maps.LatLng(latitude, longitude);
	var map = new google.maps.Map(document.getElementById('address-location-map'), {
		zoom: 17,
		center: latLng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	  });
	var marker = new google.maps.Marker({
		position: latLng,
		title: 'Point A',
		map: map,
		draggable: true,
		icon: 'http://zamy.in/assets/images/map_marker.png' // null = default icon

	});
	
	addYourLocationButton(map, marker);
	
  // Update current position info.
  updateMarkerPosition(latLng);
  geocodePosition(latLng,latitude,longitude);

  // Add dragging event listeners.
  google.maps.event.addListener(marker, 'dragstart', function(evt) {
    updateMarkerAddress('Dragging...');
 
	geocodePosition(marker.getPosition(),evt.latLng.lat(),evt.latLng.lng());

  });

  google.maps.event.addListener(marker, 'drag', function(evt) {
    updateMarkerStatus('Dragging...');
	 
    updateMarkerPosition(marker.getPosition());
	
	geocodePosition(marker.getPosition(),evt.latLng.lat(),evt.latLng.lng());
  });

  google.maps.event.addListener(marker, 'dragend', function(evt) {
    updateMarkerStatus('Drag ended'); 
	  
    geocodePosition(marker.getPosition(),evt.latLng.lat(),evt.latLng.lng());
  });
  

}
function geocodePosition(pos,latitude,longitude) {
	
		   
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
	   
    if (responses && responses.length > 0) {  
		
		var current_area = '';
		var pincode = '';
		
		for (var i = 0; i < responses[0].address_components.length; i++) {
			
			 
			//console.log(responses[0].address_components[i].types[0] +"= "+ responses[0].address_components[i].long_name);
			
			 
			if(responses[0].address_components[i].types[0] == 'postal_code'){
                document.getElementById('postcode').value = responses[0].address_components[i].long_name; 
				pincode = responses[0].address_components[i].long_name
            }
			
            if(responses[0].address_components[i].types[0] == 'country'){ 
                document.getElementById('country').value = responses[0].address_components[i].long_name;
            }
			
			if(responses[0].address_components[i].types[0] == 'administrative_area_level_1'){
                document.getElementById('state').value = responses[0].address_components[i].long_name;
            }
			
			if(responses[0].address_components[i].types[0] == 'administrative_area_level_2'){
                document.getElementById('city').value = responses[0].address_components[i].long_name;
            }
        }
		//update_location(pincode,current_area,current_address);
		
		var current_address = responses[0].formatted_address;
		updateMarkerAddress(current_address);
		
		 
		document.getElementById('postcode').value = pincode;
		
		
		
		document.getElementById('address_lat').value = latitude;
		document.getElementById('address_lng').value = longitude;
		
		$("#latitude").val(latitude);
		$("#longitude").val(longitude);
			
		
    } else {   
      updateMarkerAddress('Cannot determine address at this location.','');
    }
  });
}

function updateMarkerStatus(str,current_area) {
	
  var searchInput_address = $('#searchInput_address').val(); 
  //$('#search_address').val(str);
  //document.getElementById('search_address').value = str;  
  
  $('#search_address').val(searchInput_address); 
  document.getElementById('search_address').value = searchInput_address;
  
}
function updateMarkerPosition(latLng) {
/*   $('#search_address').val([
    latLng.lat(),
    latLng.lng()
  ].join(', '));
  
  document.getElementById('location').innerHTML = [
    latLng.lat(),
    latLng.lng()
  ].join(', '); */
   
	document.getElementById('address_lat').value = latLng.lat();
	document.getElementById('address_lng').value = latLng.lng();
	 
	
	$("#address_lat").val(latLng.lat());
	$("#address_lng").val(latLng.lng());
	
	//initialize(latLng.lat(),latLng.lng());
}

function updateMarkerAddress(str) {
	var searchInput_address = $('#searchInput_address').val();
	$('#search_address').val(searchInput_address);
	document.getElementById('search_address').value = searchInput_address;
}

function addYourLocationButton(map, marker) 
{
	var controlDiv = document.createElement('div');
	
	var firstChild = document.createElement('button');
	firstChild.style.backgroundColor = '#fff';
	firstChild.style.border = 'none';
	firstChild.style.outline = 'none';
	firstChild.style.width = '28px';
	firstChild.style.height = '28px';
	firstChild.style.borderRadius = '2px';
	firstChild.style.boxShadow = '0 1px 4px rgba(0,0,0,0.3)';
	firstChild.style.cursor = 'pointer';
	firstChild.style.marginRight = '10px';
	firstChild.style.padding = '0px';
	firstChild.title = 'Your Location';
	controlDiv.appendChild(firstChild);
	
	var secondChild = document.createElement('div');
	secondChild.style.margin = '5px';
	secondChild.style.width = '18px';
	secondChild.style.height = '18px';
	secondChild.style.backgroundImage = 'url(https://maps.gstatic.com/tactile/mylocation/mylocation-sprite-1x.png)';
	secondChild.style.backgroundSize = '180px 18px';
	secondChild.style.backgroundPosition = '0px 0px';
	secondChild.style.backgroundRepeat = 'no-repeat';
	secondChild.id = 'you_location_img';
	firstChild.appendChild(secondChild);
	
	google.maps.event.addListener(map, 'dragend', function() {
		$('#you_location_img').css('background-position', '0px 0px');
	});

	firstChild.addEventListener('click', function() {
		var imgX = '0';
		var animationInterval = setInterval(function(){
			if(imgX == '-18') imgX = '0';
			else imgX = '-18';
			$('#you_location_img').css('background-position', imgX+'px 0px');
		}, 500);
		if(navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
				var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
				marker.setPosition(latlng);
				map.setCenter(latlng);
				clearInterval(animationInterval);
				$('#you_location_img').css('background-position', '-144px 0px');
				
				initialize(position.coords.latitude,position.coords.longitude);
			});
		}
		else{
			clearInterval(animationInterval);
			$('#you_location_img').css('background-position', '0px 0px');
		}
	});
	
	controlDiv.index = 1;
	map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(controlDiv);
}

function getLocation() {
	 
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(updatePosition,showError);
	} else {
		alert('Geolocation is not supported by this browser.');
		return false;
	}

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(updatePosition);
    }
    return null;
};

function updatePosition(position) { 
  if (position) {
    window.lat = position.coords.latitude;
    window.lng = position.coords.longitude;
	 
	initialize(window.lat,window.lng);
  }
}
/* reset to current possition*/
/*setInterval(function(){updatePosition(getLocation());}, 10000);*/

function currentLocation() {
	initialize(window.lat,window.lng);
}

function map_address_type(type){

	if(type=="other"){
		$("#home_type_address").hide();
		$("#work_type_address").hide();
		$("#other_map_address").show();
		$("#other_address_type").prop('required',true);
	}else{
		$("#home_type_address").show();
		$("#work_type_address").show();
		$("#other_map_address").hide();
		$("#other_address_type").prop('required',false);
	}
}
/*
function update_location(live_pincode,live_area,live_address){
	
	var site_url = "https://zamy.in/";
	
	var current_area = '';
	var current_address = '';
	var pincode = '';
	
	if(live_pincode!=''){
		pincode = live_pincode;
	}
	
	if(live_area!=''){
		current_area = live_area;
	}
	if(live_address!=''){
		current_address = live_address;
	}
	
	
	if(live_area!=''){
		
		jQuery.ajax({
			type: "POST",
			dataType: 'html',
			url: site_url + "home/save_location",
			data: {'pincode':pincode,'current_area':current_area,'current_address':current_address},
			success: function (response) {
				console.log(response);
				
				var response1 = JSON.parse(response);
				
				if(response1.status==1){
					$(".get-location").hide();
					$(".saved_address_list").hide();
					$(".zamy-clse").hide();
					$("#set_delivery_location_wrap").show();
					$("#map_wrap").show();
					/* $(".map_div").show();  //
					$("#rest_popup_model").modal('hide');
					
					$("#current_area").text(response1.current_area);
					$("#current_address").text(response1.location);
					$(".rest-popup-btn").attr('href',site_url+'restaurants');
					$(".rest-popup-btn").removeAttr('data-toggle');
					$(".rest-popup-btn").removeAttr('data-target');
					
					
					
				}else{
					
					$("#current_area").text();
					$("#current_address").text('Choose Your Location');
					
					$("#common_model_popup").modal('show');
					$("#common_model_popup .modal-body").text(response1.message);
					
					
					
				}
			},
			error: function (xhr, extStatus, errorThrown) {
				alert('An error occurred! ' + errorThrown);
			}
		});
	}
} 
*/

function showError(error) {
  switch(error.code) {
    case error.PERMISSION_DENIED:
	  alert('You denied the request for Geolocation, please enable location service from your browser.');
      break;
    case error.POSITION_UNAVAILABLE:
	  alert('Location information is unavailable.');
      break;
    case error.TIMEOUT:
	alert('The request to get user location timed out.');
      break;
    case error.UNKNOWN_ERROR:
	  alert('An unknown error occurred.');
      break;
  }
}

jQuery(document).ready(function () {
	jQuery(".track_order_link").click(function(){
		
		var customer_lat			= jQuery(this).attr("data-lat1");
		var customer_lng			= jQuery(this).attr("data-lng1");
		var delivery_boy_latitude	= jQuery(this).attr("data-lat2");
		var delivery_boy_longitude	= jQuery(this).attr("data-lng2");
		var delivery_boy_mobile		= jQuery(this).attr("data-mobile");
		var delivery_boy_angle		= jQuery(this).attr("data-angle");
		var delivery_boy_pic		= jQuery(this).attr("data-profilepic");
		var drivername				= jQuery(this).attr("data-drivername");
		
		
		initialize_traking(delivery_boy_latitude,delivery_boy_longitude,customer_lat,customer_lng);
		
		jQuery('#customer_lat').val(customer_lat);
		jQuery('#customer_lng').val(customer_lng);
		jQuery('#delivery_boy_latitude').val(delivery_boy_latitude);
		jQuery('#delivery_boy_longitude').val(delivery_boy_longitude);
		jQuery('#delivery_boy_mobile').val(delivery_boy_mobile);
		jQuery('#delivery_boy_angle').val(delivery_boy_angle);
		jQuery('#delivery_boy_pic').val(delivery_boy_pic);
		jQuery('#delivery_profile_pic').attr('src',delivery_boy_pic);
		jQuery('#drivername').val(drivername);
		jQuery('#drivername_popup').html(drivername);
		jQuery('#delivery_boy_mobile_popup').html(delivery_boy_mobile);
		
		
		jQuery("#track_order_popup").modal("show");
		
	});
});

/* Order Traking*/
  var directionDisplay;
  var directionsService = new google.maps.DirectionsService();
  var map_tracking;
	
	// Start/Finish icons
	 var icons = {
	  start: new google.maps.MarkerImage(
	   // URL
	   '<?php echo base_url("/assets/images/delivery.png");?>',
	   // (width,height)
	   new google.maps.Size( 44, 32 ),
	   // The origin point (x,y)
	   new google.maps.Point( 0, 0 ),
	   // The anchor point (x,y) 
	   new google.maps.Point( 22, 32 )
	  ),
	  end: new google.maps.MarkerImage(
	   // URL
	   '<?php echo base_url("/assets/images/map-icon.png");?>',
	   // (width,height)
	   new google.maps.Size( 44, 32 ),
	   // The origin point (x,y)
	   new google.maps.Point( 0, 0 ),
	   // The anchor point (x,y)
	   new google.maps.Point( 22, 32 )
	  )
	 };
	 
  function initialize_traking(delivery_boy_latitude,delivery_boy_longitude,customer_lat,customer_lng) {
	  
	var pointA = new google.maps.LatLng(delivery_boy_latitude, delivery_boy_longitude);
    var pointB = new google.maps.LatLng(customer_lat, customer_lng);
		
    directionsDisplay = new google.maps.DirectionsRenderer();
    var myOptions = {
	  zoom:7,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map_tracking = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    directionsDisplay.setMap(map_tracking);
	directionsDisplay.setOptions( { suppressMarkers: true } );

	var start = new google.maps.LatLng(delivery_boy_latitude, delivery_boy_longitude);
	var end = new google.maps.LatLng(customer_lat, customer_lng);

    var request = {
      origin:start, 
      destination:end,
      travelMode: google.maps.DirectionsTravelMode.DRIVING,
	  unitSystem: google.maps.UnitSystem.METRIC
    };
    directionsService.route(request, function(response, status) {
      if (status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(response);
       // directionsDisplay.setMap(map);
		
        var myRoute = response.routes[0];
		
		/* var txtDir = '';
        for (var i=0; i<myRoute.legs[0].steps.length; i++) {
          txtDir += myRoute.legs[0].steps[i].instructions+"<br />";
        }
		document.getElementById('directions').innerHTML = txtDir; */
		
		makeMarker( pointA, icons.start, "title" );
		makeMarker( pointB, icons.end, 'title' );
      }
	  
    });
	
  }
function makeMarker( position, icon, title ) {
	new google.maps.Marker({
		position: position,
		map: map_tracking,
		icon: icon,
		title: title
	});
}
/* Order Traking End*/
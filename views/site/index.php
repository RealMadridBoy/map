<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>


<?php /*foreach ($drones as $drone) { 
	echo $drone['id_drone']." ".$drone['title']." ".$drone['lat']."<br>";
} */ ?>
    
<!--</div>-->

<input id="pac-input" class="controls" type="text"
        placeholder="Enter a location">
    <!--<div id="type-selector" class="controls">
      <input type="radio" name="type" id="changetype-all" checked="checked">
      <label for="changetype-all">All</label>

      <input type="radio" name="type" id="changetype-establishment">
      <label for="changetype-establishment">Establishments</label>

      <input type="radio" name="type" id="changetype-address">
      <label for="changetype-address">Addresses</label>

      <input type="radio" name="type" id="changetype-geocode">
      <label for="changetype-geocode">Geocodes</label>
    </div>-->
    <div id="map"></div>

    <script>
	
var data_drones = [
	<?php
		foreach ($drones as $drone) {
			echo "[ ".$drone["lat"].", ".$drone["lng"]." ], ";
		}
	?>
];	

var near_lat = data_drones[0][0], near_lng = data_drones[0][1];
var s;	
	
function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 37.09024, lng: -95.712891},
    zoom: 13
  });
  
  <?php foreach ($drones as $drone) { ?>
  var marker<?=$drone["id_drone"] ?> = new google.maps.Marker({
    position: {lat: <?=$drone["lat"] ?>, lng: <?=$drone["lng"] ?>},
    map: map,
    title: '<?=$drone["title"] ?>'
  });
  <? } ?>

  
  var input = /** @type {!HTMLInputElement} */(
      document.getElementById('pac-input'));

  var types = document.getElementById('type-selector');
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

  var autocomplete = new google.maps.places.Autocomplete(input);
  autocomplete.bindTo('bounds', map);

  var infowindow = new google.maps.InfoWindow();
  var marker = new google.maps.Marker({
    map: map,
    anchorPoint: new google.maps.Point(0, -29)
  });

  autocomplete.addListener('place_changed', function() {
    infowindow.close();
    marker.setVisible(false);
    var place = autocomplete.getPlace();
    if (!place.geometry) {
      window.alert("Autocomplete's returned place contains no geometry");
      return;
    }
	
	lat = place.geometry.location.lat();
	lng = place.geometry.location.lng();
	s = Math.sqrt((lat - near_lat)*(lat - near_lat) + (lng - near_lng)*(lng - near_lng));
	alert(s);
	
	for (var i = 1; i < 8; i++) {
		s_i = Math.sqrt((lat - data_drones[i][0])*(lat - data_drones[i][0]) + (lng - data_drones[i][1])*(lng - data_drones[i][1]));
		if (s_i < s) {
			s = s_i;
			near_lat = data_drones[i][0];
			near_lng = data_drones[i][1];
		}
	}
	alert(s);
	near = new google.maps.LatLng(near_lat,near_lng);
	
	//alert( place.geometry.location.lat() + " " + place.geometry.location.lng() );

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(near);
      map.setZoom(17);  // Why 17? Because it looks good.
    }
    marker.setIcon(/** @type {google.maps.Icon} */({
      url: place.icon,
      size: new google.maps.Size(71, 71),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(17, 34),
      scaledSize: new google.maps.Size(35, 35)
    }));
    marker.setPosition(near);
    marker.setVisible(false);

    var address = '';
    if (place.address_components) {
      address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
      ].join(' ');
    }

    /*infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
    infowindow.open(map, marker);*/
  });

  // Sets a listener on a radio button to change the filter type on Places
  // Autocomplete.
  function setupClickListener(id, types) {
    var radioButton = document.getElementById(id);
    radioButton.addEventListener('click', function() {
      autocomplete.setTypes(types);
    });
  }

  setupClickListener('changetype-all', []);
  setupClickListener('changetype-address', ['address']);
  setupClickListener('changetype-establishment', ['establishment']);
  setupClickListener('changetype-geocode', ['geocode']);
}

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtWHye3SJ-W-NlhvAct_ahttx_ohstLgU&signed_in=true&libraries=places&callback=initMap"
        async defer></script>


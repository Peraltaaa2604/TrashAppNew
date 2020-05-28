<?php include 'header_trabajador.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>TrashApp</title>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBkXg3bABW8Xm-Ee0OM_t4n0k4zVgPX4ek"></script>
</head>
<style>
   /* Set the size of the div element that contains the map */
   #mapCanvas {
    height: 400px;  /* The height is 400 pixels */
    width: 100%;  /* The width is the width of the web page */
  }
</style>
<body>
  <script>
    function initMap() {
      var map;
      var bounds = new google.maps.LatLngBounds();
      var mapOptions = {
        mapTypeId: 'roadmap'
      };

    // Display a map on the web page
    map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
    map.setTilt(50);

    // Multiple markers location, latitude, and longitude
    var markers = [
    ['Brooklyn Museum, NY', 31.8304673, -116.60616399999999],
    ['Brooklyn Public Library, NY', 31.83053089208899, -116.60158788700254],
    ['Prospect Park Zoo, NY', 31.831861722931794, -116.605632658197],
    ['Prospect Park Zoo, NY', 31.82832495212741, -116.60121237774045],
    ['Prospect Park Zoo, NY', 31.829136233696776, -116.60906588573606]
    ];

    // Info window content
    var infoWindowContent = [
    ['<div class="info_content">' +
    '<h3>Brooklyn Museum</h3>' +
    '<p>The Brooklyn Museum is an art museum located in the New York City borough of Brooklyn.</p>' + '</div>'],
    ['<div class="info_content">' +
    '<h3>Brooklyn Public Library</h3>' +
    '<p>The Brooklyn Public Library (BPL) is the public library system of the borough of Brooklyn, in New York City.</p>' +
    '</div>'],
    ['<div class="info_content">' +
    '<h3>Prospect Park Zoo</h3>' +
    '<p>The Prospect Park Zoo is a 12-acre (4.9 ha) zoo located off Flatbush Avenue on the eastern side of Prospect Park, Brooklyn, New York City.</p>' +
    '</div>']
    ];

    // Add multiple markers to map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Place each marker on the map  
    for( i = 0; i < markers.length; i++ ) {
      var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
      bounds.extend(position);
      marker = new google.maps.Marker({
        position: position,
        map: map,
        title: markers[i][0]
      });

        // Add info window to marker    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            infoWindow.setContent(infoWindowContent[i][0]);
            infoWindow.open(map, marker);
          }
        })(marker, i));

        // Center the map to fit all markers on the screen
        map.fitBounds(bounds);
      }

    // Set zoom level
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
      this.setZoom(18);
      google.maps.event.removeListener(boundsListener);
    });
    
  }
// Load initialize function
google.maps.event.addDomListener(window, 'load', initMap);
</script>
<div id="mapCanvas"></div>
</body>
</html>
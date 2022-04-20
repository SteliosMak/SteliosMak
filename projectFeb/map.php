<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <?php
  include 'index.html'; ?>
  <script type="text/javascript">
        document.getElementById("1").style.display = "none";
    document.getElementById("2").style.display = "none";
    document.getElementById("3").style.display = "block";
     document.getElementById("4").style.display = "block";
  </script>
  <title>My First Leaflet Map</title>
	 <link rel="stylesheet"
href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"/>

	 <!--[if lte IE 8]>
	     <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.ie.css" />
	 <![endif]-->
	  <script src="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.js"></script>
	   <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
     <!-- heatmap scripts -->


</head>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">

   <!-- Διάλεξε το αρχείο που επιθυμείς να ανεβάσεις:
-->
<div class="input-group mb-3">
  <div class="custom-file">
    <input type="file" class="custom-file-input" name="fileToUpload" id="fileToUpload">
    <label class="custom-file-label" for="fileToUpload">Επέλεξε αρχείο </label>
  </div>
  <div class="input-group-append">
    <input type="submit" value="Upload" name="submit">
  </div>
</div>


<input type="Username" placeholder="Enter Radius in meters" name="radius">

<!-- define a the area the map will go into. Feel free to change the size as needed -->
<div id="map" style="width:800px; height:500px;"></div>
<script>
var coords = [38.23, 21.75]; // the geographic center of our map
var zoomLevel = 13; // the map scale. See: http://wiki.openstreetmap.org/wiki/Zoom_levels
var map = L.map('map').setView(coords, zoomLevel);
// we need to provide the map with some base map tiles. There are few free options.
// we'll use Stamen Acetate, a muted base map good for overlaying data.
var tiles = 'http://acetate.geoiq.com/tiles/acetate-hillshading/';
// if you'd like to explore other base maps, see: http://developer.mapquest.com/web/products/open/map
// if you use different tiles, be sure to update the attribution :)
L.tileLayer('https://api.maptiler.com/maps/basic/{z}/{x}/{y}.png?key=S3V18MlG3qESi3G8fFnK', {
    attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
}).addTo(map);
var cc=0;
var coord=[];
var lat=[];
var lng=[];
var popup = L.popup();
<?php

$_SESSION['circles']=array();

?>

map.on('click', function(e){
  
  coord.push(e.latlng);
  lat.push(coord[cc].lat);
  lng.push(coord[cc].lng);
  document.cookie = encodeURIComponent("lat") +'=' + encodeURIComponent(lat[cc]);
  document.cookie = encodeURIComponent("lng") +'=' + encodeURIComponent(lng[cc]);
  document.cookie = encodeURIComponent("rad") +'=' + encodeURIComponent(document.getElementsByName("radius")[0].value);
  document.cookie = encodeURIComponent("cc")+'=' + encodeURIComponent(cc);
  <?php
    array_push($_SESSION['circles'],[$_COOKIE["lat"],$_COOKIE["lng"],$_COOKIE["rad"]]);
  ?>
  console.log("You clicked the map at latitude: " + lat[cc] + " and longitude: " + lng[cc]);
  var clickCircle = L.circle([lat[cc],lng[cc]],document.getElementsByName("radius")[0].value, {
      color: '#f07300',
      fillOpacity: 0.5,
      opacity: 0.5
    }).addTo(map);
 
  
  cc++;


  });

</script>

</body>
</html>



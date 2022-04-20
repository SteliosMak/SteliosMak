<?php 
session_start();
include 'index.html';
if ($_SESSION['Logged']==TRUE) {
	$name= $_SESSION['Username'];
	include 'connection.php';
	$apom =$_POST['apo'];
	$eosx =$_POST['year2'];
	$apox= $_POST['year1'];
	$eosm= $_POST['eos'];

	///////////////////////////////////////////////
	$totalsum=0;
	$activitycounter= [0,0,0,0,0,0,0,0,0,0,0];
	$dayscc = array_fill(0, 11, array_fill(0, 7, 0));
	$hourcc=array_fill(0, 11, array_fill(0, 24, 0));
	$select="SELECT * from datafile where username='$name';";
	$search=mysqli_query($conn,$select);
	if (mysqli_num_rows($search)) {
			 while($row = $search->fetch_assoc()) {
			 	$time=$row['timestampMs'];
			 	$y=date('Y',$time);
			 	$m=date('m',$time);
			 	$hour=date('G',$time);
			 	$day=date('N',$time);
			 	if ($apom<=$m and $eosm>=$m and $apox<=$y and $eosx>=$y){
			 		$location[$totalsum][0]=$row['lat'];
			 		$location[$totalsum][1]=$row['lng'];
				 	$temp=$row['Atype'];
				 	if($temp=='ON_FOOT'){
				 		$activitycounter[0]++;
				 		$dayscc[0][$day-1]++;
				 		$hourcc[0][$hour]++;
				 	}
				 	else if($temp=='TILTING'){
				 		$activitycounter[1]++;
				 		$dayscc[1][$day-1]++;
				 		$hourcc[1][$hour]++;}
				 	else if($temp=='STILL'){
				 		$activitycounter[2]++;
				 		$dayscc[2][$day-1]++;
				 		$hourcc[2][$hour]++;
				 	}
				 	else if($temp=='UNKNOWN'){
				 		$activitycounter[3]++;
				 		$dayscc[3][$day-1]++;
				 		$hourcc[3][$hour]++;
				 	}
				 	else if($temp=='IN_VEHICLE'){
				 		$activitycounter[4]++;
				 		$dayscc[4][$day-1]++;
				 		$hourcc[4][$hour]++;
				 	}
				 	else if($temp=='ON_BICYCLE'){
				 		$activitycounter[5]++;
				 		$dayscc[5][$day-1]++;
				 		$hourcc[5][$hour]++;
				 	}
				 	else if($temp=='EXITING_VEHICLE'){
				 		$activitycounter[6]++;
				 		$dayscc[6][$day-1]++;
				 		$hourcc[6][$hour]++;
				 	}
				 	else if($temp=='RUNNING'){
				 		$activitycounter[7]++;
				 		$dayscc[7][$day-1]++;
				 		$hourcc[7][$hour]++;}
				 	else if($temp=='IN_RAIL_VEHICLE'){
				 		$activitycounter[8]++;
				 		$dayscc[8][$day-1]++;
				 		$hourcc[8][$hour]++;
				 	}
				 	else if($temp=='IN_ROAD_VEHICLE'){
				 		$activitycounter[9]++;
				 		$dayscc[9][$day-1]++;
				 		$hourcc[9][$hour]++;
				 	}
				 	else if($temp=='WALKING'){
				 		$activitycounter[10]++;
				 		$dayscc[10][$day-1]++;
				 		$hourcc[10][$hour]++;}
				 	else{$totalsum--;}
				 	$totalsum++;
				 }
			 }
	}

	foreach ($activitycounter as &$key1) {
		if($totalsum!=0){$key1=$key1/$totalsum;
		}
		else {$key1=0;}
	}
	$finalpos=array_fill(0, 11,0);
	$ic=0;
	foreach ($hourcc as $key) {
		$c=0;
		$max=0;
		foreach($key as $k){
			if($k>=$max){$max=$k;$position=$c;}
			$c++;
		}
		$finalpos[$ic]=$position;
		$ic++;
	}
	$finalday=array_fill(0, 11,0);
	$ic=0;
	foreach ($dayscc as $key) {
		$c=0;
		$max=0;
		foreach($key as $k){
			if($k>=$max){$max=$k;$position=$c;}
			$c++;
		}
		$finalday[$ic]=$position;
		$ic++;
	}

/////////////////////////////////////////


}
foreach ($finalday as &$key2) {
	if($key2==0){$key2='Monday';}
			 	else if($key2==1){$key2='Tuesday';}
			 	else if($key2==2){$key2='Wednesday';}
			 	else if($key2==3){$key2='Thursday';}
			 	else if($key2==4){$key2='Friday';}
			 	else if($key2==5){$key2='Saturday';}
			 	else {$key2='Sunday';}
}


?>
<!DOCTYPE html>
<?php

 echo "<br>";
 	echo "<table border = '1'>";
    echo "<tr><td><strong>Δραστηριότητα</strong></td><td><strong>Ποσοστό Εγγραφών</strong></td><td><strong>Ημέρα</strong></td><td><strong>Ώρα</strong></td></tr>";
 	echo "<tr>";
 		echo "<td>" . "ON_FOOT" . "</td>"."<td>" . $activitycounter[0] . "</td>"."<td>" . $finalday[0] . "</td>"."<td>" . $finalpos[0] . "</td>";	
	echo "</tr>";        	
    echo "<tr>";
 		echo "<td>" . "TILTING" . "</td>"."<td>" . $activitycounter[1] . "</td>"."<td>" . $finalday[1] . "</td>"."<td>" . $finalpos[1] . "</td>";
	echo "</tr>";
	echo "<tr>";
 		echo "<td>" . "STILL" . "</td>" ."<td>" . $activitycounter[2] . "</td>"."<td>" . $finalday[2] . "</td>"."<td>" . $finalpos[2] . "</td>";
	echo "</tr>";
	echo "<tr>";
 		echo "<td>" . "UNKNOWN" . "</td>" ."<td>" . $activitycounter[3] . "</td>"."<td>" . $finalday[3] . "</td>"."<td>" . $finalpos[3] . "</td>";
	echo "</tr>";
	echo "<tr>";
 		echo "<td>" . "IN_VEHICLE" . "</td>" ."<td>" . $activitycounter[4]. "</td>"."<td>" . $finalday[4] . "</td>"."<td>" . $finalpos[4] . "</td>";	
	echo "</tr>";
	echo "<tr>";
 		echo "<td>" . "ON_BICYCLE" . "</td>"."<td>" . $activitycounter[5] . "</td>"."<td>" . $finalday[5] . "</td>"."<td>" . $finalpos[5]. "</td>" ;	
	echo "</tr>";
	echo "<tr>";
 		echo "<td>" . "EXITING_VEHICLE" . "</td>"."<td>" . $activitycounter[6] . "</td>"."<td>" . $finalday[6] . "</td>"."<td>" . $finalpos[6] . "</td>" ;	
	echo "</tr>";
	echo "<tr>";
 		echo "<td>" . "RUNNING" . "</td>" ."<td>" . $activitycounter[7] . "</td>"."<td>" . $finalday[7] . "</td>"."<td>" . $finalpos[7] . "</td>";	
	echo "</tr>";
	echo "<tr>";
 		echo "<td>" . "IN_RAIL_VEHICLE" . "</td>"."<td>" . $activitycounter[8] . "</td>"."<td>" . $finalday[8] . "</td>"."<td>" . $finalpos[8] . "</td>" ;	
	echo "</tr>";
	echo "<tr>";
 		echo "<td>" . "IN_ROAD_VEHICLE" . "</td>"."<td>" . $activitycounter[9] . "</td>"."<td>" . $finalday[9] . "</td>"."<td>" . $finalpos[9] . "</td>" ;	
	echo "</tr>";
	echo "<tr>";
 		echo "<td>" . "WALKING" . "</td>"."<td>" . $activitycounter[10] . "</td>"."<td>" . $finalday[10] . "</td>"."<td>" . $finalpos[10] . "</td>" ;	
	echo "</tr>";		
  	  	
    echo "</tr>";
	echo "</table>";
echo "<br><br>";
?>

<html>
<head>
	<title></title>
	<script type="text/javascript">
        document.getElementById("1").style.display = "none";
    document.getElementById("2").style.display = "none";
    document.getElementById("3").style.display = "block";
     document.getElementById("4").style.display = "block";
  </script>
	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.css" />
	 <!--[if lte IE 8]>
	     <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.ie.css" />
	 <![endif]-->
	  <script src="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.js"></script>
	   <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	   <script
src="https://raw.githubusercontent.com/pa7/heatmap.js
/develop/plugins/leaflet-heatmap/leaflet-heatmap.js">
</script>
<script
src="https://cdn.jsdelivr.net/npm/heatmapjs@2.0.2/hea
tmap.js">
 </script>
 <!--     -->
</head>
<body>
	<div id="map" style="width:800px; height:500px;"></div>
	<script src="leaflet-heatmap.js"></script>
<script>
var coords = [38.23, 21.75]; // the geographic center of our map
var zoomLevel = 13; // the map scale. See: http://wiki.openstreetmap.org/wiki/Zoom_levels
var map = L.map('map').setView(coords, zoomLevel);

/////////////

let testData = {
max: 111, data: [<?php foreach ($location as $key) {?>{lat:<?php echo $key[0]; ?>, lng:<?php echo $key[1]?>, count:1},<?php } ?>]};
let cfg = {"radius": 40,
"maxOpacity": 0.8,
"scaleRadius": false,
"useLocalExtrema": false,
latField: 'lat',
lngField: 'lng',
valueField: 'count'};
let heatmapLayer = new HeatmapOverlay(cfg);
map.addLayer(heatmapLayer);
heatmapLayer.setData(testData);

//////////////////////



// we need to provide the map with some base map tiles. There are few free options.
// we'll use Stamen Acetate, a muted base map good for overlaying data.
var tiles = 'http://acetate.geoiq.com/tiles/acetate-hillshading/';
// if you'd like to explore other base maps, see: http://developer.mapquest.com/web/products/open/map
// if you use different tiles, be sure to update the attribution :)
L.tileLayer('https://api.maptiler.com/maps/basic/{z}/{x}/{y}.png?key=S3V18MlG3qESi3G8fFnK', {
    attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
}).addTo(map);
</script>








</body>
</html>




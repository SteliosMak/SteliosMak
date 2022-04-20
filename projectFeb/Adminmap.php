<?php
session_start();
include 'index.html';
?><script type="text/javascript">
		    document.getElementById("1").style.display = "none";
    document.getElementById("2").style.display = "none";
    document.getElementById("3").style.display = "block";
     document.getElementById("4").style.display = "block";
	</script>
	<?php 



$year1=$_POST['year1'];
$year2=$_POST['year2'];
$month1= $_POST['month1'];
$month2= $_POST['month2'];
$day1= $_POST['day1'];
$day2= $_POST['day2'];
$hour1= $_POST['hour1'];
$hour2= $_POST['hour2'];

$a=[0,0,0,0,0,0,0,0,0,0,0];

if (isset($_POST['ON_FOOT']) && $_POST['ON_FOOT'] == 'Yes') 
{
    $a[0]=1;
}
if (isset($_POST['TILTING']) && $_POST['TILTING'] == 'Yes') 
{
     $a[1]=1;
}
if (isset($_POST['STILL']) && $_POST['STILL'] == 'Yes') 
{
    $a[2]=1;
}
if (isset($_POST['UNKNOWN']) && $_POST['UNKNOWN'] == 'Yes') 
{
     $a[3]=1;
}
if (isset($_POST['IN_VEHICLE']) && $_POST['IN_VEHICLE'] == 'Yes') 
{
     $a[4]=1;
}
if (isset($_POST['ON_BICYCLE']) && $_POST['ON_BICYCLE'] == 'Yes') 
{
     $a[5]=1;
}
if (isset($_POST['EXITING_VEHICLE']) && $_POST['EXITING_VEHICLE'] == 'Yes') 
{
     $a[6]=1;
}
if (isset($_POST['RUNNING']) && $_POST['RUNNING'] == 'Yes') 
{
    $a[7]=1;
}
if (isset($_POST['IN_RAIL_VEHICLE']) && $_POST['IN_RAIL_VEHICLE'] == 'Yes') 
{
    $a[8]=1;
}
if (isset($_POST['IN_ROAD_VEHICLE']) && $_POST['IN_ROAD_VEHICLE'] == 'Yes') 
{
    $a[9]=1;
}
if (isset($_POST['WALKING']) && $_POST['WALKING'] == 'Yes') 
{
    $a[10]=1;
 }
///////////////////////////////
 if (isset($_POST['allyears']) && $_POST['allyears'] == 'Yes') 
{
    $year1=2000;
    $year2=2050;
 }
if (isset($_POST['allmonths']) && $_POST['allmonths'] == 'Yes') 
{
    $month1=-1;
    $month2=14;
 }
if (isset($_POST['alldays']) && $_POST['alldays'] == 'Yes') 
{
    $day1=-1;
    $day2=8;
 }
 if (isset($_POST['allhours']) && $_POST['allhours'] == 'Yes') 
{
    $hour1=-1;
    $hour2=25;
 }
if (isset($_POST['allactivities']) && $_POST['allactivities'] == 'Yes') 
{
    $a=[1,1,1,1,1,1,1,1,1,1,1];
 }

if ($_SESSION['AdminFlag']==TRUE) {
	include 'connection.php';
	$select="SELECT * from datafile;";
	$search=mysqli_query($conn,$select);
	if (mysqli_num_rows($search)) {
		$cc=0;
		while($row = $search->fetch_assoc()) {
			$flag=1;
			$time=$row['timestampMs'];
			$y=date('Y',$time);
			if($year1>$y OR $year2<$y){$flag=0;}
			$m=date('m',$time);
			if($month1>$m OR $month2<$m){$flag=0;}
			$hour=date('G',$time);
			if($hour1>$hour OR $hour2<$hour){$flag=0;}
			$day=date('N',$time);
			if($day1>$day OR $day2<$day){$flag=0;}
			$atype=$row['Atype'];
			if($atype=='ON_FOOT' AND $a[0]==0){$flag=0;}
			if($atype=='TILTING' AND $a[1]==0){$flag=0;}
			if($atype=='STILL' AND $a[2]==0){$flag=0;}
			if($atype=='UNKNOWN' AND $a[3]==0){$flag=0;}
			if($atype=='IN_VEHICLE' AND $a[4]==0){$flag=0;}
			if($atype=='ON_BICYCLE' AND $a[5]==0){$flag=0;}
			if($atype=='EXITING_VEHICLE' AND $a[6]==0){$flag=0;}
			if($atype=='RUNNING' AND $a[7]==0){$flag=0;}
			if($atype=='IN_RAIL_VEHICLE' AND $a[8]==0){$flag=0;}
			if($atype=='IN_ROAD_VEHICLE' AND $a[9]==0){$flag=0;}
			if($atype=='WALKING' AND $a[10]==0){$flag=0;}
			if($row['Atimestamp']==0){$flag=0;}
			if($flag==1){
				$location[$cc][0]=$row['lat'];
				$location[$cc][1]=$row['lng'];
				$jdata[$cc][0]=0;
				$jdata[$cc][1]=$row['Atype'];
				$jdata[$cc][2]=100;
				$jdata[$cc][3]=$row['Atimestamp'];
				$jdata[$cc][4]=0;
				$jdata[$cc][5]=$row['velocity'];
				$jdata[$cc][6]=$row['accuracy'];
				$jdata[$cc][7]=$row['lng'];
				$jdata[$cc][8]=$row['lat'];
				$jdata[$cc][9]=$row['altitude'];
				$jdata[$cc][10]=$row['timestampMs'];
				$tempuser=$row['username'];
				$select="SELECT hid from users where username='$tempuser';";
				$searchhid=mysqli_query($conn,$select);
				if (mysqli_num_rows($searchhid)) {
					while($rowhid = $searchhid->fetch_assoc()) {
						$jdata[$cc][11]=$rowhid['hid'];
					}
				}
				$cc++;
			}
		}

	}


?>



<html>
<head>
	<title></title>
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
max: 124, data: [<?php foreach ($location as $key) {?>{lat:<?php echo $key[0]; ?>, lng:<?php echo $key[1]?>, count:1},<?php } ?>]};
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



<form action="Export.php">
<button>Export</button>
</form>


</body>
</html>







<?php
$_SESSION['jsondata']=$jdata;

}


?>
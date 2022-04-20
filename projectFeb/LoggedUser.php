<?php
session_start();
include 'index.html';
if($_SESSION['Logged']==TRUE){
$name= $_SESSION['Username'];
include 'connection.php';
$select="SELECT * from userfiles where userid='$name';";
$result=mysqli_query($conn,$select);
$hasfile=0;
if (mysqli_num_rows($result)) {
$hasfile=1;

?>
  <script type="text/javascript">
    document.getElementById("1").style.display = "none";
    document.getElementById("2").style.display = "none";
    document.getElementById("3").style.display = "block";
     document.getElementById("4").style.display = "block";
   
  </script>
<?php

$months=['0','January','February','March','April','May','June','July','August','September','Octomber','November','December'];
$temp=date('m');
$dates = array($temp-0, $temp-1, $temp-2, $temp-3,$temp-4, $temp-5, $temp-6, $temp-7, $temp-8, $temp-9, $temp-10, $temp-11);
$cc=0;
$score =array();
$year=date('y');
foreach ($dates as &$keykey) {
	$year=date('Y');
	if ($keykey<=0){
		$keykey=12+$keykey;
		$year--;
	}
	$vcounter=0;
	$counter=0;


	$select="SELECT * FROM datafile WHERE username='$name'; ";
	$result= mysqli_query($conn,$select);
	if (mysqli_num_rows($result)) {
    // output data of each row
		 $min=1111111111111111111;
		 $max=0;
		 while($row = $result->fetch_assoc()) {
		 		if($row["timestampMs"]>=$max){$max=$row["timestampMs"];}
		 		if($row["timestampMs"]<=$min){$min=$row["timestampMs"];}


		 		$stamp=date('m',$row["timestampMs"]);
		 		$sameyear=date('Y',$row["timestampMs"]);
		 		
		        if( $row["Atimestamp"]!=0 AND $stamp==$keykey AND $sameyear==$year){
		         	$counter++;
		         	if( $row["Atype"]=='IN_VEHICLE' OR $row["Atype"]=='IN_RAIL_VEHICLE' OR $row["Atype"]=='IN_ROAD_VEHICLE'){
		         		$vcounter++;
		         	}else if ($row["Atype"]=='STILL'){$counter--;}
		         }
		    }
		   
	} 	
	else {
    echo "0 results";
	}
	if($counter!=0){$score[$cc]=($counter-$vcounter)/$counter;}
	else{$score[$cc]=0;}
	$cc++;
}



$lastfiledate=0;
echo '<br>';
$select="SELECT filedate from userfiles where userid='$name' and fileid= (SELECT MAX(fileid) from userfiles where userid='$name');";
$search=mysqli_query($conn,$select);
if (mysqli_num_rows($search)) {
		 while($row = $search->fetch_assoc()) {
		 	$lastfiledate=$row['filedate'];
		 }
}



}
////////////////////// //////////////// top 3 list ///////////////////

$select="SELECT username from users;";
$search=mysqli_query($conn,$select);
if (mysqli_num_rows($search)) {
		$ucc=0;
		 while($row = $search->fetch_assoc()) {
		 	$users[$ucc]=$row['username'];
		 	$ucc++;
		 }
}
$year=date('Y');
$currentmonth=date('m');
$counter=0;
$vcounter=0;
$cc=0;
foreach ($users as $keyk ) {
	 $select="SELECT * FROM datafile WHERE username='$keyk'; ";
	 $top3= mysqli_query($conn,$select);
	 if (mysqli_num_rows($top3)) {
	 		 while($row = $top3->fetch_assoc()) {
		 		$stamp=date('m',$row["timestampMs"]);
		 		$sameyear=date('Y',$row["timestampMs"]);
		 		
		        if( $row["Atimestamp"]!=0 AND $stamp==$currentmonth AND $sameyear==$year){
		         	$counter++;
		         	if( $row["Atype"]=='IN_VEHICLE' OR $row["Atype"]=='IN_RAIL_VEHICLE' OR $row["Atype"]=='IN_ROAD_VEHICLE'){
		         		$vcounter++;
		         	}else if ($row["Atype"]=='STILL'){$counter--;}
		         }
		    }		   
	} 	
	if($counter!=0){$userscore[$cc]=($counter-$vcounter)/$counter;}
	else{$userscore[$cc]=0;}
	$cc++;
}
$usernumber=0;
foreach ($users as $key) {
	$top3list[$usernumber][0]=$key;
	$top3list[$usernumber][1]=$userscore[$usernumber];
	$usernumber++;	
}
function my_sort($a,$b)
{
if ($a[1]==$b[1]) return 0;
  return ($a[1]<$b[1])?1:-1;
}

usort($top3list,"my_sort");
$cc=0;
foreach ($top3list as $me) {
	if ($me[0]==$name) {
		$position=$cc+1;
	}
	$cc++;
}


//////////////////////////////////////////////////////////////////////////

?>

	<!DOCTYPE html>
	<html>
	<head>
		<title></title>
		<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
	</head>
	<body>
	<form>
		<div id="outer">
		<div class="inner">
			<ul>
				<li>Score οικολογικής μετακίνησης: <?php if($hasfile==1){echo $score[0];}else{echo "no file";} ?></li>  
				<li>Περίοδος που καλύπτουν οι εγγραφές:<?php if($hasfile==1){echo date('d.m.Y',$min)."-".date('d.m.Y',$max);}else{echo "no file";} ?></li>
				<li>Ημερομηνία τελευταίου upload:<?php if($hasfile==1){echo $lastfiledate; }else{echo "no file";}?></li>
				<li>Top 3 Users: <?php echo '<br>'.'1:'.$top3list[0][0].' με score:'.$top3list[0][1].'<br>'.'2:'.$top3list[1][0].' με score:'.$top3list[1][1].'<br>'.'3:'.$top3list[2][0].' με score:'.$top3list[2][1].'<br>'.'Your position='.$position.'<br>';     ?></li>
			</ul>
			
				
			
			<button  class="button2"type="button" onclick="javascript:location= 'map.php' ;" >Upload</button>
			<button class="button2"type="button" onclick="javascript:location= 'analisi.php' ;" >Ανάλυση στοιχείων Χρηστη</button>
		</div>
		<div class="inner">
			<canvas id="myChart" width="500" height="500"></canvas>
			<script>
				var ctx = document.getElementById('myChart').getContext('2d');
				var chart = new Chart(ctx, {
				    // The type of chart we want to create
				    type: 'bar',

				    // The data for our dataset
				    data: {
				        labels: [<?php 
				        	$months=['0','January','February','March','April','May','June','July','August','September','Octomber','November','December'];

				        	foreach ($dates as $key){echo $key;?>,<?php }?>],
				        datasets: [{
				            label: 'Activity last 12 months',
				            backgroundColor: 'rgb(255, 99, 132)',
				            borderColor: 'rgb(255, 99, 132)',
				            data: [<?php foreach ($score as $key){echo $key;?>,<?php }?>]
				        }]
				    },

				    // Configuration options go here
				    options: {}
				});
			</script>
			</div>
		</div>
	</form>


  
	</body>
	</html>
<?php
}
?>
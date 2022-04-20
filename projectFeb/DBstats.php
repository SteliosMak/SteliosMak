<?php
session_start();
include 'connection.php';
include 'index.html';

if($_SESSION['AdminFlag']==TRUE){
	//EGRAFES ANA XRISTI
	?><script type="text/javascript">
		    document.getElementById("1").style.display = "none";
    document.getElementById("2").style.display = "none";
    document.getElementById("3").style.display = "block";
     document.getElementById("4").style.display = "block";
	</script>
	<?php 




	$select="SELECT username from users;";
	$search=mysqli_query($conn,$select);
	if (mysqli_num_rows($search)) {
			$ucc=0;
			 while($row = $search->fetch_assoc()) {
			 	$users[$ucc]=$row['username'];
			 	$ucc++;
			 }
	}
	//print_r($users);  allagi 17 41 71
	$usernumber=0;
	$totalsum=0;
	foreach ($users as $key) {
		$select="SELECT * from datafile where username='$key';";
		$search=mysqli_query($conn,$select);
		if (mysqli_num_rows($search)) {
			$u=0;
			 while($row = $search->fetch_assoc()) {
			 	$u++;
			 }
			 $ucounter[$usernumber]=$u;
			 $totalsum=$totalsum+$u;
		}
		else{$ucounter[$usernumber]=0;}
		$usernumber++;

	}
	//echo $totalsum;
	$counter=0;
	foreach ($ucounter as &$key) {
		$key=$key/$totalsum;
	}
	//print_r($ucounter);
	//echo '<br>'; 17 41 71
///ana mina
	$monthscc= [0,0,0,0,0,0,0,0,0,0,0,0];
	//print_r($monthscc);
	$totalsum=0;
	$select="SELECT * from datafile;";
	$search=mysqli_query($conn,$select);
	if (mysqli_num_rows($search)) {
			 while($row = $search->fetch_assoc()) {
			 	$tmp=$row['timestampMs'];
			 	$temp=date('m',$tmp);

			 	if($temp==1){$monthscc[0]++;}
			 	else if($temp==2){$monthscc[1]++;}
			 	else if($temp==3){$monthscc[2]++;}
			 	else if($temp==4){$monthscc[3]++;}
			 	else if($temp==5){$monthscc[4]++;}
			 	else if($temp==6){$monthscc[5]++;}
			 	else if($temp==7){$monthscc[6]++;}
			 	else if($temp==8){$monthscc[7]++;}
			 	else if($temp==9){$monthscc[8]++;}
			 	else if($temp==10){$monthscc[9]++;}
			 	else if($temp==11){$monthscc[10]++;}
			 	else{$monthscc[11]++;}
			 	$totalsum++;
			 }
	}
	//print_r($monthscc);
	foreach ($monthscc as &$key) {
		$key=$key/$totalsum;
		//echo $key;  allagi 17 41 71
	}
//////////////ana mera
	$totalsum=0;
	$dayscc= [0,0,0,0,0,0,0];
	$select="SELECT * from datafile;";
	$search=mysqli_query($conn,$select);
	if (mysqli_num_rows($search)) {
			 while($row = $search->fetch_assoc()) {
			 	$tmp=$row['timestampMs'];
			 	$temp=date('D',$tmp);

			 	if($temp=='Mon'){$dayscc[0]++;}
			 	else if($temp=='Tue'){$dayscc[1]++;}
			 	else if($temp=='Wed'){$dayscc[2]++;}
			 	else if($temp=='Thu'){$dayscc[3]++;}
			 	else if($temp=='Fri'){$dayscc[4]++;}
			 	else if($temp=='Sat'){$dayscc[5]++;}
			 	else {$dayscc[6]++;}
			 	$totalsum++;
			 }
	}
	//echo '<br>'; 17 41 71
	//print_r($dayscc);
	foreach ($dayscc as &$key) {
		$key=$key/$totalsum;
	//	echo $key;
	}
	////ana etos
		$totalsum=0;
	$yearscc= [0,0,0,0,0,0,0,0,0,0,0];
	$select="SELECT * from datafile;";
	$search=mysqli_query($conn,$select);
	if (mysqli_num_rows($search)) {
			 while($row = $search->fetch_assoc()) {
			 	$tmp=$row['timestampMs'];
			 	$temp=date('Y',$tmp);

			 	if($temp==2010){$yearscc[0]++;}
			 	else if($temp==2011){$yearscc[1]++;}
			 	else if($temp==2012){$yearscc[2]++;}
			 	else if($temp==2013){$yearscc[3]++;}
			 	else if($temp==2014){$yearscc[4]++;}
			 	else if($temp==2015){$yearscc[5]++;}
			 	else if($temp==2016){$yearscc[6]++;}
			 	else if($temp==2017){$yearscc[7]++;}
			 	else if($temp==2018){$yearscc[8]++;}
			 	else if($temp==2019){$yearscc[9]++;}
			 	else{$yearscc[10]++;}
			 	$totalsum++;
			 }
	}
	//echo '<br>';
	foreach ($yearscc as &$key) {
		$key=$key/$totalsum;
	//	echo $key;
	}
	//print_r($yearscc);
	//ana ora
	$totalsum=0;
	$hourscc= [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
	$select="SELECT * from datafile;";
	$search=mysqli_query($conn,$select);
	if (mysqli_num_rows($search)) {
			 while($row = $search->fetch_assoc()) {
			 	$tmp=$row['timestampMs'];
			 	$temp=date('H',$tmp);

			 	if($temp==0){$hourscc[0]++;}
			 	else if($temp==1){$hourscc[1]++;}
			 	else if($temp==2){$hourscc[2]++;}
			 	else if($temp==3){$hourscc[3]++;}
			 	else if($temp==4){$hourscc[4]++;}
			 	else if($temp==5){$hourscc[5]++;}
			 	else if($temp==6){$hourscc[6]++;}
			 	else if($temp==7){$hourscc[7]++;}
			 	else if($temp==8){$hourscc[8]++;}
			 	else if($temp==9){$hourscc[9]++;}
			 	else if($temp==1){$hourscc[10]++;}
			 	else if($temp==11){$hourscc[11]++;}
			 	else if($temp==12){$hourscc[12]++;}
			 	else if($temp==13){$hourscc[13]++;}
			 	else if($temp==14){$hourscc[14]++;}
			 	else if($temp==15){$hourscc[15]++;}
			 	else if($temp==16){$hourscc[16]++;}
			 	else if($temp==17){$hourscc[17]++;}
			 	else if($temp==18){$hourscc[18]++;}
			 	else if($temp==19){$hourscc[19]++;}
			 	else if($temp==20){$hourscc[20]++;}
			 	else if($temp==21){$hourscc[21]++;}
			 	else if($temp==22){$hourscc[22]++;}
			 	else{$hourscc[23]++;}
			 	$totalsum++;
			 }
	}
	//echo '<br>';
	//print_r($hourscc);
	foreach ($hourscc as &$key) {
		$key=$key/$totalsum;
	//	echo $key;
	}
	//ana drastiriotita
	$totalsum=0;
	$activitycounter= [0,0,0,0,0,0,0,0,0,0,0];
	$select="SELECT * from datafile;";
	$search=mysqli_query($conn,$select);
	if (mysqli_num_rows($search)) {
			 while($row = $search->fetch_assoc()) {
			 	$temp=$row['Atype'];
			 	if($temp=='ON_FOOT'){$activitycounter[0]++;}
			 	else if($temp=='TILTING'){$activitycounter[1]++;}
			 	else if($temp=='STILL'){$activitycounter[2]++;}
			 	else if($temp=='UNKNOWN'){$activitycounter[3]++;}
			 	else if($temp=='IN_VEHICLE'){$activitycounter[4]++;}
			 	else if($temp=='ON_BICYCLE'){$activitycounter[5]++;}
			 	else if($temp=='EXITING_VEHICLE'){$activitycounter[6]++;}
			 	else if($temp=='RUNNING'){$activitycounter[7]++;}
			 	else if($temp=='IN_RAIL_VEHICLE'){$activitycounter[8]++;}
			 	else if($temp=='IN_ROAD_VEHICLE'){$activitycounter[9]++;}
			 	else if($temp=='WALKING'){$activitycounter[10]++;}
			 	$totalsum++;
			 }
	}
	foreach ($activitycounter as &$key) {
		$key=$key/$totalsum;
//		echo $key;
	}









}

?>

<!DOCTYPE html>
<?php

 echo "<br>";
 	echo "<table border = '1'>";
    echo "<tr><td><strong>Δραστηριότητα</strong></td><td><strong>Ποσοστό Εγγραφών</strong></td></tr>";
 	echo "<tr>";
 		echo "<td>" . "ON_FOOT" . "</td>"."<td>" . $activitycounter[0] . "</td>";	
	echo "</tr>";        	
    echo "<tr>";
 		echo "<td>" . "TILTING" . "</td>"."<td>" . $activitycounter[1] . "</td>";
	echo "</tr>";
	echo "<tr>";
 		echo "<td>" . "STILL" . "</td>" ."<td>" . $activitycounter[2] . "</td>";
	echo "</tr>";
	echo "<tr>";
 		echo "<td>" . "UNKNOWN" . "</td>" ."<td>" . $activitycounter[3] . "</td>";
	echo "</tr>";
	echo "<tr>";
 		echo "<td>" . "IN_VEHICLE" . "</td>" ."<td>" . $activitycounter[4]. "</td>";	
	echo "</tr>";
	echo "<tr>";
 		echo "<td>" . "ON_BICYCLE" . "</td>"."<td>" . $activitycounter[5] . "</td>" ;	
	echo "</tr>";
	echo "<tr>";
 		echo "<td>" . "EXITING_VEHICLE" . "</td>"."<td>" . $activitycounter[6] . "</td>";	
	echo "</tr>";
	echo "<tr>";
 		echo "<td>" . "RUNNING" . "</td>" ."<td>" . $activitycounter[7] . "</td>"."<td>" ;	
	echo "</tr>";
	echo "<tr>";
 		echo "<td>" . "IN_RAIL_VEHICLE" . "</td>"."<td>" . $activitycounter[8] . "</td>" ;	
	echo "</tr>";
	echo "<tr>";
 		echo "<td>" . "IN_ROAD_VEHICLE" . "</td>"."<td>" . $activitycounter[9] . "</td>" ;	
	echo "</tr>";
	echo "<tr>";
 		echo "<td>" . "WALKING" . "</td>"."<td>" . $activitycounter[10] . "</td>" ;	
	echo "</tr>";		
  	  	
    echo "</tr>";
	echo "</table>";
echo "<br><br>";

 echo "<br>";
 	echo "<table border = '1'>";
    echo "<tr><td><strong>Χρήστης</strong></td><td><strong>Ποσοστό Εγγραφών</strong></td></tr>";
 	$c=0;
 	foreach ($users as $key) {

 		echo "<tr>";
 		echo "<td>" . $key . "</td>"."<td>" . $ucounter[$c] . "</td>" ;	
		echo "</tr>";
		$c++;
 	}
	echo "</table>";
echo "<br><br>";


echo "<table border = '1'>";
    echo "<tr><td><strong>Mήνας</strong></td><td><strong>Ποσοστό Εγγραφών</strong></td></tr>";
 	$c=1;
 	foreach ($monthscc as $key) {

 		echo "<tr>";
 		echo "<td>" . $c . "</td>"."<td>" . $key . "</td>" ;	
		echo "</tr>";
		$c++;
 	}
	echo "</table>";


	echo "<table border = '1'>";
    echo "<tr><td><strong>Έτος</strong></td><td><strong>Ποσοστό Εγγραφών</strong></td></tr>";
 	$c=2010;
 	foreach ($yearscc as $key) {

 		echo "<tr>";
 		echo "<td>" . $c . "</td>"."<td>" . $key . "</td>" ;	
		echo "</tr>";
		$c++;
 	}
	echo "</table>";


		echo "<table border = '1'>";
    echo "<tr><td><strong>Ώρα</strong></td><td><strong>Ποσοστό Εγγραφών</strong></td></tr>";
 	$c=0;
 	foreach ($hourscc as $key) {

 		echo "<tr>";
 		echo "<td>" . $c . "</td>"."<td>" . $key . "</td>" ;	
		echo "</tr>";
		$c++;
 	}
	echo "</table>";

		echo "<table border = '1'>";
    echo "<tr><td><strong>Mέρα</strong></td><td><strong>Ποσοστό Εγγραφών</strong></td></tr>";
 	$c=0;
 	$dowMap = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
 	foreach ($dayscc as $key) {

 		echo "<tr>";
 		echo "<td>" . $dowMap[$c] . "</td>"."<td>" . $key . "</td>" ;	
		echo "</tr>";
		$c++;
 	}
	echo "</table>";


?>



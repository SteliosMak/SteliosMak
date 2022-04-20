<?php
session_start();
$name= $_SESSION['Username'];
include 'connection.php';
$temp=date('m',1535195904);
$dates = array($temp, $temp-1, $temp-2, $temp-3,$temp-4, $temp-5, $temp-6, $temp-7, $temp-8, $temp-9, $temp-10, $temp-11);
$cc=0;
$score =array();
$year=date('y');
foreach ($dates as &$key) {
	$year=date('Y',1535195904);
	if ($key<=0){
		$key=12+$key;
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
		 		
		        if( $row["Atimestamp"]!=0 AND $stamp==$key AND $sameyear==$year){
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
	echo $score[$cc];
	echo '<br>';
	$cc++;
}


echo date('m,d,Y',$min)."<br>".date('m,d,Y',$max);
echo '<br>';
$select="SELECT filedate from userfiles where userid='$name' and fileid= (SELECT MAX(fileid) from userfiles);";
$search=mysqli_query($conn,$select);
if (mysqli_num_rows($search)) {
		 while($row = $search->fetch_assoc()) {
		 	$result=$row['filedate'];
		 }
}
echo $result;













?>
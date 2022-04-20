<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "json" ) {
    echo "Sorry, only json files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
    session_start();
    $userid=$_SESSION['Username'];
    $url = $target_file;
    //$username = $_SESSION['userid'];
    //$json = simplexml_load_file($url);
    $jsonData=file_get_contents($url);
    $json = json_decode($jsonData,true);
    //echo $json['locations'][0] ['latitudeE7'];
    //echo  $json['locations'][0] ['uploadFlag'];
    include 'connection.php';
    $date1=date('d,m,Y');
    echo $date1;
    echo date('d,m,Y');
    $insert= "INSERT INTO userfiles(userid,filedate) VALUES('$userid','$date1');";
    $search = mysqli_query($conn, $insert);
    $select= "SELECT MAX(fileid) FROM userfiles WHERE userid='$userid';";
    $search= mysqli_query($conn, $select);
    if(mysqli_num_rows($search)){
    $row = $search->fetch_assoc();
    $fileid=$row['MAX(fileid)'];
    echo $fileid;
    }
    echo "<br>";
    echo "<br>";
    echo $_SESSION['Username'];
  
    foreach ($json['locations'] as &$locations) {
              // Metrisi Apostasis 
        $latitudeFrom = '38.230462';
        $longtitudeFrom = '21.753150';

        $latitudeTo = $locations['latitudeE7'];
        $latitudeTo = $latitudeTo / 10000000;
        $longtitudeTo = $locations['longitudeE7'];
        $longtitudeTo = $longtitudeTo / 10000000;

        $theta = $longtitudeFrom - $longtitudeTo;
        $dist = sin(deg2rad($latitudeFrom))* sin(deg2rad($latitudeTo)) + cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo))* cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist *60 * 1.1515;
        $distance =($miles * 1.609344);
        $white_zone_flag=1;
        foreach ($_SESSION['circles'] as $key) {
            $latitudeFrom = $key[0];
            $longtitudeFrom = $key[1];

            $latitudeTo = $locations['latitudeE7'];
            $latitudeTo = $latitudeTo / 10000000;
            $longtitudeTo = $locations['longitudeE7'];
            $longtitudeTo = $longtitudeTo / 10000000;

            $theta = $longtitudeFrom - $longtitudeTo;
            $dist = sin(deg2rad($latitudeFrom))* sin(deg2rad($latitudeTo)) + cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo))* cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist *60 * 1.1515;
            $distance_white_zone =($miles * 1.609344);
            if($distance_white_zone<$key[2]/1000){$white_zone_flag=0;}
        }
        if ($distance< 10.0 and $white_zone_flag==0) {
            echo $locations['latitudeE7'].$locations['longitudeE7']."  kopikan"."<br>";
        }
        if ($distance< 10.0 and $white_zone_flag==1) {
            $locations['uploadFlag']=1;
            $times= $locations['timestampMs']/1000;
            $lat= $latitudeTo;
            $lng= $longtitudeTo;
            $name=$_SESSION['Username'];
            $acc= $locations['accuracy'];
            if (isset($locations['activity']))
                {
                    $atimest= $locations['activity'][0]['timestampMs'];
                    $atype= $locations['activity'][0]['activity'][0]['type'];
                    $insert= "INSERT INTO datafile(fileid,timestampMs,lat,lng,Atimestamp,Atype,username) VALUES('$fileid','$times','$lat','$lng','$atimest','$atype','$name');";
                    $search= mysqli_query($conn,$insert);
                }
                else
                {
                    $insert= "INSERT INTO datafile(fileid,timestampMs,lat,lng) VALUES('$fileid','$times','$lat','$lng');";
                    $search= mysqli_query($conn,$insert);
                }




        }
        else{
            $locations['uploadFlag']=0;
        }
      
        
       header('Location: LoggedUser.php');
    }

    









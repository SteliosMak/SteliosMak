<?php
	session_start();
	$content=array();
	$data=$_SESSION['jsondata'];

	include 'index.html';
	foreach($data as $key){
	array_push($content,
		[
			array("heading" => $key[0]),
			array("Atype" => $key[1]),
			array("A.confidence" => $key[2]),
			array("A.time" => $key[3]),
			array("vertical accuracy" => $key[4]),
			array("velocity" => $key[5]),
			array("accuracy" => $key[6]),
			array("longtitude" => $key[7]),
			array("latitude" => $key[8]),
			array("altitude" => $key[9]),
			array("timestamp" => $key[10]),
			array("User ID" => $key[11])
		]



	);
}

echo "Results.json has been created in your local file";
	$fp = fopen('results.json', 'w');
	fwrite($fp, json_encode($content));
	fclose($fp);
?>
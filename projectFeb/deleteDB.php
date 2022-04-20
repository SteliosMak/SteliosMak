<?php
include 'connection.php';
session_start();


if($_SESSION['AdminFlag']==TRUE){ 
	$insert="TRUNCATE TABLE datafile;";
	$search = mysqli_query($conn, $insert);
	$insert="TRUNCATE TABLE userfiles;";
	$search = mysqli_query($conn, $insert);
	echo "Everything is GONE!";
}
 ?>
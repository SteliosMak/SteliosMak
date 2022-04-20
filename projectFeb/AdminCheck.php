<?php 
$Username = $_POST['Uname'];
$Password = $_POST['psw'];


include 'connection.php';

$insert  = "SELECT* From admins Where '$Username'=username && '$Password' = password;";
$search = mysqli_query($conn, $insert);

if(mysqli_num_rows($search)){
	session_start();
	$_SESSION['AdminFlag']=TRUE;
	echo $_SESSION['AdminFlag'];
	header("Location:adminTrue.php");
		
}
else {header("Location: admin.php");}
	

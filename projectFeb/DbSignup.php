<?php
	$Username = $_POST['Username'];
	$Password = $_POST['Password'];
	$email = $_POST['Email'];
//	echo $Username,$Password,$email;
	/*
	if (!empty($Password)) {
			if (7 < strlen($Password)){ //check if string meets 8 or more characters
				if (strcspn($Password, '0123456789') != strlen($Password)){ //check if string has numbers
					if (strcspn($Password, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ') != strlen($Password)) { //check if string has capital letters
						if (strcspn($Password, '!@#$%^&*()_+') != strlen($Password)) {
						echo "1";
						}
					}
				}
			}
	} */
	if (!empty($Password)&&(7 < strlen($Password)) &&(strcspn($Password, '0123456789') != strlen($Password)) &&(strcspn($Password, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ') != strlen($Password)) &&(strcspn($Password, '!@#$%^&*()_+') != strlen($Password)) ) {
			$pFlag = TRUE;

	}
	else{$pFlag=false;
		include 'index.html';
		echo "password didnt contain all the things"."<br>";}
	include 'connection.php';
	$insert = "SELECT* From users Where '$Username'=username;";
	$search = mysqli_query($conn, $insert);
	if(mysqli_num_rows($search)){$uflag=false;echo "username already exists"."<br>";}
	else{$uflag=true;
	}

	if($uflag & $pFlag){
		$dbpass=md5($Password);
		$iv = substr( hash( 'sha256', "aaaabbbbcccccddddeweee" ), 0, 16 );
		$userid=openssl_encrypt($email,'AES-128-CBC',$Password,OPENSSL_RAW_DATA, $iv);
		$insert="INSERT INTO users(username,password,email,hid) values('$Username','$dbpass','$email','$userid');";
		$search = mysqli_query($conn, $insert);

	}
	if($uflag){
		header("location:UserChoice.php");
	}

	//$decryptedText = openssl_decrypt($userid, 'AES-128-CBC', $Password, OPENSSL_RAW_DATA, $iv);

	
?>
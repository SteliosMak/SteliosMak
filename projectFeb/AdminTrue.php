<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<?php session_start();
	include 'index.html';
		if($_SESSION['AdminFlag']==TRUE){  ?>	
			 <script type="text/javascript">
    document.getElementById("1").style.display = "none";
    document.getElementById("2").style.display = "none";
    document.getElementById("3").style.display = "block";
     document.getElementById("4").style.display = "block";
   
  </script>

  <div class="inner"> <button type="button" onclick=" javascript:location= 'DBstats.php'">Απεικόνιση κατατασης βασης δεδομενων</button></div>
  <div class="inner"> <button type="button" onclick=" javascript:location= 'AdminMapSetting.php'">Απεικόνιση στοιχείων σε χάρτη</button></div>
  <div class="inner"> <button type="button" onclick="var result = confirm('Want to delete?');
if (result) {
    javascript:location= 'deleteDB.php' ;
}">Διαγραφή Δεδομένων</button></div>











	<?php	}  ?>

</body>
</html>
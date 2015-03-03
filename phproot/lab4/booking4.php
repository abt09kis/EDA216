<?php
	require_once('database.inc.php');
	
	session_start();
	$db = $_SESSION['db'];
	$userId = $_SESSION['userId'];
	$resNbr = $_SESSION['resNbr'];
?>

<html>
<head><title>Booking 4</title><head>
<body><h1>Booking 4</h1>
<?php
	if(strcmp($resNbr,"false") !== 0){
		echo "One ticket booked, reservation number is ".$resNbr;
	}else{
		echo "No ticket was booked";	
	}

		
?>
<form method="post" action="booking1.php">
		<input type="submit" value="New Booking">		
</form>
 

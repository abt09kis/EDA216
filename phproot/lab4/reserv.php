<?php
	require_once('database.inc.php');
	
	session_start();
	$db = $_SESSION['db'];
	$userId = $_SESSION['userId'];
	$db->openConnection();
	$resNbr = $db->bookTicket($_REQUEST['movieName'],$_REQUEST['date'],$userId);
	$db->closeConnection();
	$_SESSION['resNbr'] = $resNbr;
	//echo $resNbr
	header("Location: booking4.php");
?>


<?php
	require_once('database.inc.php');
	
	session_start();
	$db = $_SESSION['db'];
	$db->openConnection();
	#$cookieName = $db->getCookieName();
	if(!$db->useCookieIngrediants($_POST['cookieName'])){
		$db->closeConnection();
		header("Location: createPalletFailed.php");
	}
	$palletId=$db->createPallet($_POST['cookieName']); 
	$db->closeConnection();
	$_SESSION['palletId']= $palletId;
	header("Location: createpallet3.php");
?>


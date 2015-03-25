<?php
	require_once('database.inc.php');
	
	session_start();
	$db = $_SESSION['db'];
	$db->openConnection();
	#$cookieName = $db->getCookieName();
	var_dump($db->getIngredientsCookie($_POST['cookieName']));
	#$palletId=$db->createPallet($_POST['cookieName']); 
	$db->closeConnection();
	#$_SESSION['palletId']= $palletId;
?>


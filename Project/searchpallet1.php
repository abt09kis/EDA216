<?php
	require_once('database.inc.php');
	
	session_start();
	$db = $_SESSION['db'];
	$db->openConnection();
	$result = $db->getPalletInfo($_POST["palletId"])
	$db->closeConnection();
?>
<html>
	<header><title>Search pallet</title></header>
	<body>
		<h1>Search pallet</h1>
		<p>This page gives information about the searched pallet</p>
		<h2>Search a new pallet</h2>
		<p>To search a new pallet enter it id in textbox and click "Search pallet"</p>
		<form method="get" action="searchpallet1.php">
			<input type="text" name="palletId" ><br>
			<input type="submit" value ="Search pallet">
		</form >
		<h2>Return to the startpage</h2>
		<p>To return to the start page click Return to start</p>
		<form method="get" action="index.php">
			<input type="submit" value ="Return to start">
		</form >
	</body>
</html>
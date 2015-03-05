<?php
	require_once('database.inc.php');
	require_once("mysql_connect_data.inc.php");
	$db = new Database($host, $userName, $password, $database);
	$db->openConnection();
	if (!$db->isConnected()) {
		header("Location: cannotConnect.html");
		exit();
	}
	$db->closeConnection();
	session_start();
	$_SESSION['db'] = $db;
?>

<html>
	<header> <title>Production </title></header>
	<body>
		<h1>Production</h1>
		<p>Click on of the buttons to preforma a task</p>
		<h2>find a pallet</h2>
		<p>To find a pallet click the button find a pallet</p>
		<form method="get" action="searchpallet1.php">
			<input type="text" name="palletId" > <br>
			<input type="submit" value="find a pallet">
		</form>
		<h2>Block pallet</h2>
		<p>To block a pallet click the button Block a pallet </p>
		<form method="get" action="blockpallet1.php">
			<input type="submit" value="Block a pallet">
		</form>

		</form>
		<h2>Creat a pallet</h2>
		<p>To creat a pallet click on the button Creat a pallet</p>
		<form method="get" action="creatpallet1.php">
			<input type="submit" value="Creat a pallet">
		</form>
	</body>

</html>
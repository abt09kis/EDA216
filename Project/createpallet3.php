<?php
	require_once('database.inc.php');
	session_start();
	$id = $_SESSION["palletId"];
?>

<html>
<head><title>Finished</title><head>
<body><h1>Finished</h1>
	<p>
		The pallet was added to the system with id <?php print ":".$id?> 
		<form method="post" action="index.php">
			<input type="submit" value="Return to Mainpage">		
		</form>
 
	<p>
</body>
</html>

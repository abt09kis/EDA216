<?php
	require_once('database.inc.php');
	
	session_start();
	$db = $_SESSION['db'];
	$db->openConnection();
	#$result = $db->getBlockPallet($_POST["palletId"])
	$cookieName = $db->getCookieName();
	$db->closeConnection();
?>
<html>
	<header><title>Search pallet</title></header>
	<body>
		<h1>Block pallet</h1>
		<p>Block pallets containing a cookie type during a time interval</p>
		<form method="post" action="blockpallets.php">
			<select name="cookieName" size=10 required>
				<?php
					$first = true;
					foreach ($cookieName as $name) {
						if ($first) {
							print "<option selected>";
							$first = false;
						} else {
							print "<option>";
						}
						print $name;
					}		
				?>
			</select><P>
			Start time form <br>
			yyyy-mm-dd hh:mm:ss <br>
			<input type="input" name="startTime" required><br>
			End time form <br>
			yyyy-mm-dd hh:mm:ss <br>
			<input type="input" name="endTime" required><br>
			<input type="submit" value ="Block pallets">
		</form >
		
		<h2>Return to the startpage</h2>
		<p>To return to the start page click "Return to start"</p>
		<form method="get" action="index.php">
			<input type="submit" value ="Return to start">
		</form >
	</body>
</html>


<?php
	require_once('database.inc.php');
	
	session_start();
	$db = $_SESSION['db'];
	$db->openConnection();
	#$result = $db->getBlockPallet($_POST["palletId"])
	$cookieName = $db->getCookieName();
	$nbrBlocked = $db->blockPallets($_POST["cookieName"],$_POST["startTime"],$_POST["endTime"]);
	$db->closeConnection();
?>
<html>
	<header><title>Blocked pallets</title></header>
	<body>
		<h2>Finde Blocked by name<h2>
		<form method="post" action="findeblockedpallets2.php">
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
			</select>
			<p>
			<input type="submit" value ="Find blocked pallets">
		</form >
		
		<h2>Return to the startpage</h2>
		<p>To return to the start page click "Return to start"</p>
		<form method="get" action="index.php">
			<input type="submit" value ="Return to start">
		</form >
	</body>
</html>

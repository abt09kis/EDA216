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
		<h1>Blocked pallets</h1>
		<h2>Number of blocked pallets </h2>
		<?php
			if($nbrBlocked > 0 ){ 
				echo $nbrBlocked." pallets affecetd by the input";  
			}else if($_POST["startTime"]>$_POST["endTime"]){
				echo "Start time is after end time"; 
			}else{
				echo "No pallets affected";	
			}
		?>
		<h2>Block other pallet</h2>
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
			<input type="submit" value ="Search pallet">
		</form >
		
		<h2>Return to the startpage</h2>
		<p>To return to the start page click "Return to start"</p>
		<form method="get" action="index.php">
			<input type="submit" value ="Return to start">
		</form >
	</body>
</html>

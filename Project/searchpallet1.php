<?php
	require_once('database.inc.php');
	
	session_start();
	$db = $_SESSION['db'];
	$db->openConnection();
	$result = $db->getPalletInfo($_POST["palletId"]);
	$cookieName = $db->getCookieName();
	$db->closeConnection();
?>
<html>
	<header><title>Search pallet</title></header>
	<body>
		<h1>Search pallet</h1>
		
		<h2>Search a pallet with Id</h2>
		<p>To search a pallet enter it's id in textbox and click "Search pallet"</p>
		<form method="post" action="searchpalletid.php">
			<input type="text" name="palletId" ><br>
			<input type="submit" value ="Search pallet">
		</form >
		
		<h2>Search a pallets in between different times</h2>
		<p>To search a new pallet enter it id in textbox and click "Search pallet"</p>
		<form method="post" action="searchpalletbydate.php">
			Start time form <br>
			yyyy-mm-dd hh:mm:ss <br>
			<input type="input" name="startTime" required><br>
			End time form <br>
			yyyy-mm-dd hh:mm:ss <br>
			<input type="input" name="endTime" required><br>
			<input type="submit" value ="Search pallet">
		</form >
		
		<h2>Search Pallet by cookie name</h2>
		<p>
			Choose a cookie name to find what pallets that contains that cookie  
		<p>
		<form method=post action="findbyname.php">
			<select name="cookieName" size=10>
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
			</select><p>		
			<input type=submit value="Select cookie">
		</form>
		
		<h2>Return to the startpage</h2>
		<p>To return to the start page click Return to start</p>
		<form method="get" action="index.php">
			<input type="submit" value ="Return to start">
		</form >
	</body>
</html>

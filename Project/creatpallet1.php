<?php
	require_once('database.inc.php');
	
	session_start();
	$db = $_SESSION['db'];
	$db->openConnection();
	$cookieName = $db->getCookieName();
	$db->closeConnection();
?>

<html>
<head><title>Cookie type</title><head>
<body><h1>Cookie type</h1>
	<p>
	Choose a cookie that you want to produces 
	<p>
	<form method=post action="creatpallet2.php">
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
		</select>		
		<input type=submit value="Select cookie">
	</form>
</body>
</html>

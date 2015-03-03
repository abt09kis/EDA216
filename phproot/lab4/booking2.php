<?php
	require_once('database.inc.php');
	
	session_start();
	$db = $_SESSION['db'];
	$userId = $_SESSION['userId'];
	$db->openConnection();
	$dates = $db->getDates($_REQUEST['movieName']);
	$db->closeConnection();
?>

<html>
<head><title>Booking 2</title><head>
<body><h1>Booking 2</h1>
	Current user: <?php print $userId ?>
	<p>
	Selected movie: <?php print  $_REQUEST['movieName'] ?>
	<p>
	Performances Data:
	<p>
	<form method=post action="booking3.php">
		<select name="date" size=10>
		<?php
			$first = true;
				foreach ($dates as $date) {
					if ($first) {
						print "<option selected>";
						$first = false;
					} else {
						print "<option>";
					}
					print $date;
				}
		?>
		</select>		
		 <input type="hidden" name="movieName" value="<?php print  $_REQUEST['movieName'] ?>">
		<input type=submit value="Select Date">
		
	</form>
</body>
</html>

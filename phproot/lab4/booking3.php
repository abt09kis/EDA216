<?php
	require_once('database.inc.php');
	
	session_start();
	$db = $_SESSION['db'];
	$userId = $_SESSION['userId'];
	$db->openConnection();
	$per = $db->getPerformance($_REQUEST['movieName'],$_REQUEST['date'])[0];
	$db->closeConnection();
?>

<html>
<head><title>Booking 3</title><head>
<body><h1>Booking 3</h1>
	Current user: <?php print $userId ?>
	<p>
		Selected performance:
	<P>
		Movie: <?php print $per['movieName']?> <br>
		Date: <?php print $per['perfDate']?> <br>
		Movie theater: <?php print $per['theaterName']?> <br>
		Free Seats: <?php print $per['freeSeats']?>	
	<P>
	<form method="post" action="reserv.php">
		<input type="hidden" name ="movieName" value="<?php echo $_REQUEST['movieName']?>" >
		<input type="hidden" name ="date" value="<?php echo $_REQUEST['date']?>" >
		<input type="submit" value="Book Ticket">		
	</form>
</body>
</html>

<?php
	require_once('database.inc.php');
	
	session_start();
	$db = $_SESSION['db'];
	$db->openConnection();
	$result = $db->getBlockPallet($_POST["palletId"])
	$db->closeConnection();
?>
<html>
	<header><title>Search pallet</title></header>
	<body>
		<h1>Blocked pallet</h1>
		<p>
			<?php
				if($result){
					print "The pallet with the id:".$_POST["palletId"];
				}else{
					print "The Pallet with the id:".$_POST["palletId"]."do not exists try an other number";
				}
			?>
		<h2>Block an other pallet</h2>
		<p>To block an other pallet enter its pallet id in the text box and click "Block Pallet"</p>
		<form method="get" action="blockpallet.php">
			<input type="text" name="palletId" ><br>
			<input type="submit" value ="Block pallet">
		</form >
		<h2>Return to the startpage</h2>
		<p>To return to the start page click "Return to start"</p>
		<form method="get" action="index.php">
			<input type="submit" value ="Return to start">
		</form >
	</body>
</html>
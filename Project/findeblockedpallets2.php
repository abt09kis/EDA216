<?php
	require_once('database.inc.php');
	
	session_start();
	$db = $_SESSION['db'];
	$db->openConnection();
	#$result = $db->getBlockPallet($_POST["palletId"])
	$cookieName = $db->getCookieName();
	$result = $db->findBlockedPallets($_POST["cookieName"]);
	$db->closeConnection();
?>
<html>
	<header><title>Blocked pallets</title></header>
	<body>
		<h1> Found blocked pallets </h1>
		<?php
			if(count($result) > 0){
				echo "<table>";
	  			echo "<tr>";
				echo	"<th>Pallet Nbr</th>";
				echo	"<th>cookieName</th>";
				echo	"<th>prodTime</th>";
				echo 	"<th>blocked</th>";
				echo	"<th>delivered</th>";
	  			echo "</tr>";
	  			for($i = 0; $i<count($result); ++$i){
					echo "<tr>";
					echo "<td>".$result[$i]["palletNbr"]."</td><td>".$result[$i]["cookieName"]."</td><td>".$result[$i]["prodTime"]."</td><td>".$result[$i]["blocked"]."</td><td>".$result[$i]["delivered"]."</td>";			
					echo "</tr>";
				}		
			
			}else{
				echo "No blocked pallets by the name: ".$_POST["cookieName"];
			}
			echo "<table>"
		?>
		<h1>Find other blocked pallets</h1>
		<p>Choose a cookie name</p>
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
			</select><P>
			<input type="submit" value ="Find blocked pallets">
		</form >
		
		<h2>Return to the startpage</h2>
		<p>To return to the start page click "Return to start"</p>
		<form method="get" action="index.php">
			<input type="submit" value ="Return to start">
		</form >
	</body>
</html>

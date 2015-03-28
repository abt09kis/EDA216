<?php
	require_once('database.inc.php');
	
	session_start();
	$db = $_SESSION['db'];
	$db->openConnection();
	if($_POST["startTime"]<$_POST["endTime"]){
		$result = $db->getPalletsInfoByTime($_POST["startTime"],$_POST["endTime"]);
	}
	$db->closeConnection();
?>
<html>
	<header><title>Search pallet by time</title></header>
	<body>
		<h1>Search pallet by pallet </h1>
		
		<h2>Found pallets </h2>
		<?php
			if(count($result) > 0){
				echo "<p>Found pallets in timeframe from:".$_POST["startTime"]." to:".$_POST["endTime"]." </p>";
				echo "<table>";
	  			echo "<tr>";
				echo	"<th>palletNbr</th>";
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
				
			}else if($_POST["startTime"]>$_POST["endTime"]){
				echo "Wrong format";
			}else{
				echo "No result timeframe from: ".$_POST["startTime"]." to: ".$_POST["endTime"]."";
			}
		?>
		</table>
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
		
		<h2>Return to the startpage</h2>
		<p>To return to the start page click Return to start</p>
		<form method="get" action="index.php">
			<input type="submit" value ="Return to start">
		</form >
	</body>
</html>

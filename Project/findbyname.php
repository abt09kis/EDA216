<?php
	require_once('database.inc.php');
	
	session_start();
	$db = $_SESSION['db'];
	$db->openConnection();
	$result = $db->findPalletsByName($_POST["cookieName"]);
	$cookieName = $db->getCookieName();
	$db->closeConnection();
	
?>

<html>
	<header><title>Search pallet by cookie name</title></header>
	<body>
		<h1>Search pallet by cookie name </h1>
		
		<h2>Found pallets </h2>
		<?php
			if(count($result) > 0){
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
			
			}else{
				echo "No pallets with cookies by the name: ".$_POST["cookieName"];
			}
		?>
		
		</table>
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

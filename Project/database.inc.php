<?php
/*
 * Class Database: interface to the movie database from PHP.
 *
 * You must:
 *
 * 1) Change the function userExists so the SQL query is appropriate for your tables.
 * 2) Write more functions.
 *
 */
class Database {
	private $host;
	private $userName;
	private $password;
	private $database;
	private $conn;
	
	/**
	 * Constructs a database object for the specified user.
	 */
	public function __construct($host, $userName, $password, $database) {
		$this->host = $host;
		$this->userName = $userName;
		$this->password = $password;
		$this->database = $database;
	}
	
	/** 
	 * Opens a connection to the database, using the earlier specified user
	 * name and password.
	 *
	 * @return true if the connection succeeded, false if the connection 
	 * couldn't be opened or the supplied user name and password were not 
	 * recognized.
	 */
	public function openConnection() {
		try {
			$this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", 
					$this->userName,  $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			$error = "Connection error: " . $e->getMessage();
			print $error . "<p>";
			unset($this->conn);
			return false;
		}
		return true;
	}
	
	/**
	 * Closes the connection to the database.
	 */
	public function closeConnection() {
		$this->conn = null;
		unset($this->conn);
	}

	/**
	 * Checks if the connection to the database has been established.
	 *
	 * @return true if the connection has been established
	 */
	public function isConnected() {
		return isset($this->conn);
	}
	
	/**
	 * Execute a database query (select).
	 *
	 * @param $query The query string (SQL), with ? placeholders for parameters
	 * @param $param Array with parameters 
	 * @return The result set
	 */
	private function executeQuery($query, $param = null) {
		try {
			$stmt = $this->conn->prepare($query);
			$stmt->execute($param);
			$result = $stmt->fetchAll();
		} catch (PDOException $e) {
			$error = "*** Internal error: " . $e->getMessage() . "<p>" . $query;
			die($error);
		}
		return $result;
	}

	public function getPalletsInfoByTime($startTime, $endTime){
		$stmt = "Select * from Pallets where prodTime >= ? and prodTime <= ? ";
		$result = $this->executeQuery($stmt,array($startTime,$endTime));
		return $result;
	}
	public function getCookieName(){
		$stmt = "Select cookieName from Cookies";
		$result =$this->executeQuery($stmt);
		for($i = 0; $i<count($result) ; ++$i){
			$cookies[]=$result[$i][0];
		}
		return $cookies;

	}

	public function getIngredientsCookie($cookieName){
		$stmt = "Select ingredientName,quantity from Recipes where cookieName = ? " ;
		$result = $this->executeQuery($stmt, array($cookieName));
	
		for($i = 0; $i<count($result); ++$i){
			$ingredients[$result[$i][0]] = intval($result[$i][1]);
		}
		return $ingredients;
		
	
	}
	
	public function useCookieIngrediants($cookieName){
			$ingredients = $this->getIngredientsCookie($cookieName);
			$sql = "update Ingredients set quantity = quantity-(?*54) where ingredientName = ? and quantity > 0";
			$this->conn->beginTransaction();
			foreach($ingredients as $ingredient => $quant){
				$affectedRows = $this->executeUpdate($sql,array($quant,$ingredient));
				if($affectedRows  !== 1 ){
					$this->conn->rollback();
					return false;
				}
			}
			$this->conn->commit();
			return true;
			
	
	
	}

	public function createPallet($cookieName){
		$sql = "insert into Pallets (palletNbr,cookieName,prodTime,blocked,delivered) VALUES (palletNbr,?,NOW(),?,?)";
		$this -> executeUpdate($sql,array($cookieName,"false","false"));
		$palletId = $this->conn->lastInsertId();
		return $palletId;
		
	}
	
	public function getPalletInfo($palletId){
		$sql = "select * from Pallets where palletNbr = ? ";
		$result=$this->executeQuery($sql, array($palletId));
		return $result[0];   
	}
	public function findPalletsByName($cookieName){
		$sql = "select * from Pallets where cookieName = ? order by prodTime";
		$result = $this->executeQuery($sql,array($cookieName)); 
		return $result;
	
	}
	public function blockPallets($cookieName,$startTime,$endTime){
		if($startTime>$endTime){
		return 0;
		}
		$sql = "update Pallets set blocked = ? where cookieName = ? and prodTime >= ? and prodTime <= ?";
		return $this->executeUpdate($sql,array("true",$cookieName,$startTime,$endTime));
	
	}
	public function findBlockedPallets($cookieName){
		$sql = "select * from Pallets where cookieName = ? and blocked = ? ";
		return $this->executeQuery($sql,array($cookieName,"true"));
	
	}
	
	
	/**
	 * Execute a database update (insert/delete/update).
	 *
	 * @param $query The query string (SQL), with ? placeholders for parameters
	 * @param $param Array with parameters 
	 * @return The number of affected rows
	 */
	private function executeUpdate($query, $param = null) {
		try {
			$stmt = $this->conn->prepare($query);
			$stmt->execute($param);
			$numberRowsAffected = $stmt->rowCount();
		} catch (PDOException $e) {
			$error = "*** Internal error: " . $e->getMessage() . "<p>" . $query;
			die($error);
		}
		return $numberRowsAffected;
	}
	

	
}
?>

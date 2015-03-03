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
	public function getDates($movieName){
		$sql = "select perfDate from Performances where movieName = ?";
		$result = $this->executeQuery($sql,array($movieName));	
		$dates = array();
		for($i = 0; $i<count($result) ; ++$i){
			$dates[]=$result[$i][0];
		}
		return $dates;
	}
	public function getPerformance($movieName,$date){
			$param = array($movieName,$date);
			$sql = "select * from Performances where movieName = ? and perfDate = ?";
			$result = $this->executeQuery($sql,$param);
			return $result;
	
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
	public function bookTicket($movieName, $date, $user){
		try{
			$this->conn->beginTransaction();
			$sql = "update Performances set freeSeats = freeSeats -1 where movieName = ? and perfDate = ? and freeSeats > 0";
			$param = array($movieName,$date);
			$numbRowsAffected=$this->executeUpdate($sql,$param);
			//echo "number of row affected ".$numbRowAffected
			if($numbRowsAffected){
				$sql = "insert into Tickets (resNbr,userName,movieName,perfDate) VALUES (resNbr,?,?,?)";
				$param = array($user,$movieName,$date);
				$this->executeUpdate($sql,$param);
				$result=$this->conn->lastInsertId();
				$this->conn->commit();
				return $result;
			}else{
				return "false";
			}
		} catch (PDOException $e) {
			$this->conn->rollback();
			$error = "*** Internal error: " . $e->getMessage() . "<p>" . $query;
			die($error);
		}
	}
		
	
	/**
	 * Check if a user with the specified user id exists in the database.
	 * Queries the Users database table.
	 *
	 * @param userId The user id 
	 * @return true if the user exists, false otherwise.
	 */
	public function userExists($userId) {
		$sql = "select userName from Users where userName = ?";
		$result = $this->executeQuery($sql, array($userId));
		return count($result) == 1; 
	}
	
	public function getMovieNames(){
		$sql = "select movieName from Movies";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		for($i = 0; $i<count($result) ; ++$i){
			$movies[]=$result[$i][0];
		}
		return $movies;
	}

	/*
	 * *** Add functions ***
	 */
}
?>

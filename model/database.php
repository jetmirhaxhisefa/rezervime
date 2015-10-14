<?php 
class Database{
	private static $user = "root";
	private static $password = "";
	private static $database = "rezervime";
	private static $host = "localhost";
	
	public $connection;
	public $lastQuery;
	
	public function Database(){
		$this->connectDb();
	}
	
	public function getConnection(){ return $this->connection;}
	
	public function connectDb(){ 
		$this->connection = mysqli_connect(self::$host, self::$user, self::$password, self::$database);
		if ($this->connection) {
			return true;
		}else{
			die(mysqli_error("Database cannot be connected. <br>", mysqli_connect_error()));
			return false;
		}
	}
	
	// to execute a query
	public function performQuery($sql) {
		$query = $sql;
		$this->lastQuery = $query;
		$result = mysqli_query($this->connection, $query);
		return $this->checkQuery($result) == true ? $result : null;
	}
	
	// check for unwanted characters
	public function escapeString($string){
		return $this->connection->real_escape_string($string);
	}
	
	// check if query is ok
	private function checkQuery($result){
		if (!$result) {
			die("Problem in query ". $this->lastQuery. "<br> ". mysqli_error($this->connection));
			return false;
		}else{
			return true;
		}
	}
	
	// disconnect database
	public function disconnectDb(){
		if ($this->connection) {
			mysqli_close($this->connection);
			$this->connection = null;
		}
	}
	
}
?>
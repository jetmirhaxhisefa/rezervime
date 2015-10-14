<?php
class Visitors{
	private $visitorId;
	private $ipAdress;
	private $dateTime;
	private $month;
	private $year;
	
	public function setVisitorId($visitorId){ $this->visitorId = utf8_encode($visitorId); }
	public function setIpAdress($ipAdress){ $this->ipAdress = utf8_encode($ipAdress); }
	public function setDateTime($dateTime){ $this->dateTime = utf8_encode($dateTime); }
	public function setMonth($month){ $this->month = utf8_encode($month); }
	public function setYear($year){ $this->year = utf8_encode($year); }
	
	public function getVisitorId(){ return utf8_decode($this->visitorId); }
	public function getIpAdress(){ return utf8_decode($this->ipAdress); }
	public function getDateTime(){ return utf8_decode($this->dateTime); }
	public function getMonth(){ return utf8_decode($this->month); }
	public function getYear(){ return utf8_decode($this->year); }
	
	// 	CREATE
	public function create($database){
		$sql = "INSERT INTO visitors (ipAdress,dateTime,month,year) VALUES('$this->ipAdress','$this->dateTime','$this->month','$this->year')";
		$query = $database->performQuery($sql);
		return mysqli_insert_id($database->connection);
	}
	// GET ALL
	public function getAll($database){
		$sql = "SELECT * FROM visitors";
		$query = $database->performQuery($sql);
		return $query;
	}
	// GET ALL BY MONTH AND YEAR
	public function countByMonthAndYear($database,$month){
		$sql = "SELECT count(visitorId) as count FROM visitors WHERE month = $month AND year = (SELECT max(year) FROM `visitors`)";
		$query = $database->performQuery($sql);
		$result = $query->fetch_assoc();
		return $result['count'];
	}
	
}
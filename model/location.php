<?php
class Location{
	private $stateId;
	private $state;
	private $cityId;
	private $cityName;
	
	
	public function setStateId($stateId){ $this->stateId = utf8_encode($stateId); }
	public function setState($state){ $this->state = utf8_encode($state); }
	public function setCityId($cityId){ $this->cityId = utf8_encode($cityId); }
	public function setCityName($cityName){ $this->cityName = utf8_encode($cityName); }
	
	public function getStateId(){ return utf8_decode($this->stateId); }
	public function getState(){ return utf8_decode($this->state); }
	public function getCityId(){ return utf8_decode($this->cityId); }
	public function getCityName(){ return utf8_decode($this->cityName); }
	
	// GET ALL STATES
	public function getAllStates($database){
		$sql = "SELECT * FROM state";
		$query = $database->performQuery($sql);
		return $query;
	}
	// GET DESTINATION PER STATE ID
	public static function getAllDestinationPerLocation($database,$stateId){
		$sql = "SELECT * FROM city WHERE stateId = '$stateId' ";
		$query = $database->performQuery($sql);
		return $query;
	}
	// GET DESTINATION PER STATE ID
	public function getDestinationById($database){
		$sql = "SELECT * FROM city WHERE cityId = '$this->cityId' ";
		$query = $database->performQuery($sql);
		$result = $query->fetch_assoc();
		$this->cityName = $result['cityName'];
	}

}
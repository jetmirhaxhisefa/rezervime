<?php
class Hotel{
	private $hotelId;
	private $hotelName;
	private $description;
	private $stars;
	private $state;
	private $cityId;
	private $address;
	private $destinationId;
	
	
	public function setHotelId($hotelId){ $this->hotelId = utf8_encode($hotelId); }
	public function setHotelName($hotelName){ $this->hotelName = utf8_encode($hotelName); }
	public function setDescription($description){ $this->description = utf8_encode($description); }
	public function setStars($stars){ $this->stars = utf8_encode($stars); }
	public function setState($state){ $this->state = utf8_encode($state); }
	public function setCityId($cityId){ $this->cityId = utf8_encode($cityId); }
	public function setAddress($address){ $this->address = utf8_encode($address); }
	
	public function getHotelId(){ return utf8_decode($this->hotelId); }
	public function getHotelName(){ return utf8_decode($this->hotelName); }
	public function getDescription(){ return utf8_decode($this->description); }
	public function getStars(){ return utf8_decode($this->stars); }
	public function getState(){ return utf8_decode($this->state); }
	public function getCityId(){ return utf8_decode($this->cityId); }
	public function getAddress(){ return utf8_decode($this->address); }
	
	// 	CREATE
	public function create($database){
		$sql = "INSERT INTO hotel (hotelName,description,stars,address,cityId) VALUES('$this->hotelName','$this->description','$this->stars','$this->address','$this->cityId')";
		$query = $database->performQuery($sql);
		return mysqli_insert_id($database->connection);
	}
	// add categorist for hotel
	public function giveHotelCategories($database,$postId,$categoryId){
		$sql = "INSERT INTO hotel_category (hotelId,categoryId) VALUES('$postId','$categoryId')";
		$query = $database->performQuery($sql);
		return $query;
	}
	// GET ALL
	public function getAll($database){
		$sql = "SELECT * FROM hotel";
		$query = $database->performQuery($sql);
		return $query;
	}
	// 	DELETE
	public function delete($database){
		$sql = "DELETE FROM hotel WHERE hotelId = $this->hotelId";
		$query = $database->performQuery($sql);
		return $query;
	}
	// 	DELETE CATEGORIES OF A HOTEL
	public function deleteCategories($database){
		$sql = "DELETE FROM hotel_category WHERE hotelId = $this->hotelId";
		$query = $database->performQuery($sql);
		return $query;
	}
	// GET BY ID
	public function getById($database){
		$sql = "SELECT * FROM hotel WHERE hotelId = {$this->hotelId}";
		$query = $database->performQuery($sql);
		$result = $query->fetch_array();
	
		$this->hotelName = $result['hotelName'];
		$this->description = $result['description'];
		$this->stars = $result['stars'];
		$this->state = $result['state'];
		$this->cityId = $result['cityId'];
		$this->address = $result['address'];
	}
	// GET CATEGORIES OF A HOTEL
	public function checkIfPostHasCategory($database,$categoryId){
		$sql = "SELECT * FROM hotel_category WHERE hotelId = {$this->hotelId} AND categoryId = $categoryId";
		$query = $database->performQuery($sql);
		return mysqli_num_rows($query);
	}
	// UPDATE
	public function update($database){
		$sql = "UPDATE hotel SET hotelName = '$this->hotelName', description = '$this->description', stars = '$this->stars', address = '$this->address', cityId = '$this->cityId' WHERE hotelId = $this->hotelId";
		$query = $database->performQuery($sql);
		return $query;
	}
}
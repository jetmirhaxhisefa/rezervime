<?php
class Room{
	private $roomId;
	private $hotelId;
	private $roomName;
	private $description;
	private $isAvailable;
	private $availableUntil;
	private $price;
	private $persons;

	public function setRoomId($roomId){ $this->roomId = utf8_encode($roomId); }
	public function setHotelId($hotelId){ $this->hotelId = utf8_encode($hotelId); }
	public function setRoomName($roomName){ $this->roomName = utf8_encode($roomName); }
	public function setDescription($description){ $this->description = utf8_encode($description); }
	public function setIsAvailable($isAvailable){ $this->isAvailable = utf8_encode($isAvailable); }
	public function setAvailableUntil($availableUntil){ $this->availableUntil = utf8_encode($availableUntil); }
	public function setPrice($price){ $this->price = utf8_encode($price); }
	public function setPersons($persons){ $this->persons = utf8_encode($persons); }
	
	public function getRoomId(){ return utf8_decode($this->roomId); }
	public function getHotelId(){ return utf8_decode($this->hotelId); }
	public function getRoomName(){ return utf8_decode($this->roomName); }
	public function getDescription(){ return utf8_decode($this->description); }
	public function getIsAvailable(){ return utf8_decode($this->isAvailable); }
	public function getAvailableUntil(){ return utf8_decode($this->availableUntil); }
	public function getPrice(){ return utf8_decode($this->price); }
	public function getPersons(){ return utf8_decode($this->persons); }

	// 	CREATE
	public function create($database){
		$sql = "INSERT INTO room (hotelId,roomName,description,isAvailable,availableUntil,price,persons) VALUES('$this->hotelId','$this->roomName','$this->description','$this->isAvailable',
		'$this->availableUntil','$this->price','$this->persons')";
		$query = $database->performQuery($sql);
		return mysqli_insert_id($database->connection);
	}
	// GET ALL
	public function getAll($database){
		$sql = "SELECT * FROM room";
		$query = $database->performQuery($sql);
		return $query;
	}
	// GET BY HOTEL ID
	public function getByHotelId($database){
		$sql = "SELECT * FROM room WHERE hotelId = {$this->hotelId}";
		$query = $database->performQuery($sql);
		return $query;
	}
	// GET BY ID
	public function getById($database){
		$sql = "SELECT * FROM room WHERE roomId = {$this->roomId}";
		$query = $database->performQuery($sql);
		$result = $query->fetch_assoc();
		
		$this->roomName = $result['roomName'];
		$this->description = $result['description'];
		$this->isAvailable = $result['isAvailable'];
		$this->availableUntil = $result['availableUntil'];
		$this->price = $result['price'];
		$this->persons = $result['persons'];
		$this->hotelId = $result['hotelId'];
	}
	// UPDATE
	public function update($database){
		$sql = "UPDATE room SET roomName = '$this->roomName', description = '$this->description', price = '$this->price', persons = '$this->persons', isAvailable = '$this->isAvailable', availableUntil = '$this->availableUntil' WHERE roomId = $this->roomId";
		$query = $database->performQuery($sql);
		return $query;
	}
}
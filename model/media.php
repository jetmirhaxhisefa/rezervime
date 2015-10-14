<?php
class Media{
	private $mediaId;
	private $postId;
	private $hotelId;
	private $roomId;
	private $thumb;
	private $large;
	private $type;
	private $alt;
	
	public function setMediaId($mediaId){ $this->mediaId = utf8_encode($mediaId); }
	public function setPostId($postId){ $this->postId = utf8_encode($postId); }
	public function setHotelId($hotelId){ $this->hotelId = utf8_encode($hotelId); }
	public function setRoomId($roomId){ $this->roomId = utf8_encode($roomId); }
	public function setThumb($thumb){ $this->thumb = utf8_encode($thumb); }
	public function setLarge($large){ $this->large = utf8_encode($large); }
	public function setType($type){ $this->type = utf8_encode($type); }
	public function setAlt($alt){ $this->alt = utf8_encode($alt); }
	
	public function getMediaId(){ return utf8_decode($this->mediaId); }
	public function getPostId(){ return utf8_decode($this->postId); }
	public function getHotelId(){ return utf8_decode($this->hotelId); }
	public function getRoomId(){ return utf8_decode($this->roomId); }
	public function getThumb(){ return utf8_decode($this->thumb); }
	public function getLarge(){ return utf8_decode($this->large); }
	public function getType(){ return utf8_decode($this->type); }
	public function getAlt(){ return utf8_decode($this->alt); }
	
	// create media
	public function create($database){
		$sql = "INSERT INTO media (postId,thumb,large,type,alt) VALUES('$this->postId','$this->thumb','$this->large','$this->type','$this->alt')";
		$query = $database->performQuery($sql);
		return $query;
	}
	// 	DELETE 
	public function delete($database){
		$sql = "DELETE FROM media WHERE mediaId = $this->mediaId";
		$query = $database->performQuery($sql);
		return $query;
	}
	// 	DELETE MEDIA OF A POST
	public function deleteMediaOfAPost($database){
		$sql = "DELETE FROM media WHERE postId = $this->postId";
		$query = $database->performQuery($sql);
		return $query;
	}
	// 	GET BY POST
	public function getByPostId($database){
		$sql = "SELECT * FROM media WHERE postId = $this->postId";
		$query = $database->performQuery($sql);
		return $query;
	}
	
//************  HOTELS *****************	
	// create hotel img
	public function createImgForHotel($database){
		$sql = "INSERT INTO hotelimg (large,thumb,alt,hotelId) VALUES('$this->large','$this->thumb','$this->alt','$this->hotelId')";
		$query = $database->performQuery($sql);
		return $query;
	}
	// 	GET BY HOTEL
	public function getByHotelId($database){
		$sql = "SELECT * FROM hotelimg WHERE hotelId = $this->hotelId";
		$query = $database->performQuery($sql);
		return $query;
	}
	// 	DELETE MEDIA OF A HOTEL
	public function deleteMediaOfAHotel($database){
		$sql = "DELETE FROM hotelimg WHERE hotelId = $this->hotelId";
		$query = $database->performQuery($sql);
		return $query;
	}
	// 	DELETE HOTEL IMG
	public function deleteHotelImg($database,$imgId){
		$sql = "DELETE FROM hotelimg WHERE imgId = $imgId";
		$query = $database->performQuery($sql);
		return $query;
	}
	
//************  ROOMS *****************
	// create ROOM IMAGE
	public function createImgForRoom($database){
		$sql = "INSERT INTO roomimg (large,thumb,alt,roomId) VALUES('$this->large','$this->thumb','$this->alt','$this->roomId')";
		$query = $database->performQuery($sql);
		return $query;
	}
	// 	GET BY HOTEL
	public function getByRoomId($database){
		$sql = "SELECT * FROM roomimg WHERE roomId = $this->roomId";
		$query = $database->performQuery($sql);
		return $query;
	}
	

//***************  FRONTEND ******************/
	// 	GET BY POST
	public function getByPostIdLimit($database){
		$sql = "SELECT * FROM media WHERE postId = $this->postId LIMIT 1";
		$query = $database->performQuery($sql);
		return $query;
	}
}
?>
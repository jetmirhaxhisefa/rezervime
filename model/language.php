<?php 
class Language{
	private $langId;
	private $langName;
	private $default;

	public function setId($langId){ $this->langId = utf8_encode($langId); }
	public function setLangName($langName){ $this->langName = utf8_encode($langName); }
	public function setDefault($default){ $this->default = utf8_encode($default); }
	
	public function getId(){ return utf8_decode($this->langId); }
	public function getLangName(){ return utf8_decode($this->langName); }
	public function getDefault(){ return utf8_decode($this->default); }
	
	// get all languages
	public function getAll($database){
		$sql = "SELECT * FROM language";
		$result = $database->performQuery($sql);
		return $result;
	}
	// create
	public function create($database){
		$sql = "INSERT INTO language (langName) VALUES ('$this->langName')";
		$result = $database->performQuery($sql);
		return $result;
	}
	// delete
	public function delete($database){
		$sql = "DELETE FROM language WHERE langId = $this->langId";
		$result = $database->performQuery($sql);
		return $result;
	}
	// update default
	public function updateDefault($database){
		$sql1 = "UPDATE language SET `default` = 0";
		$result1 = $database->performQuery($sql1);
		$sql = "UPDATE language SET `default` = $this->default WHERE langId = $this->langId";
		$result = $database->performQuery($sql);
		return $result;
	}
	// GET BY ID
	public function getById($database){
		$sql = "SELECT * FROM language WHERE langId = $this->langId";
		$query = $database->performQuery($sql);
		$result = $query->fetch_array();
		$this->langName = $result['langName'];
		$this->default = $result['default'];
	}
}
?>
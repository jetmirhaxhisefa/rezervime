<?php
class Privilege{
	private $id;
	private $privilege;
	
	public function setId($id){ $this->id = utf8_encode($id); }
	public function setPrivilege($privilege){ $this->privilege = utf8_encode($privilege); }
	
	public function getId(){ return utf8_decode($this->id); }
	public function getPrivilege(){ return utf8_decode($this->privilege); }
	
	// get privilege by id
	public function getPrivilegeById(){
		$database = new Database();
		$sql = "SELECT * FROM privileges WHERE privilegeId = {$this->id}";
		$query = $database->performQuery($sql);
		if ($query != null){
			$result = $query->fetch_assoc();
			$this->id = $result["id"];
			$this->privilege = $result["privilege"];
		}
	}
	// get all privileges
	public function getAll(){
		$sql = "SELECT * FROM privileges";
		$database = new Database();
		$result =  $database->performQuery($sql);
		$database->disconnectDb();
		return $result;
	}
}

?>
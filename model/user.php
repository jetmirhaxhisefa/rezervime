<?php 
class User{
	private $id;
	private $name;
	private $lastname;
	private $username;
	private $password;
	private $email;
	private $privilegeId;
	private $active;

	public function setId($id){ $this->id = utf8_encode($id); }
	public function setName($name){ $this->name = utf8_encode($name); }
	public function setLastname($lastname){ $this->lastname = utf8_encode($lastname); }
	public function setUsername($username){ $this->username = utf8_encode($username); }
	public function setPassword($password){ $this->password = utf8_encode($password); }
	public function setEmail($email){ $this->email = utf8_encode($email); }
	public function setPrivilegeId($privilegeId){ $this->privilegeId = utf8_encode($privilegeId); }
	public function setActive($active){ $this->active = utf8_encode($active); }
	
	public function getId(){ return utf8_decode($this->id); }
	public function getName(){ return utf8_decode($this->name); }
	public function getLastname(){ return utf8_decode($this->lastname); }
	public function getUsername(){ return utf8_decode($this->username); }
	public function getPassword(){ return utf8_decode($this->password); }
	public function getEmail(){ return utf8_decode($this->email); }
	public function getPrivilegeId(){ return utf8_decode($this->privilegeId); }
	public function getActive(){ return utf8_decode($this->active); }
	
// 	authenticate user for login   
	public function authenticate($database){
		$sql = "SELECT * FROM users";
		$query = $database->performQuery($sql);
		$isOk = false;
		$count = 1;
		while($user = $query->fetch_array()){
			if(password_verify ($this->password, $user['password']) && $this->username == $user['username']){
				$this->id = $user['userId'];
				$this->username = $user['username'];
				$this->password = $user['password'];
				$this->name = $user['name'];
				$this->lastName = $user['lastName'];
				$this->email = $user['email'];
				$this->privilegeId = $user['privilegeId'];
				$this->active = $user['active'];
				if($this->active){
					return true;
				}else{
					return false;
				}
			}else{
				$isOk = false;
			}
			$count++;
		}
		if($isOk == false){
			return false;
		}
	}
	
	// get all users
	public function getAll($database){
		$sql = "SELECT * FROM users";
		$query = $database->performQuery($sql);
		if ($query != null){
			return $query;
		}else{
			return null;
		}
	}
	
	// get users by id
	public function getById($database){
		$sql = "SELECT * FROM users WHERE userId = {$this->id}";
		$query = $database->performQuery($sql);
		$query2 = $database->performQuery($sql);
		$result = $query2->fetch_assoc();
		$this->id = $result['userId'];
		$this->name = $result['name'];
		$this->lastname = $result['lastName'];
		$this->username = $result['username'];
		$this->password = $result['password'];
		$this->email = $result['email'];
		$this->privilegeId = $result['privilegeId'];
		$this->active = $result['active'];
		return $query;
	}
	
	// ADD user
	public function create($database){
		$password = password_hash($this->password, PASSWORD_BCRYPT);
		$sql = "INSERT INTO users (username,password,name,lastName,email,privilegeId,active)
		VALUES ('{$this->username}','{$password}','{$this->name}','{$this->lastname}','{$this->email}','{$this->privilegeId}','{$this->active}')";
		$query = $database->performQuery($sql);
		if($query){
			return true;
		}else{
			return false;
		}
	}
	
	// delete user
	public function delete($database){
		$sql = "DELETE FROM users WHERE userId = {$this->id}";
		$query = $database->performQuery($sql);
		if ($query != null){
			return true;
		}else{
			return false;
		}
	}
	
	// change active
	public function changeActive($database){
		$active = ($this->active == true ? 0 : 1);
		$sql = "UPDATE users SET active = {$active} WHERE userId = {$this->id}";
		$query = $database->performQuery($sql);
		if ($query != null){
			return true;
		}else{
			return false;
		}
	}
	// update 
	public function update(){
		$database = new Database();
		$sql = "UPDATE users SET name = '{$this->name}', lastname = '{$this->lastname}', username = '{$this->username}' ,email = '{$this->email}', privilegeId = '{$this->privilegeId}' WHERE userId = {$this->id}";
		$query = $database->performQuery($sql);
		$database->disconnectDb();
		return $query;
	}
	// update password
	public function updatePassword(){
		$database = new Database();
		$password = password_hash($this->password, PASSWORD_BCRYPT);
		$sql = "UPDATE users SET password = '{$password}' WHERE userId = {$this->id}";
		$query = $database->performQuery($sql);
		$database->disconnectDb();
		return $query;
	}
	
	// store Logs
	public function storeLog($text,$path){
		$file = $path."/user".$this->id.".txt";
		$content = "";
		if(file_exists($file)){
			if($handler =  fopen($file,'r')){
				if(filesize($file) != 0){
					$content = fread($handler, filesize($file));
				}
				fclose($handler);
			}
		}
		
		if($handler =  fopen($file,'w')){
			if($content != ""){
				$newText = $content."\r\n".$text;
			}else{
				$newText = $text;
			}
			fwrite($handler,$newText);
			fclose($handler);
		}
	}
	
	public function findLog(){
		$filename = "logs/user".$this->id.".txt";
		if(file_exists($filename)){
			return true;
		}else{
			return false;
		}
	}
	
	// get user by username
	public function getByUsername(){
		$database = new Database();
		$sql = "SELECT * FROM users WHERE username = '{$this->username}'";
		$result = $database->performQuery($sql);
		$database->disconnectDb();
		return $result;
	}
	
	// get user by email
	public function getByEmail(){
		$database = new Database();
		$sql = "SELECT * FROM users WHERE email = '{$this->email}'";
		$result = $database->performQuery($sql);
		$database->disconnectDb();
		return $result;
	}
	
	// change user privilege
	public function changePrivilege(){
		$database = new Database();
		$sql = "UPDATE users SET privilegeId = '{$this->privilegeId}' WHERE userId = {$this->id}";
		$query = $database->performQuery($sql);
		$database->disconnectDb();
		return $query;
	}
}
?>
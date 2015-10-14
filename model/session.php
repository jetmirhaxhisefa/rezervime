<?php
class Session{
	public $isLogin = false;
	private $session_id_to_destroy = 'rreeaasdasdaewrasd';
	
  	public function Session(){
		session_start();
		//session_id($this->session_id_to_destroy);
		$this->checkLogIn();
	}
	private function checkLogIn(){
		if (isset($_SESSION[$this->session_id_to_destroy])){
			$this->isLogin = true;
		}else{
			$this->isLogin = false;
		}
	}
	
	// when user login in authenticate 
	public function logIn($user){
		session_set_cookie_params (60 * 30, '../rezervime');
		$userId = $user->getId();
		$username = $user->getUsername();
		$fullName = $user->getName() . " ".$user->getLastname();
		$email = $user->getEmail();
		$privilegeId = $user->getPrivilegeId();
		$privilege = new Privilege();
		$privilege->setId($privilegeId);
		$privilege->getPrivilegeById();
		$privilegeName = $privilege->getPrivilege();
		
		if (!isset($_SESSION[$this->session_id_to_destroy])){
			$_SESSION['USID'] = $userId;
			$_SESSION[$this->session_id_to_destroy] = $this->session_id_to_destroy;
			$_SESSION['USNM'] = $username;
			$_SESSION['USFN'] = $fullName;
			$_SESSION['USE'] = $email;
			$_SESSION['USPRID'] = $privilegeId;
			$_SESSION['USPR'] = $privilegeName;
			$this->isLogin = true;
		}
	}
	
	public function logOut(){
			$this->isLogin = false;
			//$_SESSION['USID'] = "";
			//$_SESSION['USNM'] = "";
			unset($_SESSION[$this->session_id_to_destroy]);
			//session_destroy();
	}
}
?>
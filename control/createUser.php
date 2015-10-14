<?php
require_once '../model/paths.php';
$session = new Session();
if (!$session->isLogin){redirect("../login.php");}
$user = new User();
$database = new Database();


if(isset($_POST['name'])){
	// get all values
	$name = $database->escapeString($_POST['name']);
	$lastname = $database->escapeString($_POST['lastname']);
	$email = $database->escapeString($_POST['email']);
	$username = $database->escapeString($_POST['username']);
	if(isset($_POST['password'])){
		$password = $database->escapeString($_POST['password']);
	}else{
		$password = "";
	}
	
	$privilege = $_POST['privilege'];
	// set all values to user model
	$user->setName($name);
	$user->setLastname($lastname);
	$user->setEmail($email);
	$user->setUsername($username);
	$user->setPassword($password);
	$user->setPrivilegeId($privilege);
	
	$user->setActive(1);
	if(isset($_POST['userId'])){
		$user->setId($database->escapeString($_POST['userId']));
		$user->update();
		if($password != ""){
			$user->updatePassword();
		}
		echo "true";
	}else{
		if($user->create($database)){
			// if user is created
			$path = "../logs";
			$dateTime = strftime("%Y-%m-%d %H:%M:%S");
			$text = "User with id ".$_SESSION['USID']. " created a new user with Username: ". $username;
			$content = $dateTime." ". $_SESSION['USNM'] .": ".$text;
			$user->setId($_SESSION['USID']);
			$user->storeLog($content,$path);
			
			echo "true";
		}else{
			// if user couldn't be created
			echo "false";
		}
	}
	
}

?>
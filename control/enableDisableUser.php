<?php
require_once '../model/paths.php';
$session = new Session();
if (!$session->isLogin){redirect("../login.php");}
$user = new User();
$database = new Database();

if(isset($_GET['user']) && isset($_GET['active']) && $_GET['user'] != null && $_GET['active'] != null){
	$id = $database->escapeString($_GET['user']);
	$active = $database->escapeString($_GET['active']);
	$user->setId($id);
	$user->setActive($active);
	
	if($user->changeActive($database)){
		
		$path = "../logs";
		$dateTime = strftime("%Y-%m-%d %H:%M:%S");
		$text = "Enabled/Disabled user with id :".$id; 
		$content = $dateTime." ". $_SESSION['USNM'] .": ".$text;
		$user->setId($_SESSION['USID']);
		$user->storeLog($content,$path);
		
		redirect("../users.php");
	}else{
		
	}
}else{
	echo "User not set";
}
?>
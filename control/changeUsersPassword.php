<?php
require_once '../model/paths.php';
$session = new Session();
if (!$session->isLogin){redirect("../login.php");}
$database = new Database();
$user = new User();

if (isset($_POST['submit'])){
	$newPass = $database->escapeString($_POST['newPass']);
	$confPass = $database->escapeString($_POST['confPass']);
	$code = $database->escapeString($_POST['code']);
	$hash = password_hash($newPass, PASSWORD_BCRYPT);
	
	if($newPass != $confPass){
		redirect($_SERVER['HTTP_REFERER']."&error=equals");
	}else if (strlen($newPass) < 6){
		redirect($_SERVER['HTTP_REFERER']."&error=length");
	}else{
		$user->setId($code);
		$user->setPassword($hash);
		if($user->updatePassword()){
			$path = "../logs";
			$dateTime = strftime("%Y-%m-%d %H:%M:%S");
			$text = "Password changed for user with ID:";
			$content = $dateTime." ". $_SESSION['USNM'] .": ".$text;
			$user->setId($_SESSION['USID']);
			$user->storeLog($content,$path);
				
			redirect("../users.php?users=1&pass=succeed");
		}else{
				echo "Your settings could not be changed. Try Again or contact your Administrator!";
		}
	}
	
	
	
}else{
	echo "Your password could not be changed. Try Again or contact your Administrator!";
}
?>
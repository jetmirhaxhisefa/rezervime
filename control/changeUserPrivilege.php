<?php
require_once '../model/paths.php';
$session = new Session();
if (!$session->isLogin){redirect("../login.php");}
$database = new Database();
$user = new User();

if(isset($_POST['privilege']) && isset($_POST['userId'])){
	$isOk = false;
	$userID = $database->escapeString($_POST['userId']);
	$privilegeId = $database->escapeString($_POST['privilege']);
	
	if($_SESSION['USPRID'] == 1){
		$isOk = true;
	}else if($_SESSION['USPRID'] == 2){
		$user->setId($userID);
		$user->getById($database);
		if($user->getCompanyId() == $_SESSION['CID']){
			$isOk = true;
		}
	}
	
	if($isOk){
		$user->setPrivilegeId($privilegeId);
		$user->setId($userID);
		if($user->changePrivilege()){
			echo "true";
		}else{
			echo "false";
		}
	}else{
		echo "false";
	}
}else{
	echo "false";
}
?>
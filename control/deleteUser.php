<?php
require_once '../model/paths.php';
$session = new Session();
if (!$session->isLogin){redirect("../login.php");}
$user = new User();
$database = new Database();

if (isset($_POST['userList'])){
	foreach ($_POST['userList'] as $userID){
		$user->setId($userID);
		$user->delete($database);

		$path = "../logs";
		$dateTime = strftime("%Y-%m-%d %H:%M:%S");
		$text = "Deleted user with id:".$userID;
		$content = $dateTime." ". $_SESSION['USNM'] .": ".$text;
		$user->setId($_SESSION['USID']);
		$user->storeLog($content,$path);
	}

	echo "true";
	$database->disconnectDb();
}else{
	echo "false";
	$database->disconnectDb();
}
?>
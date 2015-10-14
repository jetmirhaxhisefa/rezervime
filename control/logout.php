<?php
require_once '../model/paths.php';
$session = new Session();
if (!$session->isLogin){redirect("../login.php");}
$user = new User();
	$path = "../logs";
	$dateTime = strftime("%Y-%m-%d %H:%M:%S");
	$text = "Logged Out";
	$content = $dateTime." ". $_SESSION['USNM'] .": ".$text;
	$user->setId($_SESSION['USID']);
	$user->storeLog($content,$path);

	$session->logOut();
	redirect("../login.php");
?>
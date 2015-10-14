<?php
require_once '../model/paths.php';
$session = new Session();
if (!$session->isLogin){redirect("../login.php");}
$database = new Database();
$user = new User();
$language = new Language();

if(isset($_GET['langId'])){
	$langId = $database->escapeString($_GET['langId']);
	$language->setId($langId);
	$language->setDefault(1);
	if($language->updateDefault($database)){
		redirect("../settings.php?settings=1");
	}else{
		echo "<h2>Default language cannot be change. Contact your administrator</h2>";
	}
}else{
	echo "<h2>Try again or contact your administrator</h2>";
}
?>
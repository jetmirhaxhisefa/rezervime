<?php
require_once '../model/paths.php';
$session = new Session();
if (!$session->isLogin){redirect("../login.php");}
$user = new User();
$database = new Database();
$page = new Page();

if(isset($_POST['pageList']) && $_POST['pageList'] != null){
	foreach ($_POST['pageList'] as $pageId){
		$page->setPageId($database->escapeString($pageId));
		$page->delete($database);
	
		$path = "../logs";
		$dateTime = strftime("%Y-%m-%d %H:%M:%S");
		$text = "Deleted page with id:".$pageId;
		$content = $dateTime." ". $_SESSION['USNM'] .": ".$text;
		$user->setId($_SESSION['USID']);
		$user->storeLog($content,$path);
		echo "true";
	}
}else{
	echo "false";
}

?>
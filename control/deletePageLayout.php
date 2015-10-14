<?php
require_once '../model/paths.php';
$session = new Session();
if (!$session->isLogin){redirect("../login.php");}
$user = new User();
$database = new Database();
$pageLayout = new PageLayout();

if(isset($_POST['pageLayoutList']) && $_POST['pageLayoutList'] != null){
	foreach ($_POST['pageLayoutList'] as $pageLayoutId){
		$pageLayout->setPageLayoutId($database->escapeString($pageLayoutId));
		$pageLayout->getById($database);
		
		unlink("../".$pageLayout->getImage());
		$pageLayout->delete($database);
	
		$path = "../logs";
		$dateTime = strftime("%Y-%m-%d %H:%M:%S");
		$text = "Deleted page layout with id:".$pageLayoutId." and name: ".$pageLayout->getName();
		$content = $dateTime." ". $_SESSION['USNM'] .": ".$text;
		$user->setId($_SESSION['USID']);
		$user->storeLog($content,$path);
		echo "true";
	}
}else{
	echo "false";
}

?>
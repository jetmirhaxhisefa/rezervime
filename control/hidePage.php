<?php
require_once '../model/paths.php';
$session = new Session();
if (!$session->isLogin){redirect("../login.php");}
$user = new User();
$database = new Database();
$page = new Page();

// check the parameters
if(isset($_GET['page']) && isset($_GET['active']) && $_GET['page'] != null && $_GET['active'] != null){
	// set page id
	$pageId = $database->escapeString($_GET['page']);
	$page->setPageId($pageId);
	
	// change the visibility otherwise
	if ($_GET['active'] == 1) {
		$visibility = 0;
		$page->setVisibility($visibility);
		$page->chageVisibility($database);
		redirect("../pages.php?pages=1");
	}else if ($_GET['active'] == 0){
		$visibility = 1;
		$page->setVisibility($visibility);
		$page->chageVisibility($database);
		redirect("../pages.php?pages=1");
	}else{
		echo "<h1>Go back and try again or contact your Administrator<br>There is something wrong with the visibility value</h1>";
	}
}else{
	echo "<h1>Go back and try again or contact your Administrator</h1>";
}

$database->disconnectDb();
?>
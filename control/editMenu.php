<?php
require_once '../model/paths.php';
$session = new Session();
if (!$session->isLogin){redirect("../login.php");}
$database = new Database();
$user = new User();
$menu = new Menu();
$links = new Links();
$pages = new Page();
$category = new Category();

if (isset($_POST['linksArray']) && $_POST['linksArray'] != NULL) {
	$menuTitle = $database->escapeString($_POST['menuTitle']);
	$isMain = $database->escapeString($_POST['isMain']);
	$linksArray = $_POST['linksArray'];
	$positionArray = $_POST['positionArray'];
	$menuId = $database->escapeString($_POST['menuId']);
	// CHANGE TITLE
	$menu->setTitle($menuTitle);
	$menu->setMenuId($menuId);
	$menu->updateTitle($database);
	$menu->setLangId($menu->getMenuLang($database));
	// UPDATE isMain
	if($_POST['isMain'] == "true"){
		$menu->updateIsMain($database);
	}
	// DELETE LINKS
	if(isset($_POST['deletedList'])){
		$deletedList = $_POST['deletedList'];
		foreach ($deletedList as $del){
			$links->setLinkId($database->escapeString($del));
			if($links->delete($database)){}
		}
	}
	// EDIT POSITIONS
	$count = 0;
	foreach ($linksArray as $link){
		$links->setLinkId($database->escapeString($link));
		$links->setPosition($database->escapeString($positionArray[$count]));
		if($links->updatePosition($database)){}
		$count++;
	}
	echo "true";
}else{
	echo "false";
}
?>
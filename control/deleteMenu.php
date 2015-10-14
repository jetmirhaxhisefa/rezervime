<?php
require_once '../model/paths.php';
$session = new Session();
if (!$session->isLogin){redirect("../login.php");}
$database = new Database();
$user = new User();
$menu = new Menu();
$links = new Links();
$pages = new Page();

if(isset($_GET['menuid']) && $_GET['menuid'] != null ){
	$menuId = $database->escapeString($_GET['menuid']);
	$links->setMenuId($menuId);
	$menu->setMenuId($menuId);
	// look if this menu is a main menu
	$isMain = $menu::getMainMenuId($database);
	// delete menu with his links
	if($links->deleteByMenu($database) && $menu->delete($database)){
		// make main menu the next top menu 
		if($isMain == $menuId){
			$menu->makeTopMenuToMain($database);
		}
		redirect("../pages.php?pages=4");
	}else{
		echo "<h1>Contact your administrator</h1>";
	}
	
}else{
	echo "<h1>DELETION FAILED! Go back and try again or contact your administrator</h1>";
}
?>
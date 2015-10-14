<?php
require_once '../model/paths.php';
$session = new Session();
if (!$session->isLogin){redirect("../login.php");}
$database = new Database();
$user = new User();
$menu = new Menu();
$links = new Links();
$pages = new Page();

if(isset($_POST['addMenuBtn'])){
	$menuName = $database->escapeString($_POST['menuName']);
	$description = $database->escapeString($_POST['description']);
	
	// check if parent is set
	if(isset($_POST['parent']) && $_POST['parent'] != "" && $_POST['parent'] != null){
		$parentLinkId = $database->escapeString($_POST['parent']);
		$links->setLinkId($parentLinkId);
		$language = $links->getSubMenusLangId($database);
	}else{
		$language = $database->escapeString($_POST['language']);
		$parentLinkId = 0;
	}
	// set values
	$menu->setLangId($language);
	$menu->setIsMain(0);
	$menu->setDescription($description);
	$menu->setParentLinkId($parentLinkId);
	$menu->setTitle($menuName);
	
	// do not allove a link to have two sub menus
	if($parentLinkId != 0){
		if($menu::checkParent($database,$parentLinkId) == 0){
			if($menu->create($database)){
				redirect("../pages.php?pages=4");
			}else{
				echo "<h3>MENU COULD NOT BE CREATED!!! CONTACT YOUR ADMINISTRATOR OR TRY AGAIN.</h3>";
			}
		}else{
			echo "<h3>SAME LINK CANNOT HAVE 2 SUB MENUS</h3>";
		}
		
	}else{
		if($menu->create($database)){
			redirect("../pages.php?pages=4");
		}else{
			echo "<h3>MENU COULD NOT BE CREATED!!! CONTACT YOUR ADMINISTRATOR OR TRY AGAIN.</h3>";
		}
	}
	
}else{
	echo "<h3>MENU COULD NOT BE CREATED!!! CONTACT YOUR ADMINISTRATOR OR TRY AGAIN.</h3>";
}
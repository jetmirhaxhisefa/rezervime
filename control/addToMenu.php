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

if(isset($_POST['pageId']) && $_POST['pageId'] != "" 
		&& isset($_POST['menuId']) && $_POST['menuId'] != "" 
		&& isset($_POST['isCategory']) && $_POST['isCategory'] == "false"){

	// add pages to the menu
	$menuId = $database->escapeString($_POST['menuId']);
	$appearName = $database->escapeString($_POST['appearName']);
	
	$links->setMenuId($menuId);
	$links->setCategoryId(0);
	$links->setIsCustomLink(0);
	$links->setHttp("");
	
	$startPos = $links->numByMenu($database)+1;
	foreach ($_POST['pageId'] as $id){
		if($appearName == ""){
			$pages->setPageId($id);
			$pages->getById($database);
			$links->setAppearName($pages->getPageName());
		}else{
			$links->setAppearName($appearName);
		}
		$links->setPosition($startPos);
		$links->setPageId($id);
		$links->create($database);
		$startPos++;
	}
	echo "true";
}else if(isset($_POST['catIds']) && $_POST['catIds'] != "" 
		&& isset($_POST['menuId']) && $_POST['menuId'] != "" 
		&& isset($_POST['isCategory']) && $_POST['isCategory'] == "true"){
	// add pages to the menu
	$menuId = $database->escapeString($_POST['menuId']);
	$appearName = $database->escapeString($_POST['appearName']);
	
	$links->setMenuId($menuId);
	$links->setIsCustomLink(0);
	$links->setHttp("");
	$links->setPageId(0);
	
	$startPos = $links->numByMenu($database)+1;
	foreach ($_POST['catIds'] as $id){
		if($appearName == ""){
			$category->setCategoryId($database->escapeString($id));
			$category->getById($database);
			$links->setAppearName($category->getCategory());
		}else{
			$links->setAppearName($appearName);
		}
		$links->setCategoryId($database->escapeString($id));
		$links->setPosition($startPos);
		$links->create($database);
		$startPos++;
	}
	echo "true";
}else if(isset($_POST['menuId']) && $_POST['menuId'] != "" 
		&& isset($_POST['isCategory']) && $_POST['isCategory'] == "false"
		&& isset($_POST['isCustomLink']) && $_POST['isCustomLink'] == "true"){

	// add pages to the menu
	$menuId = $database->escapeString($_POST['menuId']);
	$appearName = $database->escapeString($_POST['appearName']);
	
	$links->setMenuId($menuId);
	$links->setIsCustomLink(1);
	$links->setPageId(0);
	$links->setCategoryId(0);
	$links->setAppearName($appearName);
	$startPos = $links->numByMenu($database)+1;
	$links->setPosition($startPos);

	if (!filter_var($_POST['customLink'], FILTER_VALIDATE_URL) === false) {
		$links->setHttp($database->escapeString($_POST['customLink']));
		if($links->create($database)){
			echo "true";
		}
	} else {
		echo "Enter a valid link";
	}	 
}else{
	echo "false";
}
?>
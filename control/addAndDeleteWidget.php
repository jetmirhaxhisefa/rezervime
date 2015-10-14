<?php
require_once '../model/paths.php';
$session = new Session();
if (!$session->isLogin){redirect("../login.php");}
$database = new Database();
$user = new User();
$widget = new Widget();
$menu = new Menu();
$post = new Post();

if(isset($_POST['widgetName'])){
	$widgetId = $database->escapeString($_POST['widgetName']);
	$widgetName = "Widget ".$widgetId;
	$widget->setWidgetId($widgetId);
	$widget->setName($widgetName);
	$widget->setMenuId(0);
	$widget->setPostId(0);
	
	if($widget->create($database)){
		echo "true";
	}else{
		echo "false";
	}
}else if(isset($_POST['widgetIds'])){
	foreach($_POST['widgetIds'] as $widgetId){
		$widget->setWidgetId($widgetId);
		$widget->delete($database);
	}
	echo "true";
}else if(isset($_POST['widgetId'])){
	$widgetId = $database->escapeString($_POST['widgetId']);
	$type = $database->escapeString($_POST['type']);
	$array = [];
	$widget->setWidgetId($widgetId);
	if($type == "menu"){
		$menuOrPostId = $database->escapeString($_POST['menuOrPostId']);
		$widget->setMenuId($menuOrPostId);
		$widget->setPostId(0);
		$widget->update($database);
		echo "true";
	}else if($type == "post"){
		$menuOrPostId = $database->escapeString($_POST['menuOrPostId']);
		$widget->setMenuId(0);
		$widget->setPostId($menuOrPostId);
		$widget->update($database);
		echo "true";
	}else{
		echo "false";
	}
}else{
	echo "Try again later";
}
?>
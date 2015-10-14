<?php
require_once '../model/paths.php';
$session = new Session();
if (!$session->isLogin){redirect("../login.php");}
$database = new Database();
$user = new User();
$category = new Category();

if(isset($_POST['categoryName'])){
	$categoryName = $database->escapeString($_POST['categoryName']);
	$parent = $database->escapeString($_POST['parent']);
	$category->setCategory($categoryName);
	$category->setInherit($parent);
	if($category->create($database)){
		echo "true";
	}else{
		echo "false";
	}
}else if(isset($_POST['categoryId'])){
	foreach($_POST['categoryId'] as $categoryId){
		$category->setCategoryId($categoryId);
		$category->delete($database);
		$category->deleteCategories($database);
	}
	echo "true";
}else{
	echo "Try again later";
}
?>
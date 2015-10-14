<?php 
require_once '../model/paths.php';
$session = new Session();
if (!$session->isLogin){redirect("../login.php");}
$database = new Database();
$user = new User();
$category = new Category();

if($_POST['category']){
	$category->setCategoryId($database->escapeString($_POST['categoryId']));
	foreach($_POST as  $key=>$value){
		if($key == "categoryId" || $key == "submit"){
			continue;
		}
		$category->update($database, $key, $value);
	}	
	redirect("../posts.php?posts=4&category={$_POST['categoryId']}");
}else{
	echo "<h2>Problem in editing category. Try again later or contact your administrator.</h2>";
}
?>
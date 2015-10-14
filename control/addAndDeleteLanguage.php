<?php
require_once '../model/paths.php';
$session = new Session();
if (!$session->isLogin){redirect("../login.php");}
$database = new Database();
$user = new User();
$language = new Language();
$category = new Category();

if(isset($_POST['langName'])){
	$langName = $database->escapeString($_POST['langName']);
	$language->setLangName($langName);
	if($language->create($database)){
		$columnName = strtolower($langName);
		$category->insertColumnForLanguage($database, $columnName);
		echo "true";
	}else{
		echo "false";
	}
}else if(isset($_POST['languageIds'])){
	foreach($_POST['languageIds'] as $langId){
		$language->setId($langId);
		$language->getById($database);
		if($language->getLangName() != ""){
			$category->deleteColumnForLanguage($database, strtolower($language->getLangName()));
		}
		$language->delete($database);
	}
	echo "true";
}else{
	echo "Try again later";
}
?>
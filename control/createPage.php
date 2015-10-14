<?php
require_once '../model/paths.php';
$session = new Session();
if (!$session->isLogin){redirect("../login.php");}
$database = new Database();
$page = new Page();

if(isset($_POST['submitPage'])){
	$submitPage = $database->escapeString($_POST['submitPage']);
	
	$title = $database->escapeString($_POST['title']);
	$pageName = $database->escapeString($_POST['pageName']);
	$urlTag = $database->escapeString($_POST['urlTag']);
	$metaDesc = $database->escapeString($_POST['metaDesc']);
	$metaKeywords = $database->escapeString($_POST['metaKeywords']);
	$layout = $database->escapeString($_POST['layout']);
	
	$page->setTitle($title);
	$page->setPageName($pageName);
	$page->setUrlTag($urlTag);
	$page->setMetaDesc($metaDesc);
	$page->setMetaKeywords($metaKeywords);
	$page->setPageLayoutId($layout);
	
	
	if($submitPage == "Save"){
		$page->setVisibility(0);
	}else if($submitPage == "Save & Publish"){
		$page->setVisibility(1);
	}
	if(isset($_POST['pageId'])){
		$page->setPageId($database->escapeString($_POST['pageId']));
		if($page->update($database)){
			redirect("../pages.php?pages=1");
		}else{
			echo "<h2>Something is wrong go back and try again, or contact your administrator</h2>";
		}
	}else{
		if($page->create($database)){
			redirect("../pages.php?pages=1");
		}else{
			echo "<h2>Something is wrong go back and try again, or contact your administrator</h2>";
		}
	}
}else{
	echo "Something is wrong go back and try again!";
}
?>
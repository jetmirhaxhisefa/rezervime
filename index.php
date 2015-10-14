<?php require 'model/paths.php';?>
<?php 
	$database = new Database();
	$menu = new Menu();
	$page = new Page();
	$pageLayout = new PageLayout();
	$post = new Post();
	$media = new Media();
	$category = new Category();
	$lang = new Language();
	$visitors = new Visitors();
	
	$urlReq = $_SERVER['REQUEST_URI'];
	if(strpos($urlReq, "?")){$urlReq = substr($urlReq, 0, strpos($urlReq, "?"));}
	$urlTag = basename($urlReq);
?>
<?php 
	if(file_exists('themes/includes/header.php')){
		include 'themes/includes/header.php';
	}
?>

<?php 
	$page->setUrlTag($urlTag);
	if($urlTag == "cms-admin"){
		redirect("cms-admin.php");
	}else if(!$page->getPageByUrlTag($database)){
		$menuId = $menu->getMenuOfdefaultLang($database);
		$queryP = $page->getPagesAndLinksByMenu($database,$menuId);
		$resultPage = $queryP->fetch_assoc();
		$pageId = $resultPage['pageId'];
		$post->setPageId($pageId);
		include 'themes/home.php';
	}else{
		$page->getPageByUrlTag($database);
		$pageId = $page->getPageId();
		$post->setPageId($pageId);
		$pageLayout->setPageLayoutId($page->getPageLayoutId());
		$pageLayout->getById($database);
		include $pageLayout->getDesignUrl();
	}
?>
<?php
	$date = new DateTime();
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	$visitors->setIpAdress($ip);
	$visitors->setDateTime($date->format('Y-m-d H:i:s'));
	$visitors->setMonth($date->format('m'));
	$visitors->setYear($date->format('Y'));
	$visitors->create($database);
?>

<?php 
	if(file_exists('themes/includes/footer.php')){
		include 'themes/includes/footer.php';
	}
?>

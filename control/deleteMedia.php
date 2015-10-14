<?php
require_once '../model/paths.php';
$session = new Session();
if (!$session->isLogin){redirect("../login.php");}
$database = new Database();
$user = new User();
$post = new Post();
$media = new Media();
// delete media
if(isset($_POST['mediaId'])){
	$mediaId = $database->escapeString($_POST['mediaId']);
	$media->setMediaId($mediaId);
	if($media->delete($database)){
		echo "true";
	}else{
		echo "false";
	}
	
}

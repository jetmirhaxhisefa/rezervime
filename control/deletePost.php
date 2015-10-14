<?php
require_once '../model/paths.php';
$session = new Session();
if (!$session->isLogin){redirect("../login.php");}
$user = new User();
$database = new Database();
$post = new Post();
$media = new Media();

if(isset($_POST['postList']) && $_POST['postList'] != null){
	foreach ($_POST['postList'] as $postId){
		// DELETE CATEGORIES OF A POST
		$post->setPostId($postId);
		$post->deleteCategories($database);
		// DELETE MEDIA OF A POST
		$media->setPostId($postId);
		$media->deleteMediaOfAPost($database);
		// DELTE POST ITSELF
		$post->delete($database);
		
		$path = "../logs";
		$dateTime = strftime("%Y-%m-%d %H:%M:%S");
		$text = "Deleted post with id:".$postId;
		$content = $dateTime." ". $_SESSION['USNM'] .": ".$text;
		$user->setId($_SESSION['USID']);
		$user->storeLog($content,$path);
		echo "true";
	}
}else{
	echo "false";
}

?>
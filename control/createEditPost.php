<?php
require_once '../model/paths.php';
$session = new Session();
if (!$session->isLogin){redirect("../login.php");}
$database = new Database();
$user = new User();
$post = new Post();
$media = new Media();

if(isset($_POST['submit'])){
	//print_r($_FILES['mediaUploads']);
	
	$title = $database->escapeString($_POST['title']);
	$undertitle = $database->escapeString($_POST['undertitle']);
	$pageId = $database->escapeString($_POST['pageId']);
	$body =  $database->escapeString($_POST['body']);
	$d = new DateTime();
	$date = $d->format('Y-m-d H:i');
	$userId = $_SESSION['USID'];
	
	$post->setTitle($title);
	$post->setUnderTitle($undertitle);
	$post->setPageId($pageId);
	$post->setBody($body);
	$post->setDate($date);
	$post->setUserId($userId);
	
	if(isset($_POST['postId'])){
		$postId = $database->escapeString($_POST['postId']);
		$post->setPostId($postId);
		$post->update($database);
		$post->deleteCategories($database);
	}else{
		$postId = $post->create($database);
	}
	if(isset($_POST['categories'])){
		$categoriesArray = $_POST['categories'];
		foreach ($categoriesArray as $cat){
			$post->givePostCategories($database, $postId, $cat);
		}
	}
	
	if(count($_FILES) != 0){
		$error = 0;
		$files = array();
		$uploaddir = "../images/posts/large/";
		$uploaddirthumb = "../images/posts/thumb/";
		
			$nameArray = $_FILES['mediaUploads']['name'];
			$typeArray = $_FILES['mediaUploads']['type'];
			$tmpNameArray = $_FILES['mediaUploads']['tmp_name'];
			$errorArray = $_FILES['mediaUploads']['error'];
			$sizeArray = $_FILES['mediaUploads']['size'];
			
			for($count = 0; $count < count($_FILES['mediaUploads']['name']);$count++){
					$target_file = $uploaddir . basename($nameArray[$count]);
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					$check = getimagesize($tmpNameArray[$count]);
						
					// Check if file already exists
					if (file_exists($imageFileType)) {
						echo "Sorry, file already exists.";
						$error = 1;
					}
					// Check file size
					if ($sizeArray[$count] > 5000000) {
						echo "Sorry, your file is too large.";
						$error = 1;
					}
					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
							&& $imageFileType != "gif" ) {
								echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
								$error = 1;
					}else{
						// set type of file to add to database
						$media->setType("img");
					}
					
					if($error == 0){
						if(move_uploaded_file($tmpNameArray[$count], $uploaddir .basename($nameArray[$count]))){
							$files[] = $uploaddir .$nameArray[$count];
							echo $uploaddir;
							
							// create thumb
							$image = $uploaddir .basename($nameArray[$count]);
							$imageSize = getimagesize($image);
							$width = $imageSize[0];
							$height = $imageSize[1];
							
							$newSize = ($width + $height) / ($width*($height/150));
							$newWidth = $width * $newSize;
							$newHeight = $height * $newSize;

							// finalize thum by checking what file format it is 	
							if($imageFileType == "jpg" || $imageFileType == "jpeg"){
								header("Contant-type: image/jpeg");
								$oldImage = imagecreatefromjpeg($image);
								$newImage = imagecreatetruecolor($newWidth, $newHeight);
								imagecopyresized($newImage, $oldImage, 0, 0, 0, 0, $newWidth, $newHeight, $width,$height);
								imagejpeg($newImage, $uploaddirthumb.basename($nameArray[$count]));
							}elseif($imageFileType == "png"){
							header("Contant-type: image/png");
								$oldImage = imagecreatefrompng($image);
								$newImage = imagecreatetruecolor($newWidth, $newHeight);
								
								$background = imagecolorallocate($newImage, 0, 0, 0);
								// removing the black from the placeholder
								imagecolortransparent($newImage, $background);
								
								// turning off alpha blending (to ensure alpha channel information
								// is preserved, rather than removed (blending with the rest of the
								// image in the form of black))
								imagealphablending($newImage, false);
								
								// turning on alpha channel information saving (to ensure the full range
								// of transparency is preserved)
								imagesavealpha($newImage, true);
								
								imagecopyresized($newImage, $oldImage, 0, 0, 0, 0, $newWidth, $newHeight, $width,$height);
								imagepng($newImage, $uploaddirthumb.basename($nameArray[$count]));
							}elseif ($imageFileType == "gif"){
								header("Contant-type: image/gif");
								$oldImage = imagecreatefromgif($image);
								$newImage = imagecreatetruecolor($newWidth, $newHeight);
								imagecopyresized($newImage, $oldImage, 0, 0, 0, 0, $newWidth, $newHeight, $width,$height);
								imagegif($newImage, $uploaddirthumb.basename($nameArray[$count]));
							}else{}
							
							// save images to database
							$media->setLarge($database->escapeString(str_replace("../", "", $uploaddir .basename($nameArray[$count]))));
							$media->setThumb($database->escapeString(str_replace("../", "", $uploaddirthumb.basename($nameArray[$count]))));
							
							$filename =  $database->escapeString(basename($nameArray[$count]));
							$newFileName = substr($filename, 0 , (strrpos($filename, ".")));
							
							$media->setAlt($newFileName);
							$media->setPostId($postId);
							$media->create($database);
						}
					}
					
			}
			
								
	}
			// remove temporary images in tmp folder
			$tmpImages = scandir("../images/tmp".$_SESSION['USID']);
			foreach ($tmpImages as $tmpI){
				$filename = "../images/tmp".$_SESSION['USID']."/".$tmpI;
				@unlink($filename);
			}
			
			// SAVE youtube video tags
			foreach ($_POST['youtube'] as $youtube){
				$media->setType("youtube");
				$media->setLarge($database->escapeString($youtube));
				$media->setThumb($database->escapeString($youtube));
				$media->setAlt("Youtube video");
				$media->setPostId($postId);
				$media->create($database);
			}
	redirect("../posts.php?posts=1");
			
}
		
	
	

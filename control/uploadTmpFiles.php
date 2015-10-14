<?php 
require_once '../model/paths.php';
$session = new Session();
if (!$session->isLogin){redirect("../login.php");}
$database = new Database();
$user = new User();
$menu = new Menu();
$links = new Links();
$pages = new Page();

	$uploaddir = "../images/tmp".$_SESSION['USID']."/";
	if(!file_exists($uploaddir) && !mkdir($uploaddir, 0777, true)) {
		die('Failed to create folders...');
	}else{
		$error = 0;
		$files = array();
		
		foreach($_FILES as $file){
			$target_file = $uploaddir . basename($file["name"]);
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			$check = getimagesize($file["tmp_name"]);
			
			// Check if file already exists
			if (file_exists($imageFileType)) {
				echo "Sorry, file already exists.";
				$error = 1;
			}
			// Check file size
			if ($file["size"] > 5000000) {
				echo "Sorry, your file is too large.";
				$error = 1;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					&& $imageFileType != "gif" ) {
						echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
						$error = 1;
					}
			if($error == 0){
				if(move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name']))){
			    	$files[] = $uploaddir .$file['name'];
			    	echo $uploaddir;
			    }
			}
		}
	}
?>
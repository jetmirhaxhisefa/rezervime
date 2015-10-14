<?php
require_once '../model/paths.php';
$session = new Session();
if (!$session->isLogin){redirect("../login.php");}
$database = new Database();
$user = new User();
$room = new Room();
$location = new Location();
$media = new Media();

if(isset($_POST['submit'])){
	
	$name = $database->escapeString($_POST['name']);
	$price = $database->escapeString($_POST['price']);
	$persons = $database->escapeString($_POST['persons']);
	$isAvailable =  $database->escapeString($_POST['isAvailable']);
	$availableUntil = $database->escapeString($_POST['availableUntil']);
	$description = $database->escapeString($_POST['description']);
	$hotelId = $database->escapeString($_POST['hotelId']);
	
	$room->setRoomName($name);
	$room->setPrice($price);
	$room->setPersons($persons);
	$room->setIsAvailable($isAvailable);
	if($isAvailable == 1){
		$room->setAvailableUntil($availableUntil);
	}else{
		$room->setAvailableUntil("NOT AVAILABLE");
	}
	$room->setDescription($description);
	$room->setHotelId($hotelId);
	
	
	if(isset($_POST['roomId'])){
		$roomId = $database->escapeString($_POST['hotelId']);
		$room->setRoomId($roomId);
		$hotel->update($database);
	}else{
		$roomId = $room->create($database);
	}
	
	if(count($_FILES) != 0){
		$error = 0;
		$files = array();
		$uploaddir = "../images/rooms/large/";
		$uploaddirthumb = "../images/rooms/thumb/";
		
			$nameArray = $_FILES['mediaUploads']['name'];
			$typeArray = $_FILES['mediaUploads']['type'];
			$tmpNameArray = $_FILES['mediaUploads']['tmp_name'];
			$errorArray = $_FILES['mediaUploads']['error'];
			$sizeArray = $_FILES['mediaUploads']['size'];
			
			for($count = 0; $count < count($_FILES['mediaUploads']['name']);$count++){
					$randomNrForName = rand(1, 9999999999);
					$target_file = $uploaddir .$randomNrForName. basename($nameArray[$count]);
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
						
						if(move_uploaded_file($tmpNameArray[$count], $uploaddir.basename($nameArray[$count]))){
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
								imagejpeg($newImage, $uploaddirthumb.$randomNrForName.basename($nameArray[$count]));
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
								imagepng($newImage, $uploaddirthumb.$randomNrForName.basename($nameArray[$count]));
							}elseif ($imageFileType == "gif"){
								header("Contant-type: image/gif");
								$oldImage = imagecreatefromgif($image);
								$newImage = imagecreatetruecolor($newWidth, $newHeight);
								imagecopyresized($newImage, $oldImage, 0, 0, 0, 0, $newWidth, $newHeight, $width,$height);
								imagegif($newImage, $uploaddirthumb.$randomNrForName.basename($nameArray[$count]));
							}else{}
							
							// save images to database
							$media->setLarge($database->escapeString(str_replace("../", "", $uploaddir.$randomNrForName .basename($nameArray[$count]))));
							$media->setThumb($database->escapeString(str_replace("../", "", $uploaddirthumb.$randomNrForName.basename($nameArray[$count]))));
							
							$filename =  $database->escapeString(basename($nameArray[$count]));
							$newFileName = substr($filename, 0 , (strrpos($filename, ".")));
							
							$media->setAlt($newFileName);
							$media->setRoomId($roomId);
							$media->createImgForRoom($database);
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
			
	redirect("../booking.php?booking=4&hotel=".$hotelId);
			
}
		
	
	

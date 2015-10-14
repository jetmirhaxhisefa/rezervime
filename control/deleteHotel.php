<?php
require_once '../model/paths.php';
$session = new Session();
if (!$session->isLogin){redirect("../login.php");}
$user = new User();
$database = new Database();
$hotel = new Hotel();
$media = new Media();

if(isset($_POST['hotelList']) && $_POST['hotelList'] != null){
	foreach ($_POST['hotelList'] as $hotelId){
		// DELETE CATEGORIES OF A HOTEL
		$hotel->setHotelId($hotelId);
		$hotel->deleteCategories($database);
		// DELETE MEDIA OF A HOTEL
		$media->setHotelId($hotelId);
		$mediaArray = $media->getByHotelId($database);
		while($row = $mediaArray->fetch_assoc()){
			@unlink("../".$row['large']);
			@unlink("../".$row['thumb']);
		}
		$media->deleteMediaOfAHotel($database);
		// DELTE HOTEL ITSELF
		$hotel->delete($database);
		
		$path = "../logs";
		$dateTime = strftime("%Y-%m-%d %H:%M:%S");
		$text = "Deleted hotel with id:".$hotelId;
		$content = $dateTime." ". $_SESSION['USNM'] .": ".$text;
		$user->setId($_SESSION['USID']);
		$user->storeLog($content,$path);
		echo "true";
	}
}else{
	echo "false";
}

?>
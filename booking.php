<?php 
	require_once 'model/paths.php';
	$session = new Session();
	if (!$session->isLogin){redirect("login.php");}
	include_once 'includes/header.php';
	$database = new Database();
	$category = new Category();
	$location = new Location();
	$hotel = new Hotel();
	$media = new Media();
	$room = new Room();
?>
<title id="booking">Booking</title>

<?php 
if(isset($_GET['booking']) && $_GET['booking'] == 1){
	include_once 'includes/allBooking.php';
}else if(isset($_GET['booking']) && $_GET['booking'] == 2){
	include_once 'includes/addAndEditHotel.php';
}else if(isset($_GET['booking']) && $_GET['booking'] == 3){
	include_once 'includes/addAndEditRoom.php';
}else if(isset($_GET['booking']) && $_GET['booking'] == 4){
	include_once 'includes/allRooms.php';
}else{
	redirect("posts.php?posts=1");
}
?>


<script>
	$('.jqte-test').jqte();
	
	// settings of status
	var jqteStatus = true;
	$(".status").click(function()
	{
		jqteStatus = jqteStatus ? false : true;
		$('.jqte-test').jqte({"status" : jqteStatus})
	});
</script>

<script type="text/javascript" src="js/formValidation.js"></script>
<script type="text/javascript" src="js/delete.js"></script>
<?php include_once 'includes/footer.php'; $database->disconnectDb(); ?>
<?php 
	require_once 'model/paths.php';
	$session = new Session();
	if (!$session->isLogin){redirect("login.php");}
	include_once 'includes/header.php';
	$database = new Database();
	$user = new User();
	$privilege = new Privilege();
?>
<title id="users">Users</title>
<?php
	if(isset($_GET['pass']) && $_GET['pass'] == "succeed"){
		?><script type="text/javascript">alert("Password changed");</script><?php
	}else if(isset($_GET['error']) && $_GET['error'] == "equals"){ 
		?><script type="text/javascript">alert("Password and Confirm Password don't match");</script><?php
	}else if(isset($_GET['error']) && $_GET['error'] == "length"){ 
		?><script type="text/javascript">alert("Password length must be at least 6 characters");</script><?php
	}

	if(isset($_GET['users']) && $_GET['users'] == 1){
		include_once 'includes/allUsers.php';
	}else if(isset($_GET['users']) && $_GET['users'] == 2){ 
		include_once 'includes/addUser.php';
	}else if(isset($_GET['users']) && $_GET['users'] == 3){ 
		include_once 'includes/usersDetails.php';
	}else if(isset($_GET['users']) && $_GET['users'] == 4){ 
		include_once 'includes/changeUsersPassword.php';
	}else{
		include_once 'includes/allUsers.php';
	}
?>

<script type="text/javascript" src="js/delete.js"></script>
<script type="text/javascript" src="js/formValidation.js"></script>
<?php include_once 'includes/footer.php'; ?>
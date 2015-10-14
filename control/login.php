<?php
	require_once '../model/paths.php';

	$session = new Session();
	$user = new User();
	$database = new Database();
	$username = $database->escapeString($_POST['username']);
	$password = $database->escapeString($_POST['password']);
	if ($username == "" || $password == "") {
		// if user or password fields are empty
		redirect("../login.php?error=fill");
	}else{
		$user->setUsername($username);
		$user->setPassword($password);
// 		check the user
		if($user->authenticate($database)){
			$session->logIn($user);
			$database->disconnectDb();

			$path = "../logs";
			$dateTime = strftime("%Y-%m-%d %H:%M:%S");
			$text = "Logged In";
			$content = $dateTime." ". $_SESSION['USNM'] .": ".$text;
			$user->setId($_SESSION['USID']);
			$user->storeLog($content,$path);
			redirect("../cms-admin.php");
		}else{
			redirect("../login.php?error=login");
		}
		
		$database->disconnectDb();
	}
	
?>
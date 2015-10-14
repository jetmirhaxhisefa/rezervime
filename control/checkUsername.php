<?php
require_once '../model/paths.php';
$session = new Session();
if (!$session->isLogin){redirect("../login.php");}
$database = new Database();
$user = new User();
	if (isset($_POST['username'])){
		$username = $database->escapeString($_POST['username']);
		$user->setUsername($username);
		$result = $user->getByUsername();
		if(mysqli_num_rows($result) == 1){
			echo "false";
		}else{
			echo "true";
		}
	}
?>
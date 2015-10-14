<?php 
	require_once 'model/paths.php';
	$session = new Session();
	if ($session->isLogin){redirect("index.php");}
?>

<!DOCTYPE HTML >
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<link rel="stylesheet" type="text/css" href="css/login.css">
<title>Log in</title>
</head>
    <body>
    	<div id="loginWrapper">
    	<center><h3>PLEASE LOG IN</h3></center>
    		<hr id="hr"><br>
    		<form action="control/login.php" method="post" id="loginForm">
    			<input type="text" name="username" placeholder="Username">
    			<input type="password" name="password" placeholder="Password">
    			<input type="submit" id="login" name="Log In" value="Log in"> 
    		</form>
    		<hr id="hr2">
    		<hr id="hr3">
    	</div>
    </body>
</html>
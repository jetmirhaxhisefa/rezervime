<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<link rel="stylesheet" type="text/css" href="css/admin-style.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" src="js/searches.js"></script>


<link href="jquery-ui/jquery-ui.css" rel="stylesheet">
<script src="jquery-ui/external/jquery/jquery.js"></script>
<script src="jquery-ui/jquery-ui.js"></script>
 <script>
  $(function() {
    $( "#datepicker" ).datepicker({ minDate: 0});
  });
  </script>

<link type="text/css" rel="stylesheet" href="css/jquery-te-1.4.0.css">
<script type="text/javascript" src="js/jquery-te-1.4.0.min.js" charset="utf-8"></script>



</head>
<body>
<div id="leftWrapper">
	<div id="leftContainer"><!-- Open leftContainer -->
		<div id="welcome">
			<p><b>Welcome</b> <?php echo $_SESSION['USNM']; ?></p>
			
		</div>
		<nav>
			<p id="navTitle">Navigation</p>
			<ul>
				<li><a href="cms-admin.php" class="dashboard">
                	<img alt="" src="./images/homeicon.png"><span>Dashboard</span>
                </a></li>
                <?php if($_SESSION['USPRID'] == 1){ ?>
				<li>
                	<a href='pages.php?pages=1' class='pages'><img src='./images/pages-icon.png'><span>Pages</span></a>
                	<ul>
                    	<li><a href="pages.php?pages=1" class="">All pages</a></li>
                        <li><a href="pages.php?pages=2" class="">Add page</a></li>
                        <li><a href="pages.php?pages=3" class="">Layouts</a></li>
                        <li><a href="pages.php?pages=4" class="">Menus</a></li>
                    </ul>    
                </li>
                <?php } ?>
                <li>
                	<a href='posts.php?posts=1' class='posts'><img src='./images/posts-icon.png'><span>Posts</span></a>
                	<ul>
                    	<li><a href="posts.php?posts=1" class="">All posts</a></li>
                        <li><a href="posts.php?posts=2" class="">Add posts</a></li>
                        <li><a href="posts.php?posts=3" class="">Categories</a></li>
                    </ul>    
                </li>
                <?php if($_SESSION['USPRID'] == 1){ ?>
                <li>
                	<a href='users.php?users=1' class='users'><img src='./images/usericon.png'><span>Users</span><blockquote class='blUser'></blockquote></a>
                	<ul>
                    	<li><a href="users.php?users=1" class="">All users</a></li>
                        <li><a href="users.php?users=2" class="">Add users</a></li>
                    </ul>    
                </li>
                <?php } ?>
                <li>
					<a href="booking.php?booking=1" class="booking"><img alt="" src="./images/settingsicon.png"><span>Booking</span></a>
					<ul>
						<li><a href='booking.php?booking=1'>Hotels</a></li>
						<li><a href='booking.php?booking=2'>Add Hotel</a></li>
						<li><a href=''>State</a></li>
						<li><a href=''>Add State</a></li>
						<li><a href=''>Destination</a></li>
						<li><a href=''>Add Destination</a></li>
						<li><a href=''>Reservations</a></li>
					</ul>
				</li>
				<li>
					<a href="settings.php?settings=1" class="settings"><img alt="" src="./images/settingsicon.png"><span>Settings</span></a>
					<ul>
						<li><a href='settings.php?settings=1'>Languages</a></li>
						<li><a href='settings.php?settings=2'>Widgets</a></li>
						<li><a href='users.php?users=2&code=<?php echo $_SESSION['USID']?>'>Accounts</a></li>
					</ul>
				</li>
				<li><a href="help.php" class="Help"><img alt="" src="./images/help.png"><span>Help</span></a></li>
			</ul>	
		</nav>
		
		<div id="mobileNav">
			<ul>
				<li><a href="index.php"><img src="./images/homeicon.png"></a></li>
				<li><a href='users.php'><img src='./images/usericon.png'></a></li>
				<li><a href='reports.php'><img src='./images/reports.png'></a></li>
				<li><a href="settings.php"><img src="./images/settingsicon.png"></a></li>
				<li><a href="help.php"><img src="./images/help.png"></a></li>
			</ul>
		</div>
	</div><!-- Close leftContainer -->
	
</div>

<div id="rightHeader"><!-- Open rightHeader -->
	<a class="linksHead">
		<img alt="" src="images/userIconToOpen.png">                                                                       
		<div id="usersProfile">
				<img alt="" src="images/userProfileImg.png" id="userPrImg">
				<p id="firstP"><?php echo $_SESSION['USNM']; ?></p>
				<p><?php echo $_SESSION['USFN']; ?></p>
				<p><?php echo $_SESSION['USE']; ?></p>
				<p><b><?php echo $_SESSION['USPR']; ?></b></p>
				<a href="settings.php" class="button1">Account</a>
				<a href="control/logout.php" class="button2">Sign Out</a>
		</div>
	</a>
</div><!-- Close rightHeader -->
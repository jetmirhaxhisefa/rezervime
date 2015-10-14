<?php 
// THE SERVER(domain) name  where the files are located
// define('SERVER_NAME',$_SERVER['SERVER_NAME']);
// Define the specific folder where all your web files are located
define('WEB_ROOT','C:\wamp\www\rezervime');
// The root where the model files are located (folder "includes" for example)
//define('MROOT',$_SERVER['DOCUMENT_ROOT']."/IMS/model/");
define('MROOT',WEB_ROOT.'/model/');

require_once(MROOT."database.php");
require_once(MROOT."session.php");
require_once(MROOT."functions.php");
require_once(MROOT."user.php");
require_once(MROOT."privilege.php");
require_once(MROOT."page.php");
require_once(MROOT."language.php");
require_once(MROOT."pageLayout.php");
require_once(MROOT."category.php");
require_once(MROOT."menu.php");
require_once(MROOT."links.php");
require_once(MROOT."post.php");
require_once(MROOT."media.php");
require_once(MROOT."widget.php");
require_once(MROOT."hotel.php");
require_once(MROOT."location.php");
require_once(MROOT."room.php");
require_once(MROOT."visitors.php");

// foreach (glob($_SERVER['DOCUMENT_ROOT']."/fibu/ims/model/*.php") as $filename){
// 	include_once $filename;
// 	echo $filename."<br>";
// }
?>

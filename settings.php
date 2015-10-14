<?php 
	require_once 'model/paths.php';
	$session = new Session();
	if (!$session->isLogin){redirect("login.php");}
	include_once 'includes/header.php';
	$database = new Database();
	$languages = new Language();
	$widget = new Widget();
	$post = new Post();
	$menu = new Menu();
?>
<title id="settings">Settings</title>

<?php 
if(isset($_GET['settings']) && $_GET['settings'] == 1){
	include_once 'includes/languages.php';
}else if(isset($_GET['settings']) && $_GET['settings'] == 2){
	include_once 'includes/widgets.php';
}else{
	redirect("settings.php?settings=1");
}
?>

<script type="text/javascript" src="js/formValidation.js"></script>
<script type="text/javascript" src="js/delete.js"></script>
<?php include_once 'includes/footer.php'; $database->disconnectDb(); ?>
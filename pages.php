<?php 
	require_once 'model/paths.php';
	$session = new Session();
	if (!$session->isLogin){redirect("login.php");}
	include_once 'includes/header.php';
	$database = new Database();
	$page = new Page();
	$language = new Language();
	$pageLayout = new PageLayout();
	$category = new Category();
	$menu = new Menu();
	$links = new Links();
?>
<title id="pages">Pages</title>

<?php 
if(isset($_GET['pages']) && $_GET['pages'] == 1){
	include_once 'includes/allPages.php';
}else if(isset($_GET['pages']) && $_GET['pages'] == 2){
	include_once 'includes/addAndEditPage.php';
}else if(isset($_GET['pages']) && $_GET['pages'] == 3){
	include_once 'includes/pageLayouts.php';
}else if(isset($_GET['pages']) && $_GET['pages'] == 4){
	include_once 'includes/menus.php';
}else if(isset($_GET['pages']) && $_GET['pages'] == 5 && isset($_GET['code']) && $_GET['code'] != NULL){
	include_once 'includes/addAndEditPage.php';
}else{
	redirect("pages.php?pages=1");
}
?>

<script type="text/javascript" src="js/formValidation.js"></script>
<script type="text/javascript" src="js/delete.js"></script>
<?php include_once 'includes/footer.php'; $database->disconnectDb(); ?>
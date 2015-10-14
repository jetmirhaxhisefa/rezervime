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
	$post = new Post();
	$media = new Media();
?>
<title id="posts">Posts</title>

<?php 
if(isset($_GET['posts']) && $_GET['posts'] == 1){
	include_once 'includes/allPosts.php';
}else if(isset($_GET['posts']) && $_GET['posts'] == 2){
	include_once 'includes/addPosts.php';
}else if(isset($_GET['posts']) && $_GET['posts'] == 3){
	include_once 'includes/categories.php';
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
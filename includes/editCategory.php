<?php 
	if(isset($_GET['category'])){
		$categoryId = $database->escapeString($_GET['category']);
		$category->setCategoryId($categoryId);
		$category->getById($database);
	}else{
		redirect("posts.php?posts=3");
	}
?>
<div id="rightContainer"><!-- Open rightContainer -->
	<div id="addPostContainer">
		<form method="post" class="" id="addCategoryForm" action="control/editCategory.php"  enctype="multipart/form-data">
			<table id="addTable">
				<thead>
					<tr>
						<th colspan="2">EDIT CATEGORY</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Category:</td>
						<td><input type="text" placeholder="" class="" value="<?php echo $category->getCategory();?>" name="category" id="category"></td>
					</tr>
					<?php 
					$query = $category->getById($database);
					$result = $query->fetch_assoc();
					foreach($result as $key=>$value){
						if($key == "categoryId" || $key == "category" || $key == "inherit"){
							continue;
						}
						echo "<tr>";
						$name = ucfirst($key);
							echo "<td>{$name}</td>";
							echo "<td><input type='text' value='{$value}' name='$key'></td>";
						echo "</tr>";
					}
					?>
					
					<tr>
						<td id="mediaHolder"></td>
						<td>
							<input type='hidden' value='<?php echo $categoryId; ?>' name='categoryId'>
							<input type='submit' value='Edit' name='submit' id='submitCat' class='submitAdd'>
							<a href="posts.php?posts=1" class="button2" id="cancel">Cancel</a>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
		<div id="requiredFieldsError" class="errorSection">
			<p>Please fill all required fields</p>
		</div>
	</div>
</div><!-- Close rightContainer -->
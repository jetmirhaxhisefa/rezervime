<?php 
	$categoryQuery = $category->getAll($database);
?>
<div id="rightContainer"><!-- Open rightContainer -->
	<div class="tableDiv" id="allUsersTable">
		<table id="tableStyle1" class="allUsersTable">
			<thead>
				<tr>
					<td colspan="7" id="tableSuperHeader">
						<h4>Category table / Nr. of categories : <?php echo mysqli_num_rows($categoryQuery); ?></h4>
						<div class="tableIcons">
							<button id="fullscreenBtn" title="Fullscreen Mode"><img src="images/full-screen.png"></button>
							<button id="minimizeTableBtn"><img src="images/minimize.png"></button>
							<button id="closeTableBtn" title="Close table"><img src="images/x.png"></button>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="7">
						<div id="tableSuperHeaderDiv">
							<form action="">
								<input type="text" class="searchField" name="searchField" placeholder="Search user">
								<input type="submit" value="Search" class="searchButton" id="searchUser">
							</form>
							<a class="button2" id="deleteCategoryBtn">Delete</a>
							<a href="#" class="button1" id="addCatButton">Add category</a>
							<input type="text" class="searchField" id="addCatInput" name="addCatInput" placeholder="Category Name">
							<select id="addCategorySelect">
								<option value='0'>No parent</option>
								<?php
								$catResult = $category->getAllParents($database); 
									while ($row = $catResult->fetch_assoc()) {
										echo "<option value='{$row['categoryId']}'>{$row['category']}</option>";
									}
								?>
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<th class="tikColumn"><center>#</center></th>
					<th>Category</th>
					<th>Parent</th>
				</tr>
			</thead>
			<tbody>
				
					<?php 
						while($row = $categoryQuery->fetch_array()){
							echo "<tr>";
							// tik to delete
							echo "<td class=\"tikColumn\"><input type=\"checkbox\" id=\"{$row['categoryId']}\" class=\"checkForDelete\" name=\"\"></td>";
							
							// Category name with decode for special characters
							$name = utf8_decode($row['category']);
							echo "<td><a href='posts.php?posts=4&category={$row['categoryId']}' class='blueLinks'>{$name}</a></td>";
   							
   							// PARENT
   							if($row['inherit'] != 0){
								$category->setInherit($row['inherit']);
	   							$category->getByParentId($database);
								echo "<td><a class='blueLinks'>{$category->getCategory()}</a></td>";
   							}else{
   								echo "<td><a class='blueLinks'>NO PARENT</a></td>";
   							}
							echo "</tr>";
						}
					?>
			</tbody>
		</table>
	</div>
</div><!-- Close rightContainer -->
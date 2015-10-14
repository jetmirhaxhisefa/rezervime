<?php 
	$postQuery = $post->getAll($database);
?>
<div id="rightContainer"><!-- Open rightContainer -->
	<div class="tableDiv" id="allUsersTable">
		<table id="tableStyle1" class="allPostsTable">
			<thead>
				<tr>
					<td colspan="7" id="tableSuperHeader">
						<h4>Posts table / Nr. of posts : <?php echo mysqli_num_rows($postQuery); ?></h4>
						<div class="tableIcons">
							<button id="fullscreenBtn" title="Fullscreen Mode"><img src="images/full-screen.png"></button>
							<button id="minimizeTableBtn"><img src="images/minimize.png"></button>
							<button id="closeTableBtn" title="Close table"><img src="images/x.png"></button>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="7">
						<label for="pagesPerPost" class="filterPostByPage">Choose page:</label>
						<select name="pagesPerPost" id="pagesPerPost" class="hideShowRowsByPage">
							<?php 
								$res = $page->getAll($database);
								echo "<option value='all'>All</option>";
								while($row = $res->fetch_assoc()){
									echo "<option value='{$row['pageName']}'>{$row['pageName']}</option>";
								}
							?>
						</select>
						<div id="tableSuperHeaderDiv">
							<form action="">
								<input type="text" class="searchField" name="searchField" placeholder="Search user">
								<input type="submit" value="Search" class="searchButton" id="searchUser">
							</form>
							<a class="button2" id="deletePost">Delete</a>
							<a href="posts.php?posts=2" class="button1" id="addPostButton">Add post</a>
						</div>
					</td>
				</tr>
				<tr>
					<th class="tikColumn"><center>#</center></th>
					<th>Title</th>
					<th>Page</th>
				</tr>
			</thead>
			<tbody>
				
					<?php 
						while($row = $postQuery->fetch_array()){
							// Page name with decode for special characters
							$page->setPageId($row['pageId']);
							$page->getById($database);
							$pageName = utf8_decode($page->getPageName());
							
							echo "<tr id='{$row['postId']}' data-pagename='$pageName'>";
							// tik to delete
							echo "<td class=\"tikColumn\"><input type=\"checkbox\" id=\"{$row['postId']}\" class=\"checkForDelete\" name=\"\"></td>";
							
							$title = utf8_decode($row['title']);
							echo "<td><a href='posts.php?posts=2&code={$row['postId']}' class='blueLinks'>{$title}</a></td>";
							
							echo "<td><a href='pages.php?pages=5&code={$row['pageId']}' class='blueLinks'>{$pageName}</a></td>";
							echo "</tr>";
						}
					?>
			</tbody>
		</table>
	</div>
</div><!-- Close rightContainer -->
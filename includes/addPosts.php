<?php 
	if(isset($_GET['code'])){
		$postId = $database->escapeString($_GET['code']);
		$post->setPostId($postId);
		$post->getById($database);
	}
?>
<div id="rightContainer"><!-- Open rightContainer -->
	<div id="addPostContainer">
		<form method="post" class="" id="addPostForm" action="control/createEditPost.php"  enctype="multipart/form-data">
			<table id="addTable">
				<thead>
					<tr>
						<th colspan="2">
						<?php 
						if(isset($_GET['code'])){
							echo "<span>EDIT POST</span>";
						}else{
							echo "<span>ADD POST</span>";
						}
						?>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Post Title:</td>
						<td><input type="text" placeholder="Example: John" class="" value="<?php if(isset($_GET['code'])){echo $post->getTitle();}else{ echo "";} ?>" name="title" id="title"></td>
					</tr>
					<tr>
						<td>Under title:</td>
						<td><input type="text" placeholder="Example: Doe" class="" value="<?php if(isset($_GET['code'])){echo $post->getUnderTitle();}else{ echo "";} ?>" id="undertitle" name="undertitle"></td>
					</tr>
					<tr>
						<td>Page:</td>
						<td>
							<select name="pageId">
								<option value="0">Widget</option>
								<?php 
									$pageResult = $page->getAll($database);
									while($row = $pageResult->fetch_assoc()){
										echo "<option value='{$row['pageId']}' ";
										if(isset($_GET['code']) && $row['pageId'] == $post->getPageId()){
											echo "selected='selected' ";
										}
										echo " >{$row['pageName']}</option>";
									}
									
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Categories:</td>
						<td>
						<?php 
							$result = $category->getAllParents($database);
							while($row = $result->fetch_assoc()){
								echo "<input type='checkbox' value='{$row['categoryId']}' name='categories[]' ";
								if(isset($_GET['code']) && $post->checkIfPostHasCategory($database,$row['categoryId']) == 1){
									echo "checked='checked' ";
								}
								echo ">";
								echo "<label>{$row['category']}</label></br>";
								$category->setInherit($row['categoryId']);
								$subCategorues = $category->getAllByParent($database);
								while($sub = $subCategorues->fetch_assoc()){
									echo "<input type='checkbox' value='{$sub['categoryId']}' name='categories[]' class= 'underCat' ";
									if(isset($_GET['code']) && $post->checkIfPostHasCategory($database,$sub['categoryId']) == 1){
										echo "checked='checked' ";
									}
									echo ">";
									echo "<label>{$sub['category']}</label></br>";
								}
							}
						?>
						</td>
					</tr>
					<tr id='mediaBtnTr'>
						<td style="padding-top: 20px;">Upload images:</td>
						<td style="padding-top: 20px;" id='mediaBtnTd'>
							<a href="#" class="button3" id="addImage">+ Image</a>
							<a href="#" class="button4" id="addYoutube">+ Youtube</a>
						</td>
					</tr>
					
					<tr>
						<td>Content:</td>
						<td><textarea name="body" class="jqte-test"><?php if(isset($_GET['code'])){echo $post->getBody();}else{ echo "";} ?></textarea></td>
					</tr>
					
					<tr>
						<td id="mediaHolder"></td>
						<td>
						<?php 
							if(isset($_GET['code'])){
								echo "<input type='hidden' value='{$postId}' name='postId'>";
								echo "<input type='submit' value='Edit post' name='submit' id='submitPost' class='submitAdd'>";
							}else{
								echo "<input type='submit' value='Create post' name='submit' id='submitPost' class='submitAdd'>";
								
							}
						?>
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
	
	<div id="imagesPreivievWrapper">
		<h3>Media to be uploaded</h3>
		<div id="imagesPreiviev">
			<?php 
			if(isset($_GET['code'])){
				$media->setPostId($postId);
				$resultMedia = $media->getByPostId($database);
				while($row = $resultMedia->fetch_assoc()){
					if($row['type'] == "img"){
						echo "<div class='tmpParentDiv' id='tmpParentDiv{$row['mediaId']}'><span><a href='#' data-mediaId='{$row['mediaId']}' class='removeImg'><img src='images/x.png'></a></span><a href='{$row['large']}' target='_blank'><img src='{$row['thumb']}'></a></div>";
					}else if($row['type'] == "youtube"){
						echo "<div class='tmpParentDiv' id='tmpParentDiv{$row['mediaId']}'><span><a href='#' data-mediaId='{$row['mediaId']}' class='removeImg'><img src='images/x.png'></a></span><iframe width='100%' height='215' src='https://www.youtube.com/embed/{$row['thumb']}'></iframe></div>";
					}
				}
			}
			?>
			
		</div>
	</div>
	
</div><!-- Close rightContainer -->
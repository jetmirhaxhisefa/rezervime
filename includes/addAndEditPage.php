<?php
	if(isset($_GET['code'])){
		$pageIdToEdit = $database->escapeString($_GET['code']);
		$pageToEdit = new Page();
		$pageToEdit->setPageId($pageIdToEdit);
		$pageToEdit->getById($database);
	}
?>
<div id="rightContainer"><!-- Open rightContainer -->
	<div id="addPageContainer">
		<form method="post" class="validateForm" id="" action="control/createPage.php">
			<table id="addTable">
				<thead>
					<tr>
						<th colspan="2">
							<span><?php if(isset($_GET['code'])){ echo "Edit page";}else{ echo "Add page";} ?></span>
							<a href="#" id="properties" class="activeLinkInAdd">Properties</a>
							<a href="#" id="seo">SEO</a>
						</th>
					</tr>
				</thead>
				<tbody class="properties" style="display:table-header-group;">
					<tr>
						<td>Title:</td>
						<td><input type="text" placeholder="Title for the browser title bar" class="validatedInput" name="title" value="<?php if(isset($_GET['code'])){ echo $pageToEdit->getTitle();} ?>"></td>
					</tr>
					<tr>
						<td>Navigation Name :</td>
						<td><input type="text" placeholder="Page name for displaying in navigation" class="validatedInput" name="pageName" value="<?php if(isset($_GET['code'])){ echo $pageToEdit->getPageName();} ?>"></td>
					</tr>
					<tr>
						<td>Page Layout :</td>
						<td>
							<select id="layout" class="validatedInput" name="layout">
								<option value="">Choose layout:</option>
								<?php 
									$result = $pageLayout->getAll($database);
									while ($row = $result->fetch_assoc()){
										echo "<option value='{$row['pageLayoutId']}' "; 
										if(isset($_GET['code']) && $row['pageLayoutId'] == $pageToEdit->getPageLayoutId()){
											echo "selected='selected'";
										}
										echo "data-layoutimgurl='{$row['image']}'>{$row['name']}</option>";
									}
								?>
							</select>
						</td>
					</tr>
				</tbody>
				
				<tbody class="seo">
					<tr>
						<td>URL display:</td>
						<td><input type="text" placeholder="Example: john-says-we-are-not-alone" name="urlTag" value="<?php if(isset($_GET['code'])){ echo $pageToEdit->getUrlTag(); } ?>"></td>
					</tr>
					<tr>
						<td>Meta description:</td>
						<td><textarea placeholder="Example: This is 'CompanyName' best work" name="metaDesc"><?php if(isset($_GET['code'])){ echo $pageToEdit->getMetaDesc(); } ?></textarea></td>
					</tr>
					<tr>
						<td>Meta keywords:</td>
						<td><textarea placeholder="Example: HTML, CSS, PHP, JAVA, SERVERS" name="metaKeywords"><?php if(isset($_GET['code'])){ echo $pageToEdit->getMetaKeywords();} ?></textarea></td>
					</tr>
				</tbody>
				
				<tbody id="addBtn" style="display: table-header-group;">
					<tr>
						<td></td>
						<td>
							<?php if(isset($_GET['code'])){ echo "<input type='hidden' value='{$pageToEdit->getPageId()}' name='pageId' >"; } ?>
							<input type="submit" value="Save" name="submitPage" id="submitAddPage" class="validatedSubmit submitAdd">
							<input type="submit" value="Save & Publish" name="submitPage" id="submitAddPage" class="validatedSubmit button3 submitAndPublishPage">
							<a href="pages.php?pages=1" class="button2" id="cancel">Cancel</a>							
						</td>
					</tr>
				</tbody>
			</table>
		</form>
		<div id="requiredFieldsError" class="errorSection">
			<p>Please fill all required fields</p>
		</div>
	</div>
	
	<div class="infoSection" id="noticeAddUsers">
		<h5>Notice</h5>
		<p>
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent gravida eros sit amet tortor euismod blandit. 
			Vivamus ut elit id diam aliquet feugiat sed quis ante. Mauris bibendum finibus nibh, vel convallis ex volutpat eu. 
		</p>
	</div>
	
	<div class="infoSection" id="infoAddUsers">
		<h5>Information</h5>
		<p>
			<?php 
				if(isset($_GET['code'])){
					$pageLayout->setPageLayoutId($pageToEdit->getPageLayoutId());
					$pageLayout->getById($database);
					echo "<img src='{$pageLayout->getImage()}' style='display:block;' >";
				}else{
					echo "<img src='' >";
				}
			?>
		</p>
	</div>
	
</div><!-- Close rightContainer -->
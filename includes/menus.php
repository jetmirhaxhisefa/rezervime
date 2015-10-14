<?php 
	if(isset($_GET['menu']) && $_GET['menu'] != null){
		$menuId = $database->escapeString($_GET['menu']);
	}else{
		$menuId = $menuId = $menu::getMainMenuId($database);
	}
?>

<div id="rightContainer"><!-- Open rightContainer -->
	<div id="menusNavigation"><!-- Open menusNavigation -->
		<form>
			<label for="menusNavToEdit">Select menu to edit:</label>
			<select id="menuChange">
				<?php 
					$menuRes = $menu->getAll($database);
					$parentLinkName = "";
					while ($row = $menuRes->fetch_assoc()){
						if($row['parentLinkId'] != 0 && $row['parentLinkId'] != ""){
							$links->setLinkId($row['parentLinkId']);
							$links->getById($database);
							$parentLinkName = " (SUB OF: ".$links->getAppearName().")";
						}else{
							$parentLinkName = "";
						}
						echo "<option value='{$row['menuId']}' ";
						if($row['menuId'] == $menuId){
							echo "selected='selected'";
						}
						echo ">{$row['title']}{$parentLinkName}</option>";
					}
				?>
			</select>
		</form>
		<a href="#" class="button3" id="createMenu">Create Menu</a>
	</div><!-- Close menusNavigation -->
	
	<div class="clear"></div>
	
	<div id="menuEditContainer"><!-- Open menuEditContainer -->
		<div id="addPageToMenuWrapper"><!-- Open addPageToMenuContainer -->
			<div class="addPageToMenuContainer"><!-- Open addPageToMenuContainer -->
				<h3 class="activeH3">Pages</h3>
				<div>
					<ul>
						<?php 
							$result = $page->getAll($database);
							while ($row = $result->fetch_assoc()){
								echo "<li><a><input type='checkbox' class='pages' data-pagename ='{$row['pageName']}' value='{$row['pageId']}'> {$row['pageName']} </a></li>";		
							}
						?>
					</ul>
				</div>
			</div><!-- Close addPageToMenuContainer -->
			<div class="addPageToMenuContainer"><!-- Open addPageToMenuContainer -->
				<h3>Custom links</h3>
				<div>
					<ul>
						<input type="text" placeholder="http://" value="http://" id="customLinkName">
					</ul>
				</div>
			</div><!-- Close addPageToMenuContainer -->
			<div class="addPageToMenuContainer"><!-- Open addPageToMenuContainer -->
				<h3>Categories</h3>
				<div>
					<ul>
						<?php 
							$catResult = $category->getAll($database);
							while ($row = $catResult->fetch_assoc()){
								echo "<li><a href='#'><input type='checkbox' class='category' data-categoryname ='{$row['category']}' value='{$row['categoryId']}'> {$row['category']} </a></li>";
							}
						?>
					</ul>
				</div>
			</div><!-- Close addPageToMenuContainer -->
			<div class="addToMenuBtnBlock">
				<input type="text" placeholder="Link appear name in navigation" id="appearName">
				<a href="#" class="button5" id="addToMenuBtn">Add to menu</a>
				<div class="clear"></div>
			</div>
		</div><!-- Close addPageToMenuContainer -->
		
		<div id="customizeMenu"><!-- Open customizeMenu -->
			<div id='header'>
				<form>
					<label for="menuTitle">Menu name:</label>
					<?php if($menuId != 0){$menu->setMenuId($menuId); $menu->getMenuById($database); }?>
					<input type="hidden" name="menuId" id="menuId" value="<?php echo $menu->getMenuId(); ?>">
					<input type="text" name="menuTitle" id="menuTitle" value="<?php echo $menu->getTitle(); ?>">
				</form>
				<a href="#" class="button1 saveMenu" id="saveMenu">Save</a>
			</div>
			<div id="menuStructure">
				<h3>Menu Structure</h3>
				<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce pulvinar lacus sed commodo egestas. 
					Maecenas vel ligula ligula. Vestibulum sit amet tincidunt purus. In et pulvinar est.
				</p>
				<div id="menuLinks">
					<ul>
						<?php 
						if($menuId != 0){
							$links->setMenuId($menuId);
							$linksRes = $links->getAllLinks($database);
							while($row = $linksRes->fetch_assoc()){
								if($row['pageId'] != 0){
									$page->setPageId($row['pageId']);
									$page->getById($database);
									$name = $page->getPageName();
								}else if($row['categoryId'] != 0){
									$category->setCategoryId($row['categoryId']);
									$category->getById($database);
									$name = $category->getCategory();
								}else{
									$name = "Custom link";
								}
								if($menu::checkParent($database, $row['linkId']) != 0){
									$menu->getByParent($database, $row['linkId']);
									$subMenu = " -- SUB : ".$menu->getTitle();
								}else{
									$subMenu = "";
								}
								echo "
								<li>
									<div id='{$row['linkId']}'>
										<span id='nameContainer'>{$row['appearName']}</span>
										<span id='btnContainer'>
											<buton title='Create sub menu' class='makeUnder' id='{$row['linkId']}' >U</buton>
											<buton class='down'></buton>
											<buton class='up'></buton>
										</span>
										<blockquote>( Name: {$name}{$subMenu} )</blockquote>
									</div>
								</li>";
							}
							
						}
						?>
						
					</ul>
				</div>
				<div id="isNav">
					<h3>Menu settings</h3>
					<?php 
					if($menuId != 0){
						$isMain = $menu::getThisMenuId($database,$menuId);
						echo "<input type='checkbox' id='isMain' value='1' ";
						if($isMain){
							echo "checked='checked'";
						}
						echo ">";
					}
					?>
					<label>Theme navigation bar</label>
				</div>
			</div>
			<div id="updateAndDeleteBtnBlock">
				<a href="control/deleteMenu.php?menuid=<?php echo $menuId; ?>" id="deleteMenu">Delete this menu</a>
				<a href="#" class="button1 saveMenu" id="saveMenu">Save</a>
				<div class="clear"></div>
			</div>
		</div><!-- Close customizeMenu -->
		<div class="clear"></div>
	</div><!-- Close menuEditContainer -->
</div><!-- Close rightContainer -->

<div id="removeLinkContainer">
	<img alt="" src="images/removeLinkIcon.png" id="removeLinkIcon">
</div>

<div id="createMenuWrapper"><!-- createMenuWrapper -->
	<div id="createMenuContainer"><!-- createMenuContainer -->
		<form action="control/addMenu.php" method="post">
			<label for="menuName">Menu name:</label>
			<input type="text" name="menuName">
			<label for="description">Description:</label>
			<input type="text" name="description">
			<label for="language">Language:</label>
			<select name="language" id="language">
				
				<?php 
					$langResult = $language->getAll($database);
					while ($row = $langResult->fetch_assoc()){
						echo "<option value='{$row['langId']}'>{$row['langName']}</option>";						
					}
				?>
			</select>
			<input type="hidden" name="parent" value="" id='parentForSub'>
			<a href="#" class="button4" id="cancelAddMenu">Cancel</a>
			<input type="submit" value="Submit" name="addMenuBtn" id="addMenuBtn">
			<div class="clear"></div>
		</form>
	</div><!-- createMenuContainer -->
</div><!-- createMenuWrapper -->

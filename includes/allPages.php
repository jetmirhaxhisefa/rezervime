<?php 
	$pageQuery = $page->getAll($database);
?>
<div id="rightContainer"><!-- Open rightContainer -->
	<div class="tableDiv" id="allUsersTable">
		<table id="tableStyle1" class="allUsersTable">
			<thead>
				<tr>
					<td colspan="7" id="tableSuperHeader">
						<h4>Navigation Pages table / Nr. of pages : <?php echo mysqli_num_rows($pageQuery); ?></h4>
						<div class="tableIcons">
							<button id="fullscreenBtn" title="Fullscreen Mode"><img src="images/full-screen.png"></button>
							<button id="minimizeTableBtn"><img src="images/minimize.png"></button>
							<button id="closeTableBtn" title="Close table"><img src="images/x.png"></button>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="7">
						<label for="rowGroup" class="rowGropuLabel">Row group:</label>
						<select name="rowGroup" id="rowGroup" class="hideShowRows"></select>
						<label for="showNrOfRows" class="rowGropuLabel">Number of rows:</label>
						<select name="showNrOfRows" id="showNrOfRows" class="hideShowRows">
							<option value="20">20</option>
							<option value="50">50</option>
							<option value="100">100</option>
							<option value="9999999999">All</option>
						</select>
						<div id="tableSuperHeaderDiv">
							<form action="">
								<input type="text" class="searchField" name="searchField" placeholder="Search user">
								<input type="submit" value="Search" class="searchButton" id="searchUser">
							</form>
							<a class="button2" id="deletePage">Delete</a>
							<a href="pages.php?pages=2" class="button1" id="addUserButton">Add page</a>
						</div>
					</td>
				</tr>
				<tr>
					<th class="tikColumn"><center>#</center></th>
					<th>Page Name</th>
					<th>Visibility</th>
				</tr>
			</thead>
			<tbody>
				
					<?php 
						while($row = $pageQuery->fetch_array()){
							echo "<tr>";
							// tik to delete
							echo "<td class=\"tikColumn\"><input type=\"checkbox\" id=\"{$row['pageId']}\" class=\"checkForDelete\" name=\"\"></td>";
							
							// Page name with decode for special characters
							$name = utf8_decode($row['pageName']);
							echo "<td><a href='pages.php?pages=5&code={$row['pageId']}' class='blueLinks'>{$name}</a></td>";

   							
   							// Visibility
							echo "<td><a href=\"control/hidePage.php?page={$row['pageId']}&active={$row['visibility']}\" class=\"blueLinks\">";
							if($row['visibility'] == true){
								echo "Hide";
							}else{
								echo "Show";
							}
							echo "</a></td>";
							echo "</tr>";
						}
					?>
			</tbody>
		</table>
	</div>
</div><!-- Close rightContainer -->
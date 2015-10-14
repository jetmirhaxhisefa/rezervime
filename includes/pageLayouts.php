<?php 
	$pageLayoutQuery = $pageLayout->getAll($database);
?>
<div id="rightContainer"><!-- Open rightContainer -->
	<div class="tableDiv" id="pageLayouts">
		<table id="tableStyle1" class="pageLayoutsTable">
			<thead>
				<tr>
					<td colspan="7" id="tableSuperHeader">
						<h4>Navigation Page Layout table / Nr. of pages layouts : <?php echo mysqli_num_rows($pageLayoutQuery); ?></h4>
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
							<a class="button2" id="deletePageLayout">Delete</a>
							<a href="control/refreshLayouts.php" class="button1" id="addPageLayout">Refresh</a>
						</div>
					</td>
				</tr>
				<tr>
					<th class="tikColumn"><center>#</center></th>
					<th>Page Name</th>
					<th>Image</th>
				</tr>
			</thead>
			<tbody>
				
					<?php 
						while($row = $pageLayoutQuery->fetch_array()){
							echo "<tr>";
							// tik to delete
							echo "<td class=\"tikColumn\"><input type=\"checkbox\" id=\"{$row['pageLayoutId']}\" class=\"checkForDelete\" name=\"\"></td>";
							
							// Page name with decode for special characters
							$name = utf8_decode($row['name']);
							echo "<td><a href='#' class='blueLinks'>{$name}</a></td>";

   							
   							// Visibility
							echo "<td><a href='{$row['image']}' target='_blank' class=\"blueLinks\"><img src='{$row['image']}'></a></td>";
							echo "</tr>";
						}
					?>
			</tbody>
		</table>
	</div>
</div><!-- Close rightContainer -->

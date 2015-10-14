<?php 
	$languageQuery = $languages->getAll($database);
?>
<div id="rightContainer"><!-- Open rightContainer -->
	<div class="tableDiv" id="allUsersTable">
		<table id="tableStyle1" class="allUsersTable">
			<thead>
				<tr>
					<td colspan="7" id="tableSuperHeader">
						<h4>Languages table / Nr. of languages : <?php echo mysqli_num_rows($languageQuery); ?></h4>
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
							<a class="button2" id="deleteLanguageBtn">Delete</a>
							<a href="#" class="button1" id="addLangButton">Add language</a>
							<input type="text" class="searchField" id="addLangInput" name="addLangInput" placeholder="Language">
						</div>
					</td>
				</tr>
				<tr>
					<th class="tikColumn"><center>#</center></th>
					<th>Language</th>
					<th>Default</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				
					<?php 
						while($row = $languageQuery->fetch_array()){
							echo "<tr>";
							// tik to delete
							echo "<td class=\"tikColumn\"><input type=\"checkbox\" id=\"{$row['langId']}\" class=\"checkForDelete\" name=\"\"></td>";
							
							// Category name with decode for special characters
							$name = utf8_decode($row['langName']);
							echo "<td><a class='blueLinks'>{$name}</a></td>";
							if($row['default'] == 1){$default = "Default";}else{$default = "";}
							echo "<td><a>$default</a></td>";
							echo "<td><a href='control/makeLangDefault.php?langId={$row['langId']}' class='button5'>Make Default</a></td>";
							echo "</tr>";
						}
					?>
			</tbody>
		</table>
	</div>
</div><!-- Close rightContainer -->
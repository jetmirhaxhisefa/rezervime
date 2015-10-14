<?php
	$userQuery = $user->getAll($database);
?>
<div id="rightContainer"><!-- Open rightContainer -->
	<div class="tableDiv" id="allUsersTable">
		<table id="tableStyle1" class="allUsersTable">
			<thead>
				<tr>
					<td colspan="7" id="tableSuperHeader">
						<h4>Users table / Nr. of users : <?php echo mysqli_num_rows($userQuery); ?></h4>
						<div class="tableIcons">
							<button id="fullscreenBtn" title="Fullscreen Mode"><img src="images/full-screen.png"></button>
							<button id="minimizeTableBtn"><img src="images/minimize.png"></button>
							<button id="closeTableBtn" title="Close table"><img src="images/x.png"></button>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="6">
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
							<a class="button2" id="deleteUserButton">Delete</a>
							<a href="users.php?users=2" class="button1" id="addUserButton">Add user</a>
						</div>
					</td>
				</tr>
				<tr>
					<th class="tikColumn"><center>#</center></th>
					<th>Name</th>
					<th>Username</th>
					<th>User privilege</th>
					<th>Email</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				
					<?php 
						while($row = $userQuery->fetch_array()){
							echo "<tr>";
							$privRes = $privilege->getAll();
							echo "<td class=\"tikColumn\"><input type=\"checkbox\" id=\"{$row['userId']}\" class=\"checkForDelete\" name=\"\"></td>";
							$name = utf8_decode($row['name']);
							$lastname = utf8_decode($row['lastName']);
							echo "<td><a href='users.php?users=2&code={$row['userId']}' class='blueLinks'>{$name} {$lastname}</a></td>";
							echo "<td>{$row['username']}</td>";
							echo "<td><select class='changePriDropDown'>";
							while ($p = $privRes->fetch_assoc()){
								echo "<option value='{$p['privilegeId']}' data-code='{$row['userId']}'";
								if($row['privilegeId'] == $p['privilegeId']){
									echo "selected='selected'";
								}
								echo ">{$p['privilege']}</option>";
							}
							echo "</select></td>";
							echo "<td>{$row['email']}</td>";
							echo "<td><a href=\"control/enableDisableUser.php?user={$row['userId']}&active={$row['active']}\" class=\"blueLinks\">";
							if($row['active'] == true){
								echo "Disable";
							}else{
								echo "Enable";
							}
							echo "</a></td>";
							echo "</tr>";
						}
					?>
			</tbody>
		</table>
	</div>
</div><!-- Close rightContainer -->
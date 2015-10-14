<?php 
	if(isset($_GET['code'])){
		$userId = $database->escapeString($_GET['code']);
		$user->setId($userId);
		$user->getById($database);
	}
?>
<div id="rightContainer"><!-- Open rightContainer -->
	<div id="addUserContainer">
		<form method="post" class="validateForm" id="addUserForm">
			<table id="addTable">
				<thead>
					<tr>
						<th colspan="2">
						<?php 
						if(isset($_GET['code'])){
							echo "<span>EDIT USER</span>";
						}else{
							echo "<span>ADD USER</span>";
						}
						?>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Name:</td>
						<td><input type="text" placeholder="Example: John" class="validatedInput" id="name" value="<?php if(isset($_GET['code'])){echo $user->getName();}else{ echo "";}?>"></td>
					</tr>
					<tr>
						<td>Lastname:</td>
						<td><input type="text" placeholder="Example: Doe" class="validatedInput" id="lastname" value="<?php if(isset($_GET['code'])){echo $user->getLastname();}else{ echo "";}?>"></td>
					</tr>
					<tr>
						<td>Username:</td>
						<td><input type="text" placeholder="Example: johndoe" class="validatedInput" id="username" value="<?php if(isset($_GET['code'])){echo $user->getUsername();}else{ echo "";}?>"></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><input type="password" placeholder="" class="validatedInput" id="password"></td>
					</tr>
					<tr>
						<td>Confirm Password:</td>
						<td><input type="password" placeholder="" class="validatedInput" id="confpassword"></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><input type="email" placeholder="john.doe@mydomain.com" class="validatedInput" id="email" value="<?php if(isset($_GET['code'])){echo $user->getEmail();}else{ echo "";}?>"></td>
					</tr>
					<tr>
						<td>User privilege:</td>
						<td>
							<select id="privilege">
								<?php 
									$privilegeAll = $privilege->getAll();
									while ($row = $privilegeAll->fetch_array()){
										if($row['privilegeId'] == 1 && $_SESSION['USPRID'] >= 2){
											continue;
										}
										echo "<option data-id = \"{$row['privilegeId']}\" ";
										if(isset($_GET['code']) && $row['privilegeId'] == $user->getPrivilegeId()){
											echo "selected='selected'";
										}
										echo " >{$row['privilege']}</option>";
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<?php 
							if(isset($_GET['code'])){
								echo "<input type='hidden' value='$userId' name='userId' id='userId'>";
								echo "<input type='submit' value='Edit user' name='submit' id='submitUser' class='validatedSubmit submitAdd'>";
							}else{
								echo "<input type='submit' value='Add user' name='submit' id='submitUser' class='validatedSubmit submitAdd'>";	
							}
							?>
							
							<a href="users.php?users=1" class="button2" id="cancel">Cancel</a>							
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
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent gravida eros sit amet tortor euismod blandit. 
			Vivamus ut elit id diam aliquet feugiat sed quis ante. Mauris bibendum finibus nibh, vel convallis ex volutpat eu. 
			Curabitur quis risus hendrerit, fringilla odio id, elementum mi. Sed non orci vitae eros interdum congue eu eget eros. 
			Fusce non purus ornare purus interdum blandit et at diam. Nunc vitae elit dolor. 
			<br><br>
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent gravida eros sit amet tortor euismod blandit. 
			Vivamus ut elit id diam aliquet feugiat sed quis ante. Mauris bibendum finibus nibh, vel convallis ex volutpat eu. 
			Curabitur quis risus hendrerit, fringilla odio id, elementum mi. Sed non orci vitae eros interdum congue eu eget eros. 
			Fusce non purus ornare purus interdum blandit et at diam. Nunc vitae elit dolor. 
			<br><br>
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent gravida eros sit amet tortor euismod blandit. 
			Vivamus ut elit id diam aliquet feugiat sed quis ante. Mauris bibendum finibus nibh, vel convallis ex volutpat eu. 
			Curabitur quis risus hendrerit, fringilla odio id, elementum mi. Sed non orci vitae eros interdum congue eu eget eros. 
			Fusce non purus ornare purus interdum blandit et at diam. Nunc vitae elit dolor. 
		</p>
	</div>
	
</div><!-- Close rightContainer -->
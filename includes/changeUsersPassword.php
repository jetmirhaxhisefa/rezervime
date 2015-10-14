<div id="rightContainer"><!-- Open rightContainer -->
	<div id="reportsContainer"><!-- Open reportsContainer -->
				<form method="post" action="control/changeUsersPassword.php" class="" id="addDepForm"> 
					<table id="uploadCsvTable">
						<tbody>
							<tr>
								<th colspan="2">Password Reset</th>
							</tr>
							<tr>
								<td>New password :</td>
								<td>
									<input type="password" name="newPass" value="">
								</td>
							</tr>
							<tr>
								<td>Confirm password :</td>
								<td>
									<input type="password" name="confPass" value="">
									<input type="hidden" name="code" value="<?php echo $_GET['code']?>">
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<input type="submit" value="Change" name="submit" id="submitUpload">
								</td>
							</tr>
						</tbody>
					</table>
				</form>
	
	</div><!-- Close reportsContainer -->
</div><!-- Close rightContainer -->
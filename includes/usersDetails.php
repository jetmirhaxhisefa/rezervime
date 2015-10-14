<?php 
if (isset($_GET['code']) && $_GET['code'] != null){
	$userId = $database->escapeString($_GET['code']);
}else{
	redirect("users.php?users=1");
}
?>
<div id="rightContainer"><!-- Open rightContainer -->
	<div class="tableDiv">
		<table id="tableStyle2">
			<thead>
				<tr style="background-color: #FFF">
					<td colspan="2">
						<div id="tableSuperHeaderDiv">
							<h4 style="margin-top:17px;">User Details</h4>	
							<a href="users.php?users=4&code=<?php echo $userId; ?>" class="button4 floatRight">Change Password</a>
						</div>
					</td>
				</tr>
			</thead>
			<tbody>
				<tr style="background-color: #FFF">
					<th>Key</th>
					<th>Information</th>
				</tr>
				
				<?php 
					$user->setId($userId);
					$result = $user->getById($database);
					while($row = $result->fetch_assoc()){
						$count = 0;
						foreach ($row as $key => $value){
							if($key != "password"){
								echo "<tr>";
								echo "<td>".$key."</td>";
								echo "<td>{$value}</td>";
								echo "</tr>";
							}
						}
					}
				?>
			</tbody>
		</table>
	</div>	
</div><!-- Close rightContainer -->
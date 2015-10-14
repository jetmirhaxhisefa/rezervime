<?php
if(isset($_GET['hotel'])){
	$hotelId = $database->escapeString($_GET['hotel']);
	$room->setHotelId($hotelId);
	$roomQuery = $room->getByHotelId($database);
}else{
	redirect("bookink.php?booking=1");
} 
?>
<div id="rightContainer"><!-- Open rightContainer -->
	<div class="tableDiv" id="allUsersTable">
		<table id="tableStyle1" class="allUsersTable">
			<thead>
				<tr>
					<td colspan="7" id="tableSuperHeader">
						<h4>Room table / Nr. of rooms : <?php echo mysqli_num_rows($roomQuery); ?></h4>
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
							<a class="button2" id="deleteHotel">Delete</a>
							<a href="booking.php?booking=3&hotel=<?php echo $hotelId; ?>" class="button1" id="addPostButton">Add room</a>
						</div>
					</td>
				</tr>
				<tr>
					<th class="tikColumn"><center>#</center></th>
					<th>Room Name</th>
					<th>Persons</th>
					<th>Availabe Until</th>
					<th>Price</th>
				</tr>
			</thead>
			<tbody>
				
					<?php 
						while($row = $roomQuery->fetch_array()){
							echo "<tr>";
							// tik to delete
							echo "<td class=\"tikColumn\"><input type=\"checkbox\" id=\"{$row['roomId']}\" class=\"checkForDelete\" name=\"\"></td>";
							
							// hotel name with decode for special characters
							$title = utf8_decode($row['roomName']);
							echo "<td><a href='booking.php?booking=3&hotel={$hotelId}&code={$row['roomId']}' class='blueLinks'>{$title}</a></td>";
							
							echo "<td>{$row['persons']}</td>";
							echo "<td>{$row['availableUntil']}</td>";
							echo "<td>{$row['price']}</td>";
   							
							echo "</tr>";
						}
					?>
			</tbody>
		</table>
	</div>
</div><!-- Close rightContainer -->
<?php 
	if(isset($_GET['hotel'])){
		$hotelId = $database->escapeString($_GET['hotel']);
	}else{
		redirect("bookink.php?booking=1");
	}
	if(isset($_GET['code'])){
		$roomId = $database->escapeString($_GET['code']);
		$room->setRoomId($roomId);
		$room->getById($database);
	}
?>
<div id="rightContainer"><!-- Open rightContainer -->
	<div id="addPostContainer">
		<form method="post" class="" id="addPostForm" action="control/createAndEditRoom.php"  enctype="multipart/form-data">
			<table id="addTable">
				<thead>
					<tr>
						<th colspan="2">
						<?php 
						if(isset($_GET['code'])){
							echo "<span>EDIT HOTEL</span>";
						}else{
							echo "<span>ADD ROOM</span>";
						}
						?>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Room Name:</td>
						<td><input type="text" placeholder="Example: John's Hotel" class="" value="<?php if(isset($_GET['code'])){echo $room->getRoomName();}else{ echo "";} ?>" name="name" id="name"></td>
					</tr>
					<tr>
						<td>Price:</td>
						<td><input type="number" placeholder="Example: 30&#8364;" class="" value="<?php if(isset($_GET['code'])){echo $room->getPrice();}else{ echo "";} ?>" id="price" name="price"></td>
					</tr>
					<tr>
						<td>Persons:</td>
						<td><input type="number" placeholder="Example: 5" class="" value="<?php if(isset($_GET['code'])){echo $room->getPersons();}else{ echo "";} ?>" id="persons" name="persons"></td>
					</tr>
					<tr>
						<td>Is Available:</td>
						<td>
							<input type="radio" value='1' <?php if(isset($_GET['code']) && $room->getIsAvailable() == 1){echo "checked='checked'";}?> name='isAvailable'>
							<label>Yes</label>
							<br>
							<input type='radio' value='0' <?php if(isset($_GET['code']) && $room->getIsAvailable() == 0){echo "checked='checked'";}?> name='isAvailable'>
							<label>No</label>
						</td>
					</tr>
					<tr>
						<td>Available Until:</td>
						<td>
							<input type="text" value="<?php if(isset($_GET['code'])){echo $room->getAvailableUntil();}else{ echo "";} ?>" name="availableUntil" placeholder="month/day/year"  id="datepicker">
						</td>
					</tr>
					<tr id='mediaBtnTr'>
						<td style="padding-top: 20px;">Upload images:</td>
						<td style="padding-top: 20px;" id='mediaBtnTd'>
							<a href="#" class="button3" id="addImage">+ Image</a>
							<!--- <a href="#" class="button4" id="addYoutube">+ Youtube</a> -->
						</td>
					</tr>
					
					<tr>
						<td>Description:</td>
						<td><textarea name="description" class="jqte-test"><?php if(isset($_GET['code'])){echo $room->getDescription();}else{ echo "";} ?></textarea></td>
					</tr>
					
					<tr>
						<td id="mediaHolder"></td>
						<td>
						<?php 
							if(isset($_GET['code'])){
								echo "<input type='hidden' value='{$roomId}' name='roomId'>";
								echo "<input type='submit' value='Edit room' name='submit' id='submitPost' class='submitAdd'>";
							}else{
								echo "<input type='hidden' value='{$hotelId}' name='hotelId'>";
								echo "<input type='submit' value='Create room' name='submit' id='submitRoom' class='submitAdd'>";
								
							}
						?>
							<a href="booking.php?booking=4" class="button2" id="cancel">Cancel</a>							
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
	
	<div id="imagesPreivievWrapper">
		<h3>Media to be uploaded</h3>
		<div id="imagesPreiviev">
			<?php 
			if(isset($_GET['code'])){
				$media->setRoomId($roomId);
				$resultMedia = $media->getByRoomId($database);
				while($row = $resultMedia->fetch_assoc()){
					echo "<div class='tmpParentDiv' id='tmpParentDiv{$row['id']}'><span><a href='#' data-mediaId='{$row['id']}' class='removeHotelImg'><img src='images/x.png'></a></span><a href='{$row['large']}' target='_blank'><img src='{$row['thumb']}'></a></div>";
				}
			}
			?>
			
		</div>
	</div>
	
</div><!-- Close rightContainer -->
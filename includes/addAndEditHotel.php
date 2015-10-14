<?php 
	if(isset($_GET['code'])){
		$hotelId = $database->escapeString($_GET['code']);
		$hotel->setHotelId($hotelId);
		$hotel->getById($database);
	}
?>
<div id="rightContainer"><!-- Open rightContainer -->
	<div id="addPostContainer">
		<form method="post" class="" id="addPostForm" action="control/createAndEditHotel.php"  enctype="multipart/form-data">
			<table id="addTable">
				<thead>
					<tr>
						<th colspan="2">
						<?php 
						if(isset($_GET['code'])){
							echo "<span>EDIT HOTEL</span>";
						}else{
							echo "<span>ADD Hotel</span>";
						}
						?>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Hotel Name:</td>
						<td><input type="text" placeholder="Example: John's Hotel" class="" value="<?php if(isset($_GET['code'])){echo $hotel->getHotelName();}else{ echo "";} ?>" name="name" id="name"></td>
					</tr>
					<tr>
						<td>Address:</td>
						<td><input type="text" placeholder="Example: My Address" class="" value="<?php if(isset($_GET['code'])){echo $hotel->getAddress();}else{ echo "";} ?>" id="address" name="address"></td>
					</tr>
					<tr>
						<td>Stars:</td>
						<td>
							<select name="stars">
								<option value="1" <?php if(isset($_GET['code'])){if($hotel->getStars() == 1){ echo "selected='selected'";}} ?>>1 Star</option>
								<option value="2" <?php if(isset($_GET['code'])){if($hotel->getStars() == 2){ echo "selected='selected'";}} ?>>2 Star</option>
								<option value="3" <?php if(isset($_GET['code'])){if($hotel->getStars() == 3){ echo "selected='selected'";}} ?>>3 Star</option>
								<option value="4" <?php if(isset($_GET['code'])){if($hotel->getStars() == 4){ echo "selected='selected'";}} ?>>4 Star</option>
								<option value="5" <?php if(isset($_GET['code'])){if($hotel->getStars() == 5){ echo "selected='selected'";}} ?>>5 Star</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Location:</td>
						<td>
							<select name="location">
								<?php 
								$stateArray = $location->getAllStates($database);
								while ($state = $stateArray->fetch_assoc()){
									echo "<optgroup label='{$state['state']}'></optgroup>";
									$destinationArray =  $location::getAllDestinationPerLocation($database, $state['stateId']);
									while($des = $destinationArray->fetch_assoc()){
										echo "<option value='{$des['cityId']}'>{$des['cityName']}</option>";
										
									}	
								}
								?>
							</select>
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
						<td><textarea name="description" class="jqte-test"><?php if(isset($_GET['code'])){echo $hotel->getDescription();}else{ echo "";} ?></textarea></td>
					</tr>
					
					<tr>
						<td id="mediaHolder"></td>
						<td>
						<?php 
							if(isset($_GET['code'])){
								echo "<input type='hidden' value='{$hotelId}' name='hotelId'>";
								echo "<input type='submit' value='Edit hotel' name='submit' id='submitPost' class='submitAdd'>";
							}else{
								echo "<input type='submit' value='Create hotel' name='submit' id='submitHotel' class='submitAdd'>";
								
							}
						?>
							<a href="booking.php?booking=1" class="button2" id="cancel">Cancel</a>							
						</td>
					</tr>
				</tbody>
			</table>
		</form>
		<?php if(isset($_GET['code'])){?>
		<div id="" class="fromExtraSection">
			<a href="booking.php?booking=4&hotel=<?php echo $hotelId;?>" class="blueLinks">Go to rooms</a>
			<a href="booking.php?booking=3&hotel=<?php echo $hotelId;?>" class="blueLinks">Add room</a>
		</div>
		<?php }?>
	</div>
	
	<div id="imagesPreivievWrapper">
		<h3>Media to be uploaded</h3>
		<div id="imagesPreiviev">
		<?php 
			if(isset($_GET['code'])){
				$media->setHotelId($hotelId);
				$resultMedia = $media->getByHotelId($database);
				while($row = $resultMedia->fetch_assoc()){
					if($row['type'] == "img"){
						echo "<div class='tmpParentDiv' id='tmpParentDiv{$row['imgId']}'><span><a href='#' data-mediaId='{$row['imgId']}' class='removeImg'><img src='images/x.png'></a></span><a href='{$row['large']}' target='_blank'><img src='{$row['thumb']}'></a></div>";
					}else if($row['type'] == "youtube"){
						echo "<div class='tmpParentDiv' id='tmpParentDiv{$row['imgId']}'><span><a href='#' data-mediaId='{$row['imgId']}' class='removeImg'><img src='images/x.png'></a></span><iframe width='100%' height='215' src='https://www.youtube.com/embed/{$row['thumb']}'></iframe></div>";
					}
				}
			}
			?>
			
		</div>
	</div>
	
</div><!-- Close rightContainer -->
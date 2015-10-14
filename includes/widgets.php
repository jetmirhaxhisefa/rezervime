<?php 
	$widgetQuery = $widget->getAll($database);
?>
<div id="rightContainer"><!-- Open rightContainer -->
	<div class="tableDiv" id="allUsersTable">
		<table id="tableStyle1" class="allUsersTable">
			<thead>
				<tr>
					<td colspan="7" id="tableSuperHeader">
						<h4>Widget table / Nr. of widgets : <?php echo mysqli_num_rows($widgetQuery); ?></h4>
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
							<a class="button2" id="deleteWidgetBtn">Delete</a>
							<a href="#" class="button1" id="addWidgetButton">Add widget</a>
							<input type="number" class="searchField" id="addWidgetInput" name="addWidgetInput" placeholder="Widget ID">
						</div>
					</td>
				</tr>
				<tr>
					<th class="tikColumn"><center>#</center></th>
					<th>Widget</th>
					<th>Content type</th>
				</tr>
			</thead>
			<tbody>
				
					<?php 
						
						while($row = $widgetQuery->fetch_array()){
							echo "<tr>";
							// tik to delete
							echo "<td class=\"tikColumn\"><input type=\"checkbox\" id=\"{$row['widgetId']}\" class=\"checkForDelete\" name=\"\"></td>";
							
							// Widget name with decode for special characters
							$name = utf8_decode($row['name']);
							echo "<td><a class='blueLinks'>{$name}</a></td>";
							// Content Type
							echo "<td><select class='widgetContentType' id='widgetContentType{$row['widgetId']}'>";
							echo "<option>Choose content type</option>";
							echo "<optgroup label='Menu'> ";
							$content = $menu->getAll($database);
							foreach ($content as $c){
								echo "<option data-type='menu' data-id='{$c['menuId']}' ";
								if($row['menuId'] == $c['menuId'] ){
									echo "selected";
								}
								echo ">{$c['title'] }</option>";
							}
							echo "</optgroup>";
							echo "<optgroup label='Post'> ";
							$post->setPageId(0);
							$content = $post->getByPage($database);
							foreach ($content as $c){
								echo "<option data-type='post' data-id='{$c['postId']}' ";
								if($row['postId'] == $c['postId'] ){
									echo "selected";
								}
								echo ">{$c['title'] }</option>";
							}
							echo "</optgroup>";
							
							echo "<select></td>";
							echo "</tr>";
						}
					?>
			</tbody>
		</table>
	</div>
</div><!-- Close rightContainer -->
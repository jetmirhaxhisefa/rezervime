<?php
class Widget{
	private $widgetId;
	private $name;
	private $menuId;
	private $postId;
	
	public function setWidgetId($widgetId){ $this->widgetId = utf8_encode($widgetId); }
	public function setName($name){ $this->name = utf8_encode($name); }
	public function setMenuId($menuId){ $this->menuId = utf8_encode($menuId); }
	public function setPostId($postId){ $this->postId = utf8_encode($postId); }
	
	public function getWidgetId($widgetId){ return utf8_decode($this->widgetId); }
	public function getName($name){ return utf8_decode($this->name); }
	public function getMenuId($menuId){ return utf8_decode($this->menuId); }
	public function getPostId($postId){ return utf8_decode($this->postId); }
	
	// CREATE
	public function create($database){
		$sql = "INSERT INTO widget (widgetId,name,menuId,postId) VALUES ('$this->widgetId','$this->name','$this->menuId','$this->postId')";
		$query = $database->performQuery($sql);
		return $query;
	}
	// UPDATE
	public function update($database){
		$sql = "UPDATE widget SET menuId = '$this->menuId' ,postId = '$this->postId' WHERE widgetId = '{$this->widgetId}'";
		$query = $database->performQuery($sql);
		return $query;
	}
	// GET ALL
	public function getAll($database){
		$sql = "SELECT * FROM widget";
		$query = $database->performQuery($sql);
		return $query;
	}
	// DELETE
	public function delete($database){
		$sql = "DELETE FROM widget WHERE widgetId = $this->widgetId";
		$query = $database->performQuery($sql);
		return $query;
	}
}
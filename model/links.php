<?php
class Links{
	private $linkId;
	private $pageId;
	private $menuId;
	private $appearName;
	private $position;
	private $categoryId;
	private $isCustomLink;
	private $http;
	private $parentId;
	
	public function setLinkId($linkId){ $this->linkId = utf8_encode($linkId); }
	public function setPageId($pageId){ $this->pageId = utf8_encode($pageId); }
	public function setMenuId($menuId){ $this->menuId = utf8_encode($menuId); }
	public function setAppearName($appearName){ $this->appearName = utf8_encode($appearName); }
	public function setPosition($position){ $this->position = utf8_encode($position); }
	public function setCategoryId($categoryId){ $this->categoryId = utf8_encode($categoryId); }
	public function setIsCustomLink($isCustomLink){ $this->isCustomLink = utf8_encode($isCustomLink); }
	public function setHttp($http){ $this->http = utf8_encode($http); }
	
	public function getLinkId(){ return utf8_decode($this->linkId); }
	public function getPageId(){ return utf8_decode($this->pageId); }
	public function getMenuId(){ return utf8_decode($this->menuId); }
	public function getAppearName(){ return utf8_decode($this->appearName); }
	public function getPosition(){ return utf8_decode($this->position); }
	public function getCategoryId(){ return utf8_decode($this->categoryId); }
	public function getIsCustomLink(){ return utf8_decode($this->isCustomLink); }
	public function getHttp(){ return utf8_decode($this->http); }
	
	// CREATE
	public function create($database){
		$sql = "INSERT INTO links (pageId,menuId,appearName,position,CategoryId,isCustomLink,http)
				VALUES('$this->pageId','$this->menuId','$this->appearName','$this->position','$this->categoryId','$this->isCustomLink','$this->http')";
		$query = $database->performQuery($sql);
		return $query;
	}
	
	// NUM LINKS IN MENU
	public function numByMenu($database){
		$sql = "SELECT * FROM links WHERE menuId = $this->menuId";
		$result = $database->performQuery($sql);
		return mysqli_num_rows($result);
	}

	// GET ALL PARENT LINKS
	public function getAllLinks($database){
		$sql = "SELECT * FROM links WHERE menuId = $this->menuId ORDER BY position";
		$query = $database->performQuery($sql);
		return $query;
	}
	// DELETE BY MENU
	public function deleteByMenu($database){
		$sql = "DELETE FROM links WHERE menuId = $this->menuId";
		$query = $database->performQuery($sql);
		return $query;
	}
	// DELETE
	public function delete($database){
		$sql = "DELETE FROM links WHERE linkId = $this->linkId";
		$query = $database->performQuery($sql);
		return $query;
	}
	// UPDATE POSITION
	public function updatePosition($database){
		$sql = "UPDATE links SET position = $this->position WHERE linkId = $this->linkId";
		$query = $database->performQuery($sql);
		return $query;
	}
	// GET SUB MENUS LANGUAGE ID
	public function getSubMenusLangId($database){
		$sql = "SELECT * FROM links as l INNER JOIN menus as m ON l.linkId = m.parentLinkId WHERE linkId = $this->linkId LIMIT 1";
		$query = $database->performQuery($sql);
		$result = $query->fetch_array();
		return $result['langId'];
	}
	public function getById($database){
		$sql = "SELECT * FROM links WHERE linkId = $this->linkId";
		$query = $database->performQuery($sql);
		$result = $query->fetch_array();
		$this->pageId = $result['pageId'];
		$this->menuId = $result['menuId'];
		$this->appearName = $result['appearName'];
		$this->position = $result['position'];
		$this->categoryId = $result['categoryId'];
		$this->isCustomLink = $result['isCustomLink'];
		$this->http = $result['http'];
		$this->parentId = $result['parentId'];
	}
}

?>
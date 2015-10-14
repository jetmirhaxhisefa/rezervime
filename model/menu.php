<?php
class Menu{
	private $menuId;
	private $langId;
	private $title;
	private $description;
	private $isMain;
	private $parentLinkId;

	public function setMenuId($menuId){ $this->menuId = utf8_encode($menuId); }
	public function setLangId($langId){ $this->langId = utf8_encode($langId); }
	public function setTitle($title){ $this->title = utf8_encode($title); }
	public function setDescription($description){ $this->description = utf8_encode($description); }
	public function setIsMain($isMain){ $this->isMain = utf8_encode($isMain); }
	public function setParentLinkId($parentLinkId){ $this->parentLinkId = utf8_encode($parentLinkId); }
	
	public function getMenuId(){ return utf8_decode($this->menuId); }
	public function getLangId(){ return utf8_decode($this->langId); }
	public function getTitle(){ return utf8_decode($this->title); }
	public function getDescription(){ return utf8_decode($this->description); }
	public function getIsMain(){ return utf8_decode($this->isMain); }
	public function getParentLinkId(){ return utf8_decode($this->parentLinkId); }
	
	// GET ALL
	public function create($database){
		$sql = "INSERT INTO menus (langId,parentLinkId,title,description,isMain) VALUES ('$this->langId','$this->parentLinkId','$this->title',
				'$this->description','$this->isMain')";
		$query = $database->performQuery($sql);
		return $query;
	}
	// GET ALL
	public function getAll($database){
		$sql = "SELECT * FROM menus";
		$query = $database->performQuery($sql);
		return $query;
	}
	// GET ALL LINKS
	public function getAllLinks($database){
		$sql = "SELECT * FROM links WHERE menuId = $this->menuId";
		$query = $database->performQuery($sql);
		return $query;
	}
	// get main menu id
	public static function getMainMenuId($database){
		$sql = "SELECT menuId as id FROM menus LIMIT 1";
		$query = $database->performQuery($sql);
		$result = $query->fetch_assoc();
		return $result['id'];
	}
	// get isMain by menu id 
	public static function getThisMenuId($database,$menuId){
		$sql = "SELECT isMain AS id FROM menus WHERE menuId = $menuId";
		$query = $database->performQuery($sql);
		$result = $query->fetch_assoc();
		return $result['id'];
	}
	// get main menu id
	public static function getTopMenuId($database){
		$sql = "SELECT menuId AS id FROM menus LIMIT 1";
		$query = $database->performQuery($sql);
		$result = $query->fetch_assoc();
		return $result['id'];
	}
	// MAKE TOP MENU TO MAIN MENU IF MAIN MENU IS DELETED
	public function makeTopMenuToMain($database){
		$sql = "UPDATE menus SET isMain = 1 WHERE menuId =".self::getTopMenuId($database);
		$query = $database->performQuery($sql);
		return $query;
	}
	// UPDATE TITLE
	public function updateTitle($database){
		$sql = "UPDATE menus SET title = '$this->title' WHERE menuId = '$this->menuId'";
		$query = $database->performQuery($sql);
		return $query;
	}
	// get language
	public function getMenuLang($database){
		$sql = "SELECT * FROM menus WHERE menuId = $this->menuId";
		$query = $database->performQuery($sql);
		$result = $query->fetch_assoc();
		return $result['langId'];
	}
	// UPDATE MAIN MENU
	public function updateIsMain($database){
		$sql = "UPDATE menus SET isMain = 0 WHERE langId = $this->langId";
		$query = $database->performQuery($sql);
		$sql2 = "UPDATE menus SET isMain = 1 WHERE menuId = $this->menuId";
		$query2 = $database->performQuery($sql2);
		return $query;
	}
	// GET MENU BY ID
	public function getMenuById($database){
		$sql = "SELECT * FROM menus WHERE menuId = $this->menuId";
		$query = $database->performQuery($sql);
		$result = $query->fetch_assoc();
		$this->isMain = $result['isMain'];
		$this->langId = $result['langId'];
		$this->parentLinkId = $result['parentLinkId'];
		$this->description = $result['description'];
		$this->title = $result['title'];
	}
	// DELETE 
	public function delete($database){
		$sql = "DELETE FROM menus WHERE menuId = $this->menuId";
		$query = $database->performQuery($sql);
		return $query;
	}
	// CHECK IF IT IS A MENU WITH SAME PARENT
	public static function checkParent($database,$parentLinkId){
		$sql = "SELECT menuId FROM menus WHERE parentLinkId = $parentLinkId";
		$result = $database->performQuery($sql);
		return mysqli_num_rows($result);
	}
	
	// GET WITH PARENT LINK
	public function getByParent($database,$parentLinkId){
		$sql = "SELECT * FROM menus WHERE parentLinkId = $parentLinkId";
		$query = $database->performQuery($sql);
		$result = $query->fetch_assoc();
		$this->isMain = $result['isMain'];
		$this->langId = $result['langId'];
		$this->parentLinkId = $result['parentLinkId'];
		$this->description = $result['description'];
		$this->title = $result['title'];
	}
	
	/* FOR FRONTEND */
	// get Menu Of default Lang
	public function getMenuOfdefaultLang($database){
		$sql = "SELECT * FROM menus as m INNER JOIN language as l ON m.langId = l.langId WHERE l.default = 1 AND m.isMain = 1";
		$query = $database->performQuery($sql);
		$result = $query->fetch_assoc(); 
		return $result['menuId'];
	}
	// get Menu By Lang ID
	public function getMenuOfLangId($database){
		$sql = "SELECT * FROM menus as m INNER JOIN language as l ON m.langId = l.langId WHERE l.langId = {$this->langId} AND m.isMain = 1";
		$query = $database->performQuery($sql);
		$result = $query->fetch_assoc();
		return $result['menuId'];
	}
}
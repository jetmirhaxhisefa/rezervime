<?php
class Category{
	private $categoryId;
	private $inherit;
	private $category;
	
	public function setCategoryId($categoryId){ $this->categoryId = utf8_encode($categoryId); }
	public function setInherit($inherit){ $this->inherit = utf8_encode($inherit); }
	public function setCategory($category){ $this->category = utf8_encode($category); }
	
	public function getCategoryId(){ return utf8_decode($this->categoryId); }
	public function getInherit(){ return utf8_decode($this->inherit); }
	public function getCategory(){ return utf8_decode($this->category); }
	
	// CREATE
	public function create($database){
		$sql = "INSERT INTO category (inherit,category) VALUES ('$this->inherit','$this->category')";
		$query = $database->performQuery($sql);
		return $query;
	}
	// GET ALL
	public function getAll($database){
		$sql = "SELECT * FROM category";
		$query = $database->performQuery($sql);
		return $query;
	}
	// GET ALL PARENTS 
	public function getAllParents($database){
		$sql = "SELECT * FROM category WHERE inherit = 0";
		$query = $database->performQuery($sql);
		return $query;
	}
	// GET BY ID
	public function getById($database){
		$sql = "SELECT * FROM category WHERE categoryId = $this->categoryId";
		$query = $database->performQuery($sql);
		$result = $query->fetch_array();
		$this->inherit = $result['inherit'];
		$this->category = $result['category'];
		$query = $database->performQuery($sql);
		return $query;
	}
	// GET ALL BY PARENT
	public function getAllByParent($database){
		$sql = "SELECT * FROM category WHERE inherit = $this->inherit";
		$query = $database->performQuery($sql);
		return $query;
	}
	// GET BY PARENT ID
	public function getParentId($database){
		$sql = "SELECT * FROM category WHERE inherit = $this->inherit";
		$query = $database->performQuery($sql);
		$result = $query->fetch_assoc();
		$this->categoryId = $result['categoryId'];
		$this->inherit = $result['inherit'];
		$this->category = $result['category'];
	}
	// GET BY PARENT ID
	public function getByParentId($database){
		$sql = "SELECT * FROM category WHERE categoryId = $this->inherit";
		$query = $database->performQuery($sql);
		$result = $query->fetch_assoc();
		$this->categoryId = $result['categoryId'];
		$this->inherit = $result['inherit'];
		$this->category = $result['category'];
	}
	// DELETE
	public function delete($database){
		$sql = "DELETE FROM category WHERE categoryId = $this->categoryId";
		$query = $database->performQuery($sql);
		return $query;
	}
	// 	DELETE CATEGORIES OF A POST
	public function deleteCategories($database){
		$sql = "DELETE FROM posts_category WHERE categoryId = $this->categoryId";
		$query = $database->performQuery($sql);
		return $query;
	}
	
	// GET BY PARENT ID
	public function getByParentIdAndPost($database,$postId){
		$sql = "SELECT * FROM category WHERE categoryId = (SELECT categoryId FROM posts_category WHERE postId = {$postId} AND categoryId != $this->inherit LIMIT 1)";
		$query = $database->performQuery($sql);
		return $query;
	}
	// INSERT COLUMN FRO LANGUAGE
	public function insertColumnForLanguage($database,$columnName){
		$sql = "ALTER TABLE category ADD {$columnName} VARCHAR(60);";
		$query = $database->performQuery($sql);
		return $query;
	}
	// DELETE COLUMN FRO LANGUAGE
	public function deleteColumnForLanguage($database,$columnName){
		$sql = "ALTER TABLE category DROP {$columnName};";
		$query = $database->performQuery($sql);
		return $query;
	}
	// UPDATE 
	public function update($database,$columnName,$value){
		$sql = "UPDATE category set {$columnName} = '{$value}' WHERE categoryId = $this->categoryId";
		$query = $database->performQuery($sql);
		return $query;
	}
}
?>
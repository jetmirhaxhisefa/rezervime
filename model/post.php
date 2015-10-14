<?php
class Post{
	private $postId;
	private $pageId;
	private $title;
	private $body;
	private $underTitle;
	private $userId;
	private $date;
	
	public function setPostId($postId){ $this->postId = utf8_encode($postId); }
	public function setPageId($pageId){ $this->pageId = utf8_encode($pageId); }
	public function setTitle($title){ $this->title = utf8_encode($title); }
	public function setBody($body){ $this->body = utf8_encode($body); }
	public function setUnderTitle($underTitle){ $this->underTitle = utf8_encode($underTitle); }
	public function setUserId($userId){ $this->userId = utf8_encode($userId); }
	public function setDate($date){ $this->date = utf8_encode($date); }
	
	public function getPostId(){ return utf8_decode($this->postId); }
	public function getPageId(){ return utf8_decode($this->pageId); }
	public function getTitle(){ return utf8_decode($this->title); }
	public function getBody(){ return utf8_decode($this->body); }
	public function getUnderTitle(){ return utf8_decode($this->underTitle); }
	public function getUserId(){ return utf8_decode($this->userId); }
	public function getDate(){ return utf8_decode($this->date); }
	
// 	CREATE
	public function create($database){
			$sql = "INSERT INTO post (pageId,title,body,underTitle,userId,date) VALUES('$this->pageId','$this->title','$this->body','$this->underTitle','$this->userId','$this->date')";
			$query = $database->performQuery($sql);
			return mysqli_insert_id($database->connection);
	}
	// add categorist for post
	public function givePostCategories($database,$postId,$categoryId){
		$sql = "INSERT INTO posts_category (postId,categoryId) VALUES('$postId','$categoryId')";
		$query = $database->performQuery($sql);
		return $query;
	}
	// GET ALL
	public function getAll($database){
		$sql = "SELECT * FROM post";
		$query = $database->performQuery($sql);
		return $query;
	}
	// GET ALL BY PAGE
	public function getByPage($database){
		$sql = "SELECT * FROM post WHERE pageId = $this->pageId";
		$query = $database->performQuery($sql);
		return $query;
	}
	// GET BY ID
	public function getById($database){
		$sql = "SELECT * FROM post WHERE postId = {$this->postId}";
		$query = $database->performQuery($sql);
		$result = $query->fetch_array();
	
		$this->title = $result['title'];
		$this->pageId = $result['pageId'];
		$this->body = $result['body'];
		$this->underTitle = $result['underTitle'];
		$this->userId = $result['userId'];
		$this->date = $result['date'];
	}
// 	DELETE
	public function delete($database){
		$sql = "DELETE FROM post WHERE postId = $this->postId";
		$query = $database->performQuery($sql);
		return $query;
	}
	// 	DELETE CATEGORIES OF A POST
	public function deleteCategories($database){
		$sql = "DELETE FROM posts_category WHERE postId = $this->postId";
		$query = $database->performQuery($sql);
		return $query;
	}
	// GET CATEGORIES OF A POST 
	public function checkIfPostHasCategory($database,$categoryId){
		$sql = "SELECT * FROM posts_category WHERE postId = {$this->postId} AND categoryId = $categoryId";
		$query = $database->performQuery($sql);
		return mysqli_num_rows($query);
	}
	// UPDATE
	public function update($database){
		$sql = "UPDATE post SET pageId = '$this->pageId', title = '$this->title', body = '$this->body', underTitle = '$this->underTitle', userId = '$this->userId' WHERE postId = $this->postId";
		$query = $database->performQuery($sql);
		return $query;
	}
	
	/* FRONTEND */
	// GET POSTS OF A CATEGORY
	public function getPostByCategory($database,$category){
		$sql = "SELECT *, p.postId as id FROM post as p INNER JOIN 
				posts_category as pc ON p.postId = pc.postId 
				LEFT JOIN media as i ON p.postId = i.postId  
				WHERE p.pageId = {$this->pageId} AND
				pc.categoryId = (SELECT categoryId FROM category WHERE category = '{$category}')";
		$query = $database->performQuery($sql);
		return $query;
	}
	// return post id of a category
	public function returnPostIdOfaCategory($database,$category){
		$sql = "SELECT *, p.postId as id FROM post as p INNER JOIN
		posts_category as pc ON p.postId = pc.postId
		WHERE pc.categoryId = (SELECT categoryId FROM category WHERE category = '{$category}')";
		$query = $database->performQuery($sql);
		return $query;
	}
	// return post id of a category with page Id
	public function returnPostIdOfaCategoryWithPageId($database,$category){
		$sql = "SELECT *, p.postId as id FROM post as p INNER JOIN
		posts_category as pc ON p.postId = pc.postId
		WHERE p.pageId = {$this->pageId} AND pc.categoryId = (SELECT categoryId FROM category WHERE category = '{$category}')";
		$query = $database->performQuery($sql);
		return $query;
	}
	
}
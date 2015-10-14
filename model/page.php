<?php
class Page{
	private $pageId;
	private $title;
	private $pageName;
	private $urlTag;
	private $visibility;
	private $pageLayoutId;
	private $metaDesc;
	private $metaKeywords;
	
	
	public function setPageId($pageId){ $this->pageId = utf8_encode($pageId); }
	public function setPageName($pageName){ $this->pageName = utf8_encode($pageName); }
	public function setTitle($title){ $this->title = utf8_encode($title); }
	public function setUrlTag($urlTag){ $this->urlTag = utf8_encode($urlTag); }
	public function setVisibility($visibility){ $this->visibility = utf8_encode($visibility); }
	public function setPageLayoutId($pageLayoutId){ $this->pageLayoutId = utf8_encode($pageLayoutId); }
	public function setMetaDesc($metaDesc){ $this->metaDesc = utf8_encode($metaDesc); }
	public function setMetaKeywords($metaKeywords){ $this->metaKeywords = utf8_encode($metaKeywords); }
	
	public function getPageId(){ return utf8_decode($this->pageId); }
	public function getPageName(){ return utf8_decode($this->pageName); }
	public function getTitle(){ return utf8_decode($this->title); }
	public function getUrlTag(){ return utf8_decode($this->urlTag); }
	public function getVisibility(){ return utf8_decode($this->visibility); }
	public function getPageLayoutId(){ return utf8_decode($this->pageLayoutId); }
	public function getMetaDesc(){ return utf8_decode($this->metaDesc); }
	public function getMetaKeywords(){ return utf8_decode($this->metaKeywords); }
	
	// GET ALL
	public function getAll($database){
		$sql = "SELECT * FROM pages";
		$query = $database->performQuery($sql);
		return $query;
	}
	
	// ADD page
	public function create($database){
		$sql = "INSERT INTO pages (title,pageName,urlTag,visibility,pageLayoutId,metaDesc,metaKeywords)
		VALUES ('{$this->title}','{$this->pageName}','{$this->urlTag}',
		'{$this->visibility}','{$this->pageLayoutId}','{$this->metaDesc}','{$this->metaKeywords}')";
		$query = $database->performQuery($sql);
		return $query;
	}
	// UPDATE
	public function update($database){
		$sql = "UPDATE pages SET title = '$this->title', pageName = '$this->pageName', urlTag = '$this->urlTag', 
				visibility = '$this->visibility', pageLayoutId = '$this->pageLayoutId', metaDesc = '$this->metaDesc', metaKeywords = '$this->metaKeywords' 
				WHERE pageId = $this->pageId";
		$query = $database->performQuery($sql);
		return $query;
	}
	// DELETE
	public function delete($database){
		$sql = "DELETE FROM pages WHERE pageId = $this->pageId";
		$query = $database->performQuery($sql);
		return $query;
	}
	// change visibility
	public function chageVisibility($database){
		$sql = "UPDATE pages SET visibility = $this->visibility WHERE pageId = $this->pageId";
		$query = $database->performQuery($sql);
		return $query;
	} 
	// GET BY ID
	public function getById($database){
		$sql = "SELECT * FROM pages WHERE pageId = {$this->pageId}";
		$query = $database->performQuery($sql);
		$result = $query->fetch_array();
		
		$this->title = $result['title'];
		$this->pageName = $result['pageName'];
		$this->urlTag = $result['urlTag'];
		$this->visibility = $result['visibility'];
		$this->pageLayoutId = $result['pageLayoutId'];
		$this->metaDesc = $result['metaDesc'];
		$this->metaKeywords = $result['metaKeywords'];
		
	}
	
	
	/* FOR FRONTEND */
	 
	// get isMain by menu id
	public function getPageByUrlTag($database){
		$sql = "SELECT * FROM pages WHERE urlTag = '{$this->urlTag}' ";
		$query = $database->performQuery($sql);
		$result = $query->fetch_assoc();
		$this->pageId = $result['pageId'];
		$this->title = $result['title'];
		$this->pageName = $result['pageName'];
		$this->urlTag = $result['urlTag'];
		$this->visibility = $result['visibility'];
		$this->pageLayoutId = $result['pageLayoutId'];
		$this->metaDesc = $result['metaDesc'];
		$this->metaKeywords = $result['metaKeywords'];
		return $result['pageLayoutId'];
	}
	// GET BY MENU ID INNER JOIN LINKS OF A MENU
	public function getPagesAndLinksByMenu($database,$menuId){
		$sql = "SELECT * FROM pages as p INNER JOIN links as l ON p.pageId = l.pageId WHERE l.menuId = {$menuId} ORDER BY l.position";
		$query = $database->performQuery($sql);
		return $query;
	}
	
}
?>
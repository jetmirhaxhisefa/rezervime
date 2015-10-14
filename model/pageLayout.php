<?php
class PageLayout{
	private $pageLayoutId;
	private $name;
	private $designUrl;
	private $image;
	
	
	public function setPageLayoutId($pageLayoutId){ $this->pageLayoutId = utf8_encode($pageLayoutId); }
	public function setName($name){ $this->name = utf8_encode($name); }
	public function setDesignUrl($designUrl){ $this->designUrl = utf8_encode($designUrl); }
	public function setImage($image){ $this->image = utf8_encode($image); }
	
	
	public function getPageLayoutId(){ return utf8_decode($this->pageLayoutId); }
	public function getName(){ return utf8_decode($this->name); }
	public function getDesignUrl(){ return utf8_decode($this->designUrl); }
	public function getImage(){ return utf8_decode($this->image); }
	
	// GET ALL
	public function getAll($database){
		$sql = "SELECT * FROM pageLayout";
		$query = $database->performQuery($sql);
		return $query;
	}
	// GET BY ID
	public function getById($database){
		$sql = "SELECT * FROM pageLayout WHERE pageLayoutId = {$this->pageLayoutId}";
		$query = $database->performQuery($sql);
		$result = $query->fetch_array();
	
		$this->pageLayoutId = $result['pageLayoutId'];
		$this->name = $result['name'];
		$this->designUrl = $result['designUrl'];
		$this->image = $result['image'];
	}
	// DELETE
	public function delete($database){
		$sql = "DELETE FROM pageLayout WHERE pageLayoutId = $this->pageLayoutId";
		$query = $database->performQuery($sql);
		return $query;
	}
	// refresh layouts
	public function refreshLayouts($database){
		$sql = "TRUNCATE TABLE pagelayout";
		$query = $database->performQuery($sql);
		
		if($query){
			$path    = '../themes';
			$files = scandir($path);
			$imgPaths = "../images/layout/";
			$imgs = scandir($imgPaths);
			$layoutsArray = [];
			$layoutsImagesArray = [];
			foreach($files as $file) {
				if(substr($file, -4) == ".php"){
					$layout = substr($file, 0, -4);
					foreach($imgs as $img){
						if(substr($img, 0, -4) == $layout){
							$this->name = $layout;
							$this->designUrl = "themes/".$file;
							$this->image = "images/layout/".$img;
							$sqlInsert = "INSERT INTO pagelayout (name,designUrl,image) VALUES('$this->name','$this->designUrl','$this->image')";
							$database->performQuery($sqlInsert);
						}else if(substr($img, 0, -5) == $layout){
							$this->name = $layout;
							$this->designUrl = "themes/".$file;
							$this->image = "images/layout/".$img;
							$sqlInsert = "INSERT INTO pagelayout (name,designUrl,image) VALUES('$this->name','$this->designUrl','$this->image')";
							$database->performQuery($sqlInsert);
						}else{
							
						}
					}
				}
			}
		}
	}
}	
?>
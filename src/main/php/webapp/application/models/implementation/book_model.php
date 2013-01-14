<?php
include_once("IArticle.php");
include_once("ISBN13.php");

class book_model extends CI_Model implements IArticle {
	private $id = 0;
	private $type = "book";
	private $dataDTO = array();
	private $tableName = "tbl_book";
	
	private $isbn;
	
	/**
	 * Constructor
	 * 
	 * Create a new book object, if a id is given the data will be read from database
	 * 
	 * @param id = article id (optional)
	 */		 
	public function __construct($id=false)	
	{
		parent::__construct();
		if($id != false){
			$sql = '
					SELECT 	
							title,
							author,
							edition,
							isbn,
							picture
					
					FROM '.$this->tableName.'			
					WHERE
						fk_article = \'' . $id . '\'
			';
			$query = $this->db->query($sql);
			$data = $query->result_array();
			
			//if offer not found -> id to false!!
			if(count($data)==0){
				$this->id=false;
				return false;
			}
			$this->id=$id;
			$this->dataDTO = $data[0];
			$this->isbn = new ISBN13($data[0]['isbn']);
		}
	}		
	
    public function getId(){
    	return $this->id;
    }
	
	public function setId($id){
		$this->id = $id; 
	}
	
    public function getType(){
    	return $this->type;
    }	
	
	public function getTitle(){
		return $this->dataDTO["title"];
	}	
		
    public function getData($element=false){
    	if($element==false){
    		return $this->dataDTO;
		} 
		else {
			if (isset($this->$element)){
				if ($this->$element != null) {
					return $this->$element;
				}
				else{
					return '';
				}
			}
			else{
				if(isset($this->dataDTO[$element])){
					return $this->dataDTO[$element];
				} else {
					return "";
				}
			}
		}
    }
	
	public function setData($inDTO){
		$this->dataDTO = $inDTO;
	}
	
	public function getTabel(){
		return $this->tableName;
	}
	
}


?>

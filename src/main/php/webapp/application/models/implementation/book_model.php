<?php
class book_model extends CI_Model {
	private $id = 0;
	private $type = "book";
	private $dataDTO = array();
	private $tableName = "tbl_book";
	
	/**
	 * Constructor
	 * 
	 * Create a new book object, if a id is given the data will be read from database
	 * 
	 * @param id = article id (optional)
	 */		 
	public function __construct($id=false)
	{
		if($id != false){
			$this->id=$id;
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
			$this->dataDTO = $data[0];
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
		
    public function getData(){
    	return $this->dataDTO;
    }
	
	public function setData($inDTO){
		$this->dataDTO = $inDTO;
	}
	
	public function getTabel(){
		return $this->tableName;
	}
	
}


?>

<?php
class offer_model extends CI_Model {
	private $id = 0;
	private $price = 0;
	private $expDate = "";
	private $article = null;

	/**
	 * Constructor
	 * 
	 * Create a new offer object, if a id is given the data will be read from database
	 * 
	 * @param id = offer id (optional)
	 */	 
	public function __construct($id=false)
	{
		
		if($id != false){
			$this->id=$id;
			$sql = '
					SELECT 	
							fk_article,
							price,
							expires
					
					FROM tbl_offer			
					WHERE
						pk_offer = \'' . $id . '\'
			';
			$query = $this->db->query($sql);
			$data = $query->result_array();
			$this->price = $data[0]["price"];
			$this->expDate = $data[0]["expires"];
			$this->article = Factory::getArticle($data[0]["fk_article"]);
		}
		
	}		
	
    public function getId(){
    	return $this->id;
    }
	
	public function setId($id){
		$this->id = $id; 
	}
	
    public function getPrice(){
    	return $this->price;
    }
	
	public function setPrice($price){
		$this->price = $price;
	}
	
	public function getDate(){
		return $this->expDate;
	}
	
	public function setDate($date){
		$this->expDate = $date;
	}	
	
    public function getArticle(){
    	return $this->article;
    }
	
	public function setArticle($article){
		//if ($article instanceof IArticle) {
			$this->article = $article;
		//}
	}
}


?>
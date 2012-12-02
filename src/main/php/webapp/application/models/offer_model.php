<?php
class offer_model extends CI_Model {
	
	public function getModle($type,$id){
		
	}
	
	public function getArticleData($type,$id){
		if($type == false)return array();
		
		$table = 'tbl_'.$type;
		$query = $this->db->query('SELECT * FROM '.$table.' where fk_article = "'.$id.'"');
		$row = $query->result();
		
		if( count($row)==0){
			return false;
		}
		if( empty($id) ){
			return false;
		}
		return get_object_vars($row[0]);
	}
	
/* 	getArticleTypID -> get ID from type (DB)
	@params: type = type of article as text (URL)
 */	
	public function getArticleTypID($type= false){
		if($type == false)return false;
		
		$query = $this->db->query('SELECT pk_articletype FROM tbl_articletype where typename = "'.$type.'"');
		$row = $query->result();
		
		if( count($row)==0){
			return false;
		}
		$id = $row[0]->pk_articletype;
		if( empty($id) ){
			return false;
		}
		return $id;
		
	}
	
/* 	getOfferData -> connects to the db and gets the offer data based on an article ID
	@params: $articleID = ID of article of offer to be loaded (1 article = max 1 offer!)
 */		
	public function getOfferData($articleID=false){
		if($articleID == false)return array();
		
		$table = 'tbl_offer';
		$query = $this->db->query('SELECT * FROM '.$table.' where fk_article = "'.$articleID.'"');
		$row = $query->result();
		if( count($row)==0){
			return false;
		}
		return get_object_vars($row[0]);
	}
	

}


?>

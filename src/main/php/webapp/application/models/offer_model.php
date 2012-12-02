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
	
	
	public function getOfferData($articleID){
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

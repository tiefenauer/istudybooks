<?php
class offer_model extends CI_Model {
	
	public function getModle($type,$id){
		
	}
	
	public function getArticleData(){
		
		
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
}


?>

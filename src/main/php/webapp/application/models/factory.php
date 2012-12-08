<?php

class Factory extends CI_Model {
		
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->load->database();
	}
	
	/**
	 * Get list of all offers (from a type) from database
	 * 
	 * @param type (optional, default '%')
	 * @return array of offer objects
	 */
	public function getOffers($type='%') {
		$sql = '
				SELECT 
						offer.pk_offer AS id
												
				FROM tbl_offer AS offer
				JOIN tbl_article AS article
				  ON offer.fk_article = article.pk_article
				JOIN tbl_articletype AS articletype
				  ON article.fk_articletype = articletype.pk_articletype
				
				WHERE
					articletype.typename LIKE \'' . $type . '\'
		';
		$query = $this->db->query($sql);
		$offers = $query->result_array();
		
		
		$offersArray = array();
		foreach ($offers as $offer){
			$offersArray[]=new offer_model($offer['id']);
		}		
		return $offersArray;
	}
	
	/**
	 * Get list of offer from database, searched by orderId
	 * 
	 * @param offerId
	 * @return offer object 
	 */
	public function getOffer($offerId=false) {
		if ($offerId == false){
			return new offer_model();
		}
		return new offer_model($offerId);
	}	
	
	/**
	 * Get all article types
	 * 
	 * @return result_array of sql query 
	 */
	public function getArticleTypes() {
		/*$sql = '
				SELECT DISTINCT articletype.typename
				  FROM tbl_offer AS offer
				  JOIN tbl_article AS article
				    ON article.pk_article = offer.fk_article
				  JOIN tbl_articletype AS articletype
				    ON articletype.pk_articletype = article.fk_articletype
		';*/
		$sql = '
				SELECT typename
				  FROM tbl_articletype
		';
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	/**
	 * Get the article type id  of a article type
	 * 
	 * @param article type
	 * @return article type id 
	 */	
	public function getArticleTypeId($type){
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
	
	/**
	 * Get the article object, searched by id
	 * 
	 * @param article id
	 * @return article object
	 */	
	public function getArticle($id){
		$sql = '
				SELECT 	
						fk_articletype				
				FROM tbl_article			
				WHERE
					pk_article = \'' . $id . '\'
		';
		$query = $this->db->query($sql);
		$row = $query->result();
		if( count($row)==0){
			return false;
		}
		$fkArticleType = $row[0]->fk_articletype;
		if( empty($fkArticleType) ){
			return false;
		}
		$article=null;
		if($fkArticleType == 7){	
			$article=new book_model($id);
		}
		return $article;
		
	}	
		
}
?>
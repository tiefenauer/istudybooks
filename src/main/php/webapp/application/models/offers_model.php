<?php

class Offers_model extends CI_Model {
		
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->load->database();
	}
	
	/**
	 * Get list of offers from database
	 */
	public function get_offers($type='%') {
		$sql = '
				SELECT 
						offer.pk_offer AS id		
						,offer.title AS title
						,articletype.typename AS articletype
						,offer.price AS price
				
				FROM tbl_offer AS offer
				JOIN tbl_article AS article
				  ON offer.fk_article = article.pk_article
				JOIN tbl_articletype AS articletype
				  ON article.fk_articletype = articletype.pk_articletype
				
				WHERE
					articletype.typename LIKE \'' . $type . '\'
		';
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}
?>
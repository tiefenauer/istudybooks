<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Book extends CI_Controller{
	public function index(){
		echo "Index of book";
	}
	
	public function book_insert(){
		//find out article type id
		$query = $this->db->query('SELECT pk_articletype FROM tbl_articletype where typename = "Buch"');
		$typeId = $query->result()->pk_articletype;
		
		//insert article
		$data = array(
               'fk_articletype' => $typeId,
        );				
		$this->db->insert('tbl_article', $data);
		$articleId = $this->db->insert_id();
		
		//insert book
		if(!empty($POST['name'])){
			$name = $POST['name'];
		} else {
			$name = "";
		}
		if(!empty($POST['author'])){
			$author = $POST['author'];
		} else {
			$author = "";
		}
		if(!empty($POST['isbn'])){
			$isbn = $POST['isbn'];
		} else {
			$isbn = "";
		}
		if(!empty($POST['picture'])){
			$picture = $POST['picture'];
		} else {
			$picture = "";
		}						
		$data = array(
               'fk_article' => $articleId,
               'name' => $name,
               'author' => $author,
               'ISBN' => $isbn,
               'picture' => $picture,
        );
		$this->db->insert('tbl_book', $data);
		
		//insert offert
		if(!empty($POST['price'])){
			$price = $POST['price'];
		} else {
			$price = "";
		}	
		$bookId = $this->db->insert_id();
		$data = array(
               'fk_article' => $bookId,
               'price' => $price,
        );		
		$this->db->insert('tbl_offer',$data);
	}
} 
?>

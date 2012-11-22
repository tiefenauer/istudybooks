<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Book extends CI_Controller{
	public function index(){
		echo "Index of book";
	}
	
	public function book_insert(){
		echo "Form post:<br>";
		print_r($_POST);
		// //find out article type id
		// $query = $this->db->query('SELECT pk_articletype FROM tbl_articletype where typename = "Buch"');
		// $typeId = $query->result()->pk_articletype;
// 		
		// //insert article
		// $data = array(
               // 'fk_articletype' => $typeId,
        // );				
		// $this->db->insert('tbl_article', $data);
		// $articleId = $this->db->insert_id();
// 		
		// //insert book
		// if(!empty($_POST['name'])){
			// $name = $_POST['name'];
		// } else {
			// $name = "";
		// }
		// if(!empty($_POST['author'])){
			// $author = $_POST['author'];
		// } else {
			// $author = "";
		// }
		// if(!empty($_POST['isbn'])){
			// $isbn = $_POST['isbn'];
		// } else {
			// $isbn = "";
		// }
		// if(!empty($_POST['picture'])){
			// $picture = $_POST['picture'];
		// } else {
			// $picture = "";
		// }						
		// $data = array(
               // 'fk_article' => $articleId,
               // 'name' => $name,
               // 'author' => $author,
               // 'ISBN' => $isbn,
               // 'picture' => $picture,
        // );
		// $this->db->insert('tbl_book', $data);
// 		
		// //insert offert
		// if(!empty($_POST['price'])){
			// $price = $_POST['price'];
		// } else {
			// $price = "";
		// }	
		// $bookId = $this->db->insert_id();
		// $data = array(
               // 'fk_article' => $bookId,
               // 'price' => $price,
        // );		
		// $this->db->insert('tbl_offer',$data);
	}
} 
?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Offer extends CI_Controller{
	public function index(){
		//redirect to offers if no action requested on offer!
		if( $this->uri->segment(3) == false ){
				redirect('/offers', 'refresh');
		}	
	}
	
	public function add($type=false){
		$this->load->helper('form');
		//$this->load->view('include/header');
		
		
		//no type provided, sho possible offers to create:
		if($type==false){
			$this->load->template('offer_view');
		} else {
		
			$this->load->model('offer_model');	
			$articleTypeID = $this->offer_model->getArticleTypID($type);
			if( $articleTypeID === false ){
				show_error('undefined type');
			}
			//create view for input (form)
			$this->load->template($type . '_edit_view');
		}
		
		//$this->load->view('include/footer');
	}
	
	public function edit($type,$id){
		$this->load->helper('form');
		
		$data = array("id" => $id);
		$this->load->model('offer_model');
		$offer = $this->offer_model->getArticleData($type,$id);
		$this->load->template($type . '_edit_view', $data);
	}


	public function save($type=false){
		switch($type){
			case 'book':
				//validate Form:
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
		
				$this->form_validation->set_rules('title', 'Titel', 'required|min_length[2]|max_length[30]');
				$this->form_validation->set_rules('author', 'Author', 'required');
				$this->form_validation->set_rules('isbn', 'ISBN Number', 'required');
				$this->form_validation->set_rules('price', 'price', 'required');
		
		
				if ($this->form_validation->run() == FALSE)
				{
					//$this->load->view('include/header');
					$this->load->template('book_edit_view');
					//$this->load->view('include/footer');
				}
				else
				{
					$articleArray = $this->writeToDBinit($type);
					
					$articleTypeID = $articleArray[0];
					$articleID = $articleArray[1];
					
					//add book to db:		
					$data = array(
			               'fk_article' => $articleID,
			               'title' => $this->input->post('title'),
			               'author' => $this->input->post('author'),
			               'isbn' => $this->input->post('isbn'),
			               'picture' => $this->input->post('picture'),
			        );
					$this->db->insert('tbl_book', $data);
				
				
					$this->writeToDBend($articleID);
				}
			break;
			
			
			case 'dvd':
			
			break;
			
			
			default:
				show_error('Undefined type');
			break;
		}
		
	}


	private function writeToDBinit($type){
		$this->load->model('offer_model');	
		$articleTypeID = $this->offer_model->getArticleTypID($type);
		
		
		if( $articleTypeID === false ){
			show_error('undefined type');
		}
		$data = array(
               'fk_articletype' => $articleTypeID
        );
		$this->db->insert('tbl_article',$data);
        $articleID = $this->db->insert_id();	
		return array($articleTypeID,$articleID);
	}
	
	private function writeToDBend($articleID){
		$data = array(
               'fk_article' => $articleID,
               'price' => $this->input->post('price'),
        );		
		$this->db->insert('tbl_offer',$data);
		
		
		die('saved successfully!');
	}

} 
?>

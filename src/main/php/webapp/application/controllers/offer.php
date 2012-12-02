<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Offer extends CI_Controller{
	public function index(){
		//redirect to offers if no action requested on offer!
		if( $this->uri->segment(3) == false ){
				redirect('/offers', 'refresh');
		}	
	}
	
/* 	add -> called by controler (from URL)
	@params: type = type of article as text (URL)
 */	
	
	public function add($type=false){
		$this->load->helper('form');
		//$this->load->view('include/header');
		
		
		//no type provided, show possible offers to create:
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
	}
	
/* 	edit -> called by controler (from URL)
	@params: type = type of article as text (URL) 
	@params: id = articleID to be edited (URL) 
 */
	
	public function edit($type,$id){
		$this->load->helper('form');
		$this->load->model('offer_model');
		$data['article'] = $this->offer_model->getArticleData($type,$id);
		$data['offer'] = $this->offer_model->getOfferData($id);
		
		$this->load->template($type . '_edit_view', $data);
	}



/* 	save -> called by controler (from URL)
	@params: type = type of article as text (URL) 
 */
	public function save($type=false){
		
		//validate Form:
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$data['article'] = $this->input->post();
		$data['offer'] = $this->input->post();
		$articleID = (isset($data['article']['fk_article'])) ? $data['article']['fk_article'] : false;
		$edit = ($articleID); //edit = true, if articleID passed
		if(!is_array($data))$data=array();
		
		switch($type){
			case 'book':
		
				$this->form_validation->set_rules('title', 'Titel', 'required|min_length[2]|max_length[30]');
				$this->form_validation->set_rules('author', 'Author', 'required');
				$this->form_validation->set_rules('isbn', 'ISBN Number', 'required');
		
		
				if ($this->form_validation->run() == FALSE)
				{
					$this->load->template('book_edit_view',$data);
				}
				else
				{
					//db entry initialize: load type and id of article entry (create one if needed)
					$articleArray = $this->writeToDBinit($type,$articleID);
					
					$articleTypeID = $articleArray[0];
					$articleID = $articleArray[1];
					
					
					$data = array(
			               'fk_article' => $articleID,
			               'title' => $this->input->post('title'),
			               'author' => $this->input->post('author'),
			               'isbn' => $this->input->post('isbn'),
			               'picture' => $this->input->post('picture')
			        );
					
					//add book to db:
					if($edit){
						$this->db->where('fk_article', $articleID);
						$this->db->update('tbl_book',$data);
					} else {
						$this->db->insert('tbl_book', $data);
					}	
					
					$this->writeToDBend($type,$articleID);
				}
			break;
			
			
			case 'dvd':
			
			break;
			
			
			default:
				show_error('Undefined type');
			break;
		}
		
	}


/* 	initialises the db entry to be made
	@params: type = type of article as text (URL)
	@articleID: id of article (article ID to be edited) (if available)
	returns array of articleTypeID (ID of type) and articleID 
 */

	private function writeToDBinit($type,$articleID=false){
		$this->load->model('offer_model');	
		$articleTypeID = $this->offer_model->getArticleTypID($type);
		
		//article DS already available:
		if($articleID!==false)return array($articleTypeID,$articleID);
		
		//create new article DS:
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
	
/* 	writes the db entry
	@params: type = type of article as text (URL)
	@articleID: id of article (article ID to be edited) (if available)
	redirects to edit entry URL
 */
	private function writeToDBend($type,$articleID){
		$price = $this->input->post('price');
		
		$data = array(
               'fk_article' => $articleID,
               'price' => $price,
        );	
        
        //check if offer already made:
        $edit = $this->input->post('order_fk_article');
		if(!empty($edit)){
			$this->db->where('fk_article', $articleID);
			$this->db->update('tbl_offer',$data);
		} else if(!empty($price)){
			$this->db->insert('tbl_offer',$data);	
		}
		redirect('/offer/edit/'.$type.'/'.$articleID, 'refresh');
		
	}

} 
?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Offer extends CI_Controller{
	
	public function index(){
		//redirect to offers if no action requested on offer!
		if( $this->uri->segment(3) == false ){
				redirect('/offers', 'refresh');
		}	
	}
	
	/** 
	 * Called by controller (from URL)
	 * 
	 * Open a window with a form to fill in a offer
	 * 
	 * @param type = type of article as text (URL)
	 */
	public function add($type=false){
		$this->load->helper('form');
		//$this->load->view('include/header');
		
		
		//no type provided, show possible offers to create:
		if($type==false){
			$this->load->template('offer_view');
		} else {
		
			$this->load->model('factory');	
			$articleTypeID = $this->factory->getArticleTypeId($type);
			if( $articleTypeID === false ){
				show_error('undefined type');
			}
			//create view for input (form)
			$this->load->template($type . '_edit_view');
		}
	}

 	/** 
	 * Called by controller (from URL)
	 * 
	 * Open a window with a form to edit a offer
	 * 
	 * @param type = type of article as text (URL)
	 * @param id = articleID to be edited (URL)
	 */	
	public function edit($type,$id){
		$this->load->helper('form');
		$this->load->model('factory');
		$this->load->model('implementation/offer_model');
		$this->load->model('implementation/book_model');		
		
		$data['article'] = $this->factory->getArticle($id);
		$data['offer'] = $this->factory->getOffer($id);
		
		$this->load->template($type . '_edit_view', $data);
	}


  	/** 
	 * Called by controller (from URL)
	 * 
	 * Save the offer
	 * 
	 * @param type = type of article as text (URL)
	 * @param articleID = articleID if article is being modified
	 */	 
	public function save($type=false,$articleID=false){
		
		//validate Form:
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$data['article'] = $this->input->post();
		$data['offer'] = $this->input->post();
		
		//if reload after saveing -> redirect to edit page
		if(empty($data['article']) && $articleID!==false)
			redirect('/offer/edit/'.$type.'/'.$articleID, 'refresh');
		
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
			               'edition' => $this->input->post('edition'),
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

   	/** 
	 * Initialises the db entry to be made
	 * 
	 * @param type = type of article as text (URL)
	 * @param articleID = id of article (article ID to be edited) (if available)
	 * @return  array of articleTypeID (ID of type) and articleID
	 */	 
	private function writeToDBinit($type,$articleID=false){
		$this->load->model('factory');	
		$this->load->model('implementation/offer_model');
		$this->load->model('implementation/book_model');		
		$articleTypeID = $this->factory->getArticleTypeId($type);
		
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

   	/** 
	 * Writes the db entry
	 * 
	 * @param type = type of article as text (URL)
	 * @param articleID = id of article (article ID to be edited) (if available)
	 * redirects to edit entry URL
	 */	 	
	private function writeToDBend($type,$articleID){
		$price = $this->input->post('price');
		
		$data = array(
               'fk_article' => $articleID,
               'expires'	=> $this->input->post('expires'),
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

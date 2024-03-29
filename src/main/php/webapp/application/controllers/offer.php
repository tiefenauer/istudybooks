<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Offer extends CI_Controller{
	
	public function index(){
		//redirect to offers if no action requested on offer!
		if( $this->uri->segment(3) == 0 ){
			redirect('/offers', 'refresh');
		}	
	}
	
	/**
	 * View details for an offer
	 */
	public function view($id) {
		if($id == '') {
			redirect('offers', 'refresh');
			return; //needed, because unit tests will not quit here (redirect is not taken into consideration)
		}
		$this->load->model('factory');
		$this->load->model('implementation/offer_model');
		$this->load->model('implementation/book_model');
		$data['offer'] = $this->factory->getOffer($id);
		$this->load->template('offer_detail', $data);
	}
	
	/** 
	 * Called by controller (from URL)
	 * 
	 * Open a window with a form to fill in a offer
	 * 
	 * @param type = type of article as text (URL)
	 */
	public function add($type=false){
		if(	!$this->session->userdata('logged_in') ){
			$this->session->set_userdata('notification','login required');
			redirect('/offers', 'refresh');
			throw new RuntimeException('login required');
			return; //needed, because unit tests will not quit here (redirect is not taken into consideration)
		}
	
	
		$this->load->helper('form');
		//$this->load->view('include/header');
		
		
		//no type provided, show possible offers to create:
		if($type==false){
			$this->load->template('offer_view');
		} else {
			
			$this->load->model('factory');
			$this->load->model('implementation/offer_model');
			$this->load->model('implementation/book_model');	
			$articleTypeID = $this->factory->getArticleTypeId($type);
			if( $articleTypeID === false ){
				show_error('undefined type');
			}
			$offer=$this->factory->getOffer();
			$offer->setArticle(new book_model());
			$data['offer']=$offer;
			//create view for input (form)
			$this->load->template($type . '_edit_view', $data);
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
		if(	!$this->session->userdata('logged_in') ){
			$this->session->set_userdata('notification','login required');
			redirect('/offers', 'refresh');
			throw new RuntimeException('login required');
			return; //needed, because unit tests will not quit here (redirect is not taken into consideration)
		}
	
		$this->load->helper('form');
		$this->load->model('factory');
		$this->load->model('implementation/offer_model');
		$this->load->model('implementation/book_model');		
		
		$data['offer'] = $this->factory->getOffer($id);
		if($data['offer']->getID() === false || $data['offer']->getID() === 0){
			$this->session->set_userdata('notification','Offer has been not been found, create a new one');
			redirect('/offer/add/'.$type.'/0', 'refresh');
			throw new RuntimeException('offer not found');
			return;
		}
		$this->load->template($type . '_edit_view', $data);
	}
	

 	/** 
	 * Called by controller (from URL)
	 * 
	 * Open a window removes offer and its article
	 */	
	public function delete($type,$offer_ID){
		if(	!$this->session->userdata('logged_in') ){
			$this->session->set_userdata('notification','login required');
			redirect('/offers', 'refresh');
			throw new RuntimeException('login required');
			return; //needed, because unit tests will not quit here (redirect is not taken into consideration)
		}
	
		 $query = $this->db->get_where('tbl_offer', array('pk_offer' => $offer_ID), 1, 0);
		 if ($query->num_rows() === 0){
			$this->session->set_userdata('notification','Offer has already been deleted');
			 	redirect('/offers/', 'refresh');
			 	throw new RuntimeException('offer has already been deleted');	 
		 }
		 $row = $query->result_array();
		 $row = $row[0];
		 
		 $this->db->where('pk_offer', $offer_ID); 
		 $this->db->delete('tbl_offer'); 
		 $this->db->where('pk_article', $row['fk_article']); 
		 $this->db->delete('tbl_article'); 
		 $this->db->where('fk_article', $row['fk_article']); 
		 $this->db->delete('tbl_book'); 
		 
		$this->session->set_userdata('notification','Offer has been removed successfully');
		redirect('/offers/', 'refresh');
		throw new RuntimeException('offer removed successfully');
		return; //needed, because unit tests will not quit here (redirect is not taken into consideration)
	}



	public function buy($type, $id){
		$this->load->helper('form');
		$this->load->model('factory');
		$this->load->model('implementation/offer_model');
		$this->load->model('implementation/book_model');
		
		$data['offer'] = $this->factory->getOffer($id);
		$this->load->template('buy_view', $data);
	}
	public function order($type, $id){
		$this->load->helper('form');
		$this->load->model('factory');
		$this->load->model('implementation/offer_model');
		$this->load->model('implementation/book_model');
		
		$post = $this->input->post();
		
		$success = $this->factory->sendmail($post['email'],'Order ID: '.$post['offer_ID'], 'ordered' );
		if(!$success)die('error');
		
		$this->session->set_userdata('notification','You have ordered order '.$post['offer_ID']);
		
		redirect('/offers/', 'refresh');
		throw new RuntimeException('ordered successfully');
		return; //needed, because unit tests will not quit here (redirect is not taken into consideration)
	}


  	/** 
	 * Called by controller (from URL)
	 * 
	 * Save the offer
	 * 
	 * @param type = type of article as text (URL)
	 * @param articleID = articleID if article is being modified
	 */	 
	public function save($type=false,$offer_ID=0){
		
		//validate Form:
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$data['article'] = $this->input->post();
		$data['offer'] = $this->input->post();
		
		//if reload after saveing -> redirect to edit page
		if(empty($data['article']) && $offer_ID!==0){
			redirect('/offer/edit/'.$type.'/'.$offer_ID, 'refresh');
		}
		$articleID = $this->input->post("fk_article");
		
		$edit = ($offer_ID != 0); //edit = true, if articleID passed
		if(!is_array($data))$data=array();
		
		switch($type){
			case 'book':
		
				$this->form_validation->set_rules('title', 'Titel', 'required|min_length[2]|max_length[30]');
				$this->form_validation->set_rules('author', 'Author', 'required');
				$this->form_validation->set_rules('isbn', 'ISBN Number', 'required');
		
		
				if ($this->form_validation->run() == FALSE)
				{
					/*
					@todo:
					
					THIS WOULD FIX IT, BUT POST VARS WILL NO BE FILLED IN AGAIN
					$this->load->model('factory');
					$this->load->model('implementation/offer_model');
					$this->load->model('implementation/book_model');
						
					$offer=$this->factory->getOffer();
					$offer->setArticle(new book_model());
					$data['offer']=$offer;*/
					
					$this->load->template('book_edit_view',$data);
				}
				else
				{
					//db entry initialize: load type and id of article entry (create one if needed)
					$articleArray = $this->writeToDBinit($type,$articleID);
					
					$articleTypeID = $articleArray[0];
					$articleID = $articleArray[1];
					
					$result = $this->saveImage($articleID);
					if (!array_key_exists ('error', $result)){
						echo "SUCCESS: " . print_r($result);
						$filename = $result['file_name'];
					}
					else {
						echo "ERROR:" . print_r($result['error']);
						$filename = '';	
					}
					
					$data = array(
			               'fk_article' => $articleID,
			               'title' => $this->input->post('title'),
			               'author' => $this->input->post('author'),
			               'isbn' => $this->input->post('isbn'),
			               'edition' => $this->input->post('edition'),
			               'picture' => $filename
			        );
					
					//add book to db:
					if($edit){
						$this->db->where('fk_article', $articleID);
						$this->db->update('tbl_book',$data);
					} else {
						$this->db->insert('tbl_book', $data);
					}	
					
					$this->writeToDBend($type,$offer_ID,$articleID);
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
	private function writeToDBinit($type,$articleID=0){	
		$this->load->model('factory');	
		$this->load->model('implementation/offer_model');
		$this->load->model('implementation/book_model');		
		$articleTypeID = $this->factory->getArticleTypeId($type);
		
		//article DS already available:
		if($articleID!=0)return array($articleTypeID,$articleID);
		
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
	 * @param offerID = id of offer
	 * @param articleID = id of article (article ID to be edited) (if available)
	 * redirects to edit entry URL
	 */	 	
	private function writeToDBend($type,$offerID,$articleID){
		$price = $this->input->post('price');
		
		$data = array(
               'fk_article' => $articleID,
               'expires'	=> $this->input->post('expires'),
               'price' => $price,
        );	
        
        //check if offer already made:
        $edit = $this->input->post('order_fk_article');
		if($offerID != 0){
			$this->db->where('fk_article', $articleID);
			$this->db->update('tbl_offer',$data);
		} else {
			$this->db->insert('tbl_offer',$data);
			$offerID = $this->db->insert_id();	
		}
		
		 $this->session->set_userdata('notification', 'Offer has been saved successfully');
		redirect('/offer/edit/'.$type.'/'.$offerID, 'refresh');
		
	}

	/**
	 * Save image for offer. Existing file will be overwritten, if available.
	 */
	private function saveImage($articleID = '') {
		$result = array('error' => 'no file specified (this is OK)');
		 foreach($_FILES as $key => $value) {
		 	echo $key . ": " . implode(', ', $value) . '<br/>';
		 }
		if(!empty($_FILES['picture'])){
	        $config['allowed_types'] = 'gif|jpg|jpeg|jpe|png';
	        $config['max_size']      = '800000000';
			$config['upload_path'] = './uploads/' . $articleID;
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			$config['overwrite'] = TRUE;
			
			//echo "Actual dir: " . getcwd() . "<br>";
		 	//echo "Upload dir: " . $config['upload_path'];			
			if(!is_dir($config['upload_path'])) {
				mkdir($config['upload_path'], 0777);
			}
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('picture')){
				$result = array('error' => $this->upload->display_errors());
			}
			else{
				$result = $this->upload->data();
			}
			
		}
		return $result;
	}
} 
?>

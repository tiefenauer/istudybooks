<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Offer extends CI_Controller{
	public function index(){
		echo "Index of offer";
	}
	
	public function add($type){
		$this->load->helper('form');
		
		$this->load->view($type . '_edit_view');
	}
	
	public function edit($type,$id){
		$this->load->helper('form');
		
		$data = array("id" => $id);
		$this->load->model('offer_model');
		$offer = $this->offer_model->getModle($type,$id);
		$this->load->view($type . '_edit_view', $data);
	}
} 
?>

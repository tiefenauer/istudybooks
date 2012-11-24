<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Offers extends CI_Controller{
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('offers_model');	
	}
	
	/**
	 * Default function
	 */
	public function index(){
		$this->show('%');
	}
	
	/**
	 * Show offers of a certain type
	 */
	public function show($type='%'){
		$data['offers'] = $this->offers_model->get_offers($type);
		$this->load->view('include/header');
		$this->load->view('offers_view', $data);
		$this->load->view('include/footer');
	}

} 
?>

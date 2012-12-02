<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Offers extends CI_Controller{
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('factory');
		$this->load->model('implementation/offer_model');
		$this->load->model('implementation/book_model');	
	}
	
	/**
	 * Default function
	 */
	public function index(){
		$this->filter('%');
	}
	
	/**
	 * Show offers of a certain type
	 */
	public function filter($type='%'){
		$data['offers'] = $this->factory->getOffers($type);
		$this->load->template('offers_view', $data);
	}

} 
?>

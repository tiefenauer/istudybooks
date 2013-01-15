<?php

/**
 * @group Controller
 */

class OfferControllerTest extends CIUnit_TestCase
{
	protected $tables = array(
		'tbl_offer'	=> 'tbl_offer'
	);


	public function __construct($name = NULL, array $data = array(), $dataName = '')
	{
		parent::__construct($name, $data, $dataName);
	}
	
	
	public function setUp()
	{
		parent::setUp();
		// Set the tested controller
		$this->CI = set_controller('offer');
		
		$this->CI->load->model('factory');
		$this->CI->load->model('implementation/book_model');
		
	}
	public function tearDown(){
		//login:
		$this->CI->session->set_userdata('logged_in',false);
	}
	
	
	public function testOfferEditControllerFailsNoLogin()
	{
		$this->setExpectedException('RuntimeException','login required');
		
		// Call the controllers method
		$this->CI->edit('book','1');
		
		
		// Fetch the buffered output
		$out = output();
		
		// Check if the content is OK
		//$this->assertSame(1, preg_match('/login required/i', $out));
	}
	
	public function testOfferDeleteControllerFailsNoLogin()
	{
		$this->setExpectedException('RuntimeException','login required');
		
		// Call the controllers method
		$this->CI->delete('book','1');
		
		// Fetch the buffered output
		$out = output();
		
		// Check if the content is OK
		//$this->assertSame(1, preg_match('/login required/i', $out));
	}
	
	
	public function testOfferDelete(){
		$this->setExpectedException('RuntimeException','offer removed successfully');
	
		//login:
		$this->CI->session->set_userdata('logged_in',true);
	
		
		// Call the controllers method
		$this->CI->delete('book','3');
		
		// Fetch the buffered output
		$out = output();
		
	}
	
	public function testOfferDeleteOfferNotAvailable(){
		
		//login:
		$this->CI->session->set_userdata('logged_in',true);
		
		$this->setExpectedException('RuntimeException','offer has already been deleted');
		
		// Call the controllers method
		$this->CI->delete('book','9999');
		
		
		// Fetch the buffered output
		$out = output();
		
	}
	public function testAddOfferFailsNoLogin(){
		$this->setExpectedException('RuntimeException','login required');
		// Call the controllers method
		$this->CI->add('book');
		// Fetch the buffered output
		$out = output();
	}
	
	public function testOrderOffer(){
		$this->setExpectedException('RuntimeException','ordered successfully');
		// Call the controllers method
		$_POST['offer_ID'] = 3;
		$_POST['email'] = 'spam@klickagent.ch';
		$this->CI->order('book','3');
		// Fetch the buffered output
		$out = output();
	}
	
	
}

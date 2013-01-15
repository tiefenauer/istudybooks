<?php

/**
 * @group Controller
 */

class OfferControllerTest extends CIUnit_TestCase
{
	public function setUp()
	{
		// Set the tested controller
		$this->CI = set_controller('offer');
		
		$this->CI->load->model('factory');
		$this->CI->load->model('implementation/book_model');
		
	}
	
	public function testOfferController()
	{
		$this->setExpectedException('login required');
		//setExpectedException('login required');
		// Call the controllers method
		$this->CI->edit('book','1');
		
		
		// Fetch the buffered output
		$out = output();
		
		// Check if the content is OK
		//$this->assertSame(1, preg_match('/login required/i', $out));
	}
	
	
	
	
	
	
}

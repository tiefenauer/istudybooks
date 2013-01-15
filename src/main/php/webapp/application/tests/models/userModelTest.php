<?php

/**
 * @group Model
 */

class userModel extends CIUnit_TestCase
{
	protected $tables = array(
		'tbl_users' => 'tbl_users'
	);
	
	public function __construct($name = NULL, array $data = array(), $dataName = '')
	{
		parent::__construct($name, $data, $dataName);
	}
	
	public function setUp()
	{
		parent::setUp();
		
		$this->CI->load->model('factory');
		$this->CI->load->model('user');

		
	}
	
	public function tearDown()
	{
		parent::tearDown();
	}
	
	// ------------------------------------------------------------------------
	
	
	public function testloginSuccess()
	{
		$loginSuccess = $this->CI->user->login('username','1234');
		$this->assertFalse(false,$loginSuccess);
	
	}
	
	public function testloginFail()
	{
		$loginSuccess = $this->CI->user->login('username2','1234');
		$this->assertSame(false,$loginSuccess);
	
	}
	
}

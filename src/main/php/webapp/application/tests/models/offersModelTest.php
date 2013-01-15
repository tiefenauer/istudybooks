<?php

/**
 * @group Model
 */

class OfferModel extends CIUnit_TestCase
{
	protected $tables = array(
		'tbl_articletype' => 'tbl_articletype',
		'tbl_article' => 'tbl_article',
		'tbl_book'	=> 'tbl_book',
		'tbl_offer'	=> 'tbl_offer'
	);
	
	public function __construct($name = NULL, array $data = array(), $dataName = '')
	{
		parent::__construct($name, $data, $dataName);
	}
	
	public function setUp()
	{
		parent::setUp();
		
		/*
		* this is an example of how you would load a product model,
		* load fixture data into the test database (assuming you have the fixture yaml files filled with data for your tables),
		* and use the fixture instance variable
		
		$this->CI->load->model('Product_model', 'pm');
		$this->pm=$this->CI->pm;
		$this->dbfixt('users', 'products');
		
		the fixtures are now available in the database and so:
		$this->users_fixt;
		$this->products_fixt;
		
		*/
		$this->CI->load->model('factory');
		$this->CI->load->model('implementation/book_model');

		
	}
	
	public function tearDown()
	{
		parent::tearDown();
	}
	
	// ------------------------------------------------------------------------
	
	
	public function testGetArticleTypeTest()
	{
		$articleTypeID = $this->CI->factory->getArticleTypeId('book');
		$this->assertSame('7',$articleTypeID);
	
	}
	
	
	public function testGetArticleType_Fail()
	{
		$articleTypeID = $this->CI->factory->getArticleTypeId('cd_not_available');
		$this->assertSame(false,$articleTypeID);
	
	}
	
	public function testAddBookToDB()
	{
		$articleTypeID = 7;
		
		$data = array(
               'fk_articletype' => $articleTypeID
        );
		$this->CI->db->insert('tbl_article',$data);
        $articleID = $this->CI->db->insert_id();
        
        
        $data = array(
			               'fk_article' => $articleID,
			               'title' => 'testtitel',
			               'author' => 'author',
			               'isbn' => 'isbn',
			               'edition' => 'edition'
			        );
		$this->CI->db->insert('tbl_book', $data);
		$affectedRows = $this->CI->db->affected_rows();

		$this->assertEquals(1, $affectedRows);
	}
	
	public function testAddOffer(){
		
		$data = array(
		    'fk_article' => 	'2',
		    'price'=>	10,
		    'title'=>	'Buch2',
		    'expires'=> '2000-11-15'
        );
		
		$this->CI->db->insert('tbl_offer',$data);
		$affectedRows = $this->CI->db->affected_rows();

		$this->assertEquals(1, $affectedRows);
	}
	
	
	public function testGetOffer(){
		$offer_ID = 2;
		$data = $this->CI->factory->getOffer($offer_ID);
		$this->assertNotEquals(false, $data);
	}
	
	
	
			
	// ------------------------------------------------------------------------
	
}

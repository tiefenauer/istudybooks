<?php
require_once('../main/php/webapp/application/controllers/offers.php');
class offerTest extends PHPUnit_Framework_TestCase {
	
	public function setUp(){
		$offers = new Offers();
	}
	public function tearDown(){ }
	public function testConnectionIsValid()
  {
    // test to ensure that the object from an fsockopen is valid
    $connObj = new RemoteConnect();
    $serverName = 'www.google.com';
    $this->assertTrue($connObj->connectToServer($serverName) !== false);
  }
  
}
?>
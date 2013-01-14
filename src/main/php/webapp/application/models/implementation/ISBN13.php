<?php
include_once("ISBN.php");
include_once("ISBN10.php");


class ISBN13 extends CI_Model implements ISBN {
	
	private $prefix = '978'; // 978 or 979
	private $isbn10;
	
	/**
	 * Constructor
	 * @param isbn = 
	 */
	public function __construct($isbn = '') {
		parent::__construct();
		if ($isbn != ''){
			$this->prefix = substr($isbn,0, 3);
			$this->isbn10 = new ISBN10(substr($isbn, 4, strlen($isbn)));
		}
	}
	
	public function getPrefix() {
		return 	$this->prefix + 
				$this->$isbn10->getPrefix();
	}
	
	public function getCountry() {
		 return $this->isbn10->getCountry(); 
	}
	public function getPublisher() {
		 return $this->isbn10->getPublisher(); 
	}
	public function getTitle() {
		 return $this->isbn10->getTitle(); 
	}
	public function getChecksum() {
		 return $this->isbn10->getChecksum(); 
	}
	public function getISBNString($delim = '-') {
		return 	$this->prefix
				. $delim 
				. $this->isbn10->getISBNString($delim)
				;
	}
	public function getISBNNumber() {
		return (int) $this->prefix + $this->isbn10->getISBNNumber();
	}
	
	public function __toString(){
		return $this->getISBNString();
	}
}


?>
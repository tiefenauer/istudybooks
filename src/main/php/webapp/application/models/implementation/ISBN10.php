<?php

class ISBN10 extends CI_Model implements ISBN {
	
	// ISBN regex from : http://regexlib.com/REDetails.aspx?regexp_id=1747&AspxAutoDetectCookieSupport=1
	// Matches
	private $isbn_regex = 'ISBN(-1(?:(0)|3))?:?\x20+(?(1)(?(2)(?:(?=.{13}$)\d{1,5}([ -])\d{1,7}\3\d{1,6}\3(?:\d|x)$)|(?:(?=.{17}$)97(?:8|9)([ -])\d{1,5}\4\d{1,7}\4\d{1,6}\4\d$))|(?(.{13}$)(?:\d{1,5}([ -])\d{1,7}\5\d{1,6}\5(?:\d|x)$)|(?:(?=.{17}$)97(?:8|9)([ -])\d{1,5}\6\d{1,7}\6\d{1,6}\6\d$)))';
	
	// Private vars/components
	private $country = 0; // default: English
	private $publisher = 0;
	private $title = 0;
	private $checksum = 0;
	
	/**
	 * Constructor
	 * @param isbn = 
	 */
	public function __construct($isbn='') {
		parent::__construct();
		
		switch (gettype($isbn)) {
			// construct ISBN from number
			case 'integer':
				$this->fromInt($isbn);
				break;
			// construct ISBN from string 
			case 'string':
				$this->fromString($isbn);
				break;
			// other initialization formats not supported
			default:
				continue;
				break;
		}
	}
	
	private function fromInt($isbn){
		$str = '' + $isbn;
		// To do: calculate correct string from number
		fromString(substr($str,0,2) + substr($str, 0, 2) + substr($str, 0, 2));		
	}
	
	private function fromString($isbn){
		if (strlen($isbn) > 0) {
			$parts = explode('-', $isbn);
			$this->country = $parts[0];		
			$this->publisher = $parts[1];		
			$this->title = $parts[2];
		}		
	}
	
	public function getPrefix(){
		return '';
	}
	public function getCountry() {
		 return $this->country; 
	}
	public function getPublisher() {
		return $this->publisher;
	}
	public function getTitle() {
		return $this->title;
	}
	public function getChecksum() {
		return 0;
	}
	public function getISBNString($delim = '-') {
		return 	'' .
				$this->country . 
				$delim .
				$this->publisher . 
				$delim . 
				$this->title . 
				$delim . 
				$this->getChecksum();  
	}
	public function getISBNNumber() {
		return (int) $this->country + $this->publisher + $this->title + $this->this->getChecksum();
	}
	
	
}


?>
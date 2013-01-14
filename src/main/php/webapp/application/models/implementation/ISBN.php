<?php

	/**
	 * ISBN-Interface zur Realisierung der ISBN-Nummern mit Strategy-pattern
	 */
	interface ISBN
	{
		// get Prefix if available
		public function getPrefix();
		// Country/Group Code
		public function getCountry();
		// Publisher Code
		public function getPublisher();
		// Title Code
		public function getTitle();
		// Get checksum value
		public function getChecksum();

		// Get ISBN number as formatted strings
	    public function getISBNString();
		// Get ISBN number as number
		public function getISBNNumber();
	}
	
?>
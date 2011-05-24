<?php

require_once 'PHPUnit/Framework/TestSuite.php';

require_once 'unittests/VarProfileTest.php';

/**
 * Static test suite.
 */
class AllTests extends PHPUnit_Framework_TestSuite {
	
	/**
	 * Constructs the test suite handler.
	 */
	public function __construct() {
		$this->setName ( 'AllTests' );
		
		$this->addTestSuite ( 'VarProfileTest' );
	
	}
	
	/**
	 * Creates the suite.
	 */
	public static function suite() {
		return new self ();
	}
}


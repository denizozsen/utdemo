<?php

$thisScriptsPath = __FILE__;
set_include_path(get_include_path() . ':' . substr($thisScriptsPath, 0, strpos($thisScriptsPath, 'AllTests.php')));
require_once 'PHPUnit/Framework/TestSuite.php';

require_once 'unittests/classes/util/VarProfileTest.php';
require_once 'unittests/classes/shop/CS_ProductTest.php';
require_once 'unittests/classes/shop/CS_ProductEntryTest.php';
require_once 'unittests/classes/shop/CS_ShoppingCartTest.php';

/**
 * Static test suite.
 */
class AllTests extends PHPUnit_Framework_TestSuite
{
	/**
	 * Constructs the test suite handler.
	 */
	public function __construct()
	{
		$this->setName('AllTests');
		
		// Tests for util package
		$this->addTestSuite('VarProfileTest');
		
		// Tests for shop package
		$this->addTestSuite('ProductTest');
		$this->addTestSuite('ProductEntryTest');
		$this->addTestSuite('ShoppingCartTest');
	}
	
	/**
	 * Creates the suite.
	 */
	public static function suite()
	{
		return new self ();
	}
}


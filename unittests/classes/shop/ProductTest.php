<?php

require_once 'classes/shop/Product.php';

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * Product test case.
 */
class ProductTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp()
	{
		parent::setUp ();
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown()
	{
		parent::tearDown ();
	}
	
	public function testConstructor_noException()
	{
		new Product('1', 'Test Product', 'Test Category');
	}
}


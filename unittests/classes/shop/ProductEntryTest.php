<?php

require_once 'classes/shop/ProductEntry.php';

require_once 'unittests/classes/shop/stubs/StubProduct.php';
require_once 'unittests/classes/shop/stubs/StubProductEntry.php';

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * ProductEntry test case.
 */
class ProductEntryTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp()
	{
		parent::setUp();
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown()
	{
		parent::tearDown();
	}
	
	public function testConstructor_noExceptions()
	{
		new ProductEntry(new StubProduct(), 1);
	}
	
	public function testGetProduct()
	{
		// TODO Auto-generated ProductEntryTest->testGetProduct()
		$this->markTestIncomplete ( "getProduct test not implemented" );
	}
	
	public function testGetQuantity()
	{
		// TODO Auto-generated ProductEntryTest->testGetQuantity()
		$this->markTestIncomplete ( "getQuantity test not implemented" );
	}
	
	public function testSetQuantity()
	{
		// TODO Auto-generated ProductEntryTest->testSetQuantity()
		$this->markTestIncomplete ( "setQuantity test not implemented" );
	}
}

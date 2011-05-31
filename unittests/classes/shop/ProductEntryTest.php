<?php

require_once 'classes/shop/ProductEntry.php';

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
	
	/**
	 * Tests ProductEntry->__construct()
	 */
	public function testConstructor_noExceptions()
	{
		// TODO Auto-generated ProductEntryTest->test__construct()
		$this->markTestIncomplete ( "__construct test not implemented" );
		
		new ProductEntry(null, -1);
	}
	
	/**
	 * Tests ProductEntry->getProduct()
	 */
	public function testGetProduct()
	{
		// TODO Auto-generated ProductEntryTest->testGetProduct()
		$this->markTestIncomplete ( "getProduct test not implemented" );
	}
	
	/**
	 * Tests ProductEntry->getQuantity()
	 */
	public function testGetQuantity()
	{
		// TODO Auto-generated ProductEntryTest->testGetQuantity()
		$this->markTestIncomplete ( "getQuantity test not implemented" );
	}
	
	/**
	 * Tests ProductEntry->setQuantity()
	 */
	public function testSetQuantity()
	{
		// TODO Auto-generated ProductEntryTest->testSetQuantity()
		$this->markTestIncomplete ( "setQuantity test not implemented" );
	}
}

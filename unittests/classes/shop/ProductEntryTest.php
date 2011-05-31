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
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testConstructor_exceptionIfNullProduct()
	{
		new ProductEntry(null, 1);
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testConstructor_exceptionIfNullQuantity()
	{
		new ProductEntry(new StubProduct(), null);
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testConstructor_exceptionIfNonNumericQuantity()
	{
		new ProductEntry(new StubProduct(), 'dasasds');
	}
	
	public function testGetProduct()
	{
		$product = new StubProduct();
		$pe = new ProductEntry($product, 1);
		$this->assertSame($product, $pe->getProduct());
	}
	
	public function testGetQuantity()
	{
		$quantity = 23;
		$pe = new ProductEntry(new StubProduct(), $quantity);
		$this->assertSame($quantity, $pe->getQuantity());
	}
	
	public function testSetQuantity()
	{
		$quantity = 11;
		$pe = new ProductEntry(new StubProduct(), 4);
		$pe->setQuantity($quantity);
		$this->assertSame($quantity, $pe->getQuantity());
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testSetQuantity_exceptionIfNullArg()
	{
		$pe = new ProductEntry(new StubProduct(), 4);
		$pe->setQuantity(null);
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testSetQuantity_exceptionIfNonNumericArg()
	{
		$pe = new ProductEntry(new StubProduct(), 'sdfd');
		$pe->setQuantity(null);
	}
}

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
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testConstructor_exceptionIfNullId()
	{
		new Product(null, 'Test Product', 'Test Category');
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testConstructor_exceptionIfNonNumericId()
	{
		new Product('aasds', 'Test Product', 'Test Category');
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testConstructor_exceptionIfNullName()
	{
		new Product('1', null, 'Test Category');
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testConstructor_exceptionIfEmptyName()
	{
		new Product('1', '', 'Test Category');
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testConstructor_exceptionIfNullCategory()
	{
		new Product('1', 'Test Product', null);
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testConstructor_exceptionIfEmptyCategory()
	{
		new Product('1', 'Test Product', '');
	}
}


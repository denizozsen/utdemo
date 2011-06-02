<?php

require_once 'classes/shop/Product.php';

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * Product test case.
 */
class ProductTest extends PHPUnit_Framework_TestCase
{
	public function testConstructor_noException()
	{
		new Product(1, 'Test Product', 'Test Category');
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
	public function testConstructor_exceptionIfNonIntegerId()
	{
		new Product('aasds', 'Test Product', 'Test Category');
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testConstructor_exceptionIfNullName()
	{
		new Product(1, null, 'Test Category');
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testConstructor_exceptionIfEmptyName()
	{
		new Product(1, '', 'Test Category');
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testConstructor_exceptionIfNullCategory()
	{
		new Product(1, 'Test Product', null);
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testConstructor_exceptionIfEmptyCategory()
	{
		new Product(1, 'Test Product', '');
	}
	
	public function testGetId()
	{
		$id = 3212;
		$product = new Product($id, 'Test Product', 'Test Category');
		$this->assertEquals($id, $product->getId());
	}
	
	public function testGetName()
	{
		$name = 'My Test Name!!';
		$product = new Product(1, $name, 'Test Category');
		$this->assertEquals($name, $product->getName());
	}
	
	public function testGetCategory()
	{
		$category = 'A Test Category';
		$product = new Product(1, 'Test Product', $category);
		$this->assertEquals($category, $product->getCategory());
	}
}


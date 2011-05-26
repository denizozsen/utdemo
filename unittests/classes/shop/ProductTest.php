<?php

require_once 'classes/shop/Product.php';

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * Product test case.
 */
class ProductTest extends PHPUnit_Framework_TestCase
{	
	/**
	 * @var Product
	 */
	private $Product;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp()
	{
		parent::setUp ();
		
		// TODO Auto-generated ProductTest::setUp()
		

		$this->Product = new Product(/* parameters */);
	
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown()
	{
		// TODO Auto-generated ProductTest::tearDown()
		

		$this->Product = null;
		
		parent::tearDown ();
	}
	
	public function testConstructor_noException()
	{
		
	}
}


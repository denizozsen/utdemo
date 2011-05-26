<?php

require_once 'classes/shop/ShoppingCart.php';

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * ShoppingCart test case.
 */
class ShoppingCartTest extends PHPUnit_Framework_TestCase
{	
	/**
	 * @var ShoppingCart
	 */
	private $ShoppingCart;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp()
	{
		parent::setUp ();
		
		// TODO Auto-generated ShoppingCartTest::setUp()
		

		$this->ShoppingCart = new ShoppingCart(/* parameters */);
	
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		// TODO Auto-generated ShoppingCartTest::tearDown()
		

		$this->ShoppingCart = null;
		
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}
	
	/**
	 * Tests ShoppingCart->addProductEntry()
	 */
	public function testAddProductEntry() {
		// TODO Auto-generated ShoppingCartTest->testAddProductEntry()
		$this->markTestIncomplete ( "addProductEntry test not implemented" );
		
		$this->ShoppingCart->addProductEntry(/* parameters */);
	
	}
	
	/**
	 * Tests ShoppingCart->adjustProductQuantity()
	 */
	public function testAdjustProductQuantity() {
		// TODO Auto-generated ShoppingCartTest->testAdjustProductQuantity()
		$this->markTestIncomplete ( "adjustProductQuantity test not implemented" );
		
		$this->ShoppingCart->adjustProductQuantity(/* parameters */);
	
	}

}


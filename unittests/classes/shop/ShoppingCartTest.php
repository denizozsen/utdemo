<?php

require_once 'classes/shop/ShoppingCart.php';

require_once 'unittests/classes/shop/stubs/StubProduct.php';

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * ShoppingCart test case.
 */
class ShoppingCartTest extends PHPUnit_Framework_TestCase
{
	public function testAddProductEntry_noException()
	{
		$cart = new ShoppingCart();
		$cart->addProductEntry(new StubProduct(), 1);
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testAddProductEntry_exceptionOnNullProduct()
	{
		$cart = new ShoppingCart();
		$cart->addProductEntry(null, 1);
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testAddProductEntry_exceptionOnNullQuantity()
	{
		$cart = new ShoppingCart();
		$cart->addProductEntry(new StubProduct(), null);
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testAddProductEntry_exceptionOnDecimalQuantity()
	{
		$cart = new ShoppingCart();
		$cart->addProductEntry(new StubProduct(), 312.232);
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testAddProductEntry_exceptionOnStringQuantity()
	{
		$cart = new ShoppingCart();
		$cart->addProductEntry(new StubProduct(), 'dasds');
	}
	
	public function testAdjustProductQuantity_noException()
	{
		$cart = new ShoppingCart();
		$cart->addProductEntry(new StubProduct(1), 1);
		$cart->adjustProductQuantity(1, 1);
	}
	
	/**
	 * @expectedException OutOfRangeException
	 */
	public function testAdjustProductQuantity_exceptionOnNonExistingProductId()
	{
		$cart = new ShoppingCart();
		$cart->adjustProductQuantity(1, 1);
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testAdjustProductQuantity_exceptionOnNullProductId()
	{
		$cart = new ShoppingCart();
		$cart->adjustProductQuantity(null, 1);
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testAdjustProductQuantity_exceptionOnNonIntegerProductId()
	{
		$cart = new ShoppingCart();
		$cart->adjustProductQuantity(132.232, 1);
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testAdjustProductQuantity_exceptionOnNullQuantityDiff()
	{
		$cart = new ShoppingCart();
		$cart->adjustProductQuantity(1, null);
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testAdjustProductQuantity_exceptionOnDecimalQuantityDiff()
	{
		$cart = new ShoppingCart();
		$cart->adjustProductQuantity(1, 1.232);
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testAdjustProductQuantity_exceptionOnStringQuantityDiff()
	{
		$cart = new ShoppingCart();
		$cart->adjustProductQuantity(1, 'asdsdas');
	}
	
	public function testGetProductEntries_emptyInitially()
	{
		$cart = new ShoppingCart();
		$this->assertEquals(0, count($cart->getProductEntries()));
	}
	
	public function testGetProductEntries_oneEntryAfterAddingOne()
	{
		$cart = new ShoppingCart();
		$cart->addProductEntry(new StubProduct(), 32);
		$this->assertEquals(1, count($cart->getProductEntries()));
	}
	
	public function testGetProductEntries_correctNumberOfEntriesAfterAddingSeveral()
	{
		$cart = new ShoppingCart();
		for($i = 1; $i <= 100; ++$i) {
			$cart->addProductEntry(new StubProduct($i), 1);
			$this->assertEquals($i, count($cart->getProductEntries()));
		}
	}
	
	public function testGetProductEntries_correctNumberOfEntriesAfterAddingWithSameId()
	{
		$id = 3;
		
		$cart = new ShoppingCart();
		$cart->addProductEntry(new StubProduct($id), 32);
		$cart->addProductEntry(new StubProduct($id), 32);
		$cart->addProductEntry(new StubProduct($id), 32);
		
		$this->assertEquals(1, count($cart->getProductEntries()));
	}
	
	public function testGetProductEntries_correctNumberOfEntriesAfterAddingWithSameId_forSeveralIds()
	{
		$id1 = 1;
		$id2 = 2;
		$id3 = 3;
		
		$cart = new ShoppingCart();
		$cart->addProductEntry(new StubProduct($id1), 1);
		$cart->addProductEntry(new StubProduct($id1), 1);
		$cart->addProductEntry(new StubProduct($id2), 7);
		$cart->addProductEntry(new StubProduct($id3), 4);
		$cart->addProductEntry(new StubProduct($id3), 1);
		$cart->addProductEntry(new StubProduct($id3), 2);
		$cart->addProductEntry(new StubProduct($id3), 1);
		
		$this->assertEquals(3, count($cart->getProductEntries()));
		
		// Also check the quantities for each entry
		foreach($cart->getProductEntries() as $entry) {
			switch($entry->getProduct()->getId()) {
				case 1:
					$this->assertEquals(2, $entry->getQuantity());
					break;
				case 2:
					$this->assertEquals(7, $entry->getQuantity());
					break;
				case 3:
					$this->assertEquals(8, $entry->getQuantity());
					break;
			}
		}
	}
	
	public function testGetProductEntries_correctQuantitiesAfterAddingWithSameId()
	{
		$cart = new ShoppingCart();
	}
	
	public function testGetProductEntries_correctAfterCallingAdjustProductQuantity()
	{
		$cart = new ShoppingCart();
	}
}


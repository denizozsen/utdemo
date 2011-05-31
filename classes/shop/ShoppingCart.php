<?php

require_once 'classes/shop/ProductEntry.php';

/**
 * The shopping cart object holds the products that the user has chosen to
 * included in a potential order.
 * 
 * @author deniz
 */
class ShoppingCart
{
	private $productEntries = array();
	
	/**
	 * Retrieve the product entries held by the shopping cart.
	 */
	public function getProductEntries()
	{
		return $this->productEntries;
	}
	
	/**
	 * Add a product entry to the shopping cart.
	 * 
	 * @param Product $product
	 * @param integer $quantity
	 */
	public function addProductEntry($product, $quantity)
	{
		// If an entry with the same product already exists, add the quantity
		// to the existing entry
		foreach($this->productEntries as $entry) {
			$productFromEntry = $entry->getProduct();
			if ($product->getId() == $productFromEntry->getId()) {
				$entry->setQuantity($entry->getQuantity() + $quantity);
				return;
			}
		}
		
		// If an entry with the same product does not exist, create a new entry
		$this->productEntries[] = new ProductEntry($product, $quantity);
	}
	
	/**
	 * Modify the quantity of a product for which an entry exists in the
	 * shopping basket.
	 * 
	 * @param integer $productId
	 * @param integer $quantityDiff
	 */
	public function adjustProductQuantity($productId, $quantityDiff)
	{
		foreach($this->productEntries as $entry) {
			$productFromEntry = $entry->getProduct();
			if ($productFromEntry->getId() == $productId) {
				$entry->setQuantity($entry->getQuantity() + $quantityDiff);
				break;
			}
		}
	}
}

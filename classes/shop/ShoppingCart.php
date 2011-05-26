<?php

require_once 'classes/shop/ProductEntry.php';

class ShoppingCart
{
	private $productEntries = array();
	
	public function getProductEntries()
	{
		return $this->productEntries;
	}
	
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

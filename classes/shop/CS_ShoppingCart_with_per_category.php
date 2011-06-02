<?php

require_once 'classes/shop/ProductEntry.php';

/**
 * The shopping cart object holds the products that the user has chosen to
 * include in a potential order.
 * 
 * @author deniz
 */
class ShoppingCart
{
	private $productEntries = array();
	
	/**
	 * Retrieves the product entries held by the shopping cart.
	 */
	public function getProductEntries()
	{
		return $this->productEntries;
	}
	
	public function getProductEntriesByCategory()
	{
	    return $this->productEntries;
	}
	
	/**
	 * Adds a product entry to the shopping cart.
	 * 
	 * @param Product $product
	 * @param integer $quantity
	 *
	 * @throws InvalidArgumentException if $product is not of type Product
	 *                                  or quantity is is not an integer
	 */
	public function addProductEntry($product, $quantity)
	{
		if ( is_null($product) || !($product instanceof Product) ) {
			throw new InvalidArgumentException('product argument must be of type Product');
		}
		
		if ( is_null($quantity) || !is_int($quantity) || !($quantity > 0) ) {
			throw new InvalidArgumentException('quantity argument must be a positive integer');
		}
		
		if (!isset($this->productEntries[$product->getCategory()])) {
		    $this->productEntries[$product->getCategory()] = array();
		} else {
    		// If an entry with the same product already exists, add the quantity
    		// to the existing entry
    		foreach($this->productEntries[$product->getCategory()] as $entry) {
    			$productFromEntry = $entry->getProduct();
    			if ($product->getId() == $productFromEntry->getId()) {
    				$entry->setQuantity($entry->getQuantity() + $quantity);
    				return;
    			}
    		}
		}
		
		// If an entry with the same product does not exist, create a new entry
		$this->productEntries[$product->getCategory()][] = new ProductEntry($product, $quantity);
	}
	
	/**
	 * Modifies the quantity of a product for which an entry exists in the
	 * shopping basket.
	 * 
	 * Removes a product entry, if its quantity becomes zero, as a result of
	 * the adjustment.
	 * 
	 * @param integer $productId
	 * @param integer $quantityDiff
	 * 
	 * @throws InvalidArgumentException if either argument is not an integer
	 * @throws OutOfRangeException if an entry with the given product id is not found
	 */
	public function adjustProductQuantity($productId, $quantityDiff)
	{
		if ( is_null($productId) || !is_int($productId) ) {
			throw new InvalidArgumentException('productId argument must be an integer');
		}
		if ( is_null($quantityDiff) || !is_int($quantityDiff) ) {
			throw new InvalidArgumentException('quantityDiff argument must be an integer');
		}
		
		foreach($this->productEntries as $i => $entry) {
			$productFromEntry = $entry->getProduct();
			if ($productFromEntry->getId() == $productId) {
			    
			    // If quantity becomes 0, remove the entry altogether
			    if (0 == $entry->getQuantity() + $quantityDiff) {
			        array_splice($this->productEntries, $i, 1);
			        return;
			    }
			    
				$entry->setQuantity($entry->getQuantity() + $quantityDiff);
				return;
				
			}
		}
		
		throw new OutOfRangeException("No entry found with product id {$productId}");
	}
}

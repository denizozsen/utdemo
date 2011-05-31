<?php

/**
 * A product entry describes a product in the shopping basket and the quantity
 * that the customer would like to order.
 * 
 * @author deniz
 */
class ProductEntry
{
	private $product;
	private $quantity;
	
	public function __construct($product, $quantity)
	{
		$this->product  = $product;
		$this->quantity = $quantity;
	}
	
	/**
	 * Returns the product described by the product entry.
	 */
	public function getProduct()
	{
		return $this->product;
	}
	
	/**
	 * Answers the quantity of the product that the customer wishes to order.
	 */
	public function getQuantity()
	{
		return $this->quantity;
	}
	
	/**
	 * Sets the quantity of the product that the customer wishes to order.
	 * 
	 * @param integer $quantity
	 */
	public function setQuantity($quantity)
	{
		$this->quantity = $quantity;
	}
}

?>
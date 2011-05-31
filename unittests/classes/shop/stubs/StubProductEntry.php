<?php

class StubProductEntry
{
	private $product;
	private $quantity;
	
	public function __construct($product = null, $quantity = 1)
	{
		$this->product  = ($product == null) ? new MockProduct() : $product;
		$this->quantity = $quantity;
	}
	
	public function getProduct()
	{
		return $this->product;
	}
	
	public function getQuantity()
	{
		return $this->quantity;
	}
	
	public function setQuantity($quantity)
	{
		$this->quantity = $quantity;
	}
}

?>
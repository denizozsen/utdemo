<?php

/**
 * A Product object describes all the attributes of a product in a shop.
 * 
 * @author deniz
 */
class Product
{
	private $id;
	private $name;
	private $category;
	
	/**
	 * Creates a new Product object.
	 * 
	 * @param integer $id
	 * @param string $name
	 * @param string $category
	 * 
	 * @throws InvalidArgumentException if the id argument is not an integer,
	 *                                  or the name argument is null or empty,
	 *                                  or the category argument is null or empty
	 */
	public function __construct($id, $name, $category)
	{
		if ( is_null($id) || !is_int($id) ) {
			throw new InvalidArgumentException('id argument must be an integer');
		}
		if ( is_null($name) || !is_string($name) || ('' == trim($name)) ) {
			throw new InvalidArgumentException('name argument must be a non-empty string');
		}
		if ( is_null($category) || !is_string($category) || ('' == trim($category)) ) {
			throw new InvalidArgumentException('category argument must be a non-empty string');
		}
		
		$this->id       = $id;
		$this->name     = $name;
		$this->category = $category;
	}
	
	/**
	 * Returns the ID for the product.
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * Returns the name of the product.
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * Returns the category to which the product belongs.
	 */
	public function getCategory()
	{
		return $this->category;
	}
}

?>
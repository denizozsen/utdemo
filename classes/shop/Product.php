<?php

class Product
{
	private $id;
	private $name;
	private $category;
	
	public function __construct($id, $name, $category)
	{
		if ( is_null($id) || !is_numeric($id) ) {
			throw new InvalidArgumentException('id argument must be numeric');
		}
		if ( is_null($name) || ('' == trim($name)) ) {
			throw new InvalidArgumentException('name argument must be specified');
		}
		if ( is_null($category) || ('' == trim($category)) ) {
			throw new InvalidArgumentException('category argument must be specified');
		}
		
		$this->id       = $id;
		$this->name     = $name;
		$this->category = $category;
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function getCategory()
	{
		return $this->category;
	}
}

?>
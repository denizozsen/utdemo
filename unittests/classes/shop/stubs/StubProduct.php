<?php

class StubProduct extends Product
{
	private $id;
	private $name;
	private $category;
	
	public function __construct($id = null, $name = null, $category = null)
	{
		$this->id       = is_null($id)       ? 1                         : $id;
		$this->name     = is_null($name)     ? '[Stub Product]'          : $name;
		$this->category = is_null($category) ? '[Stub Product Category]' : $category;
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
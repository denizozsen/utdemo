<?php

class StubProduct extends Product
{
	public function __construct()
	{
		// Zero-arg constructor, which is not generated by default, since
		// the base class Product only has a non-zero-arg constructor
	}
	
	public function getId()
	{
		return 1;
	}
	
	public function getName()
	{
		return '[Mock Product]';
	}
	
	public function getCategory()
	{
		return '[Mock Category]';
	}
}

?>
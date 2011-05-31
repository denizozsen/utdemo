<?php

class MockProduct extends Product
{
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
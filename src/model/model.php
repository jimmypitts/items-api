<?php

class Model_Model
{

	static function alloc()
	{
		$class = get_called_class();
		return new $class;
	}

}
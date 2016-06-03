<?php

class Dao_Generated_Item extends Dao_Base
{

	private $fields = array(
		'title',
		'description',
		'category',
		'price',
		'name',
		'latitude',
		'longitude',
		'status',
		'create_date',
	);

	function get_id()
	{
		return $this->var['id'];
	}

	function get_title()
	{
		return $this->var['title'];
	}

	function set_title($title)
	{
		$this->var['title'] = $title;
		$this->updated['title'] = TRUE;
	}

	function get_description()
	{
		return $this->var['description'];
	}

	function set_description($description)
	{
		$this->var['description'] = $description;
		$this->updated['description'] = TRUE;
	}

	function get_category()
	{
		return $this->var['category'];
	}

	function set_category($category)
	{
		$this->var['category'] = $category;
		$this->updated['category'] = TRUE;
	}

	function get_price()
	{
		return $this->var['price'];
	}

	function set_price($price)
	{
		$this->var['price'] = $price;
		$this->updated['price'] = TRUE;
	}

	function get_name()
	{
		return $this->var['name'];
	}

	function set_name($name)
	{
		$this->var['name'] = $name;
		$this->updated['name'] = TRUE;
	}

	function get_latitude()
	{
		return $this->var['latitude'];
	}

	function set_latitude($latitude)
	{
		$this->var['latitude'] = $latitude;
		$this->updated['latitude'] = TRUE;
	}

	function get_longitude()
	{
		return $this->var['longitude'];
	}

	function set_longitude($longitude)
	{
		$this->var['longitude'] = $longitude;
		$this->updated['longitude'] = TRUE;
	}

	function get_status()
	{
		return $this->var['status'];
	}

	function set_status($status)
	{
		$this->var['status'] = $status;
		$this->updated['status'] = TRUE;
	}

	function get_create_date()
	{
		return $this->var['create_date'];
	}	

	function set_create_date($create_date)
	{
		$this->var['create_date'] = $create_date;
		$this->updated['create_date'] = TRUE;
	}

	function init_with_data($row)
	{
		foreach ($this->fields as $field)
		{
			$this->var[$field] = isset($row[$field]) ? $row[$field] : NULL;
		}
	}

	function __construct()
	{
		$this->fields = array(
			'id',
			'title',
			'description',
			'category',
			'price',
			'name',
			'latitude',
			'longitude',
			'status',
			'create_date',
		);
	}

}
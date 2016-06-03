<?php

class Model_Item extends Model_Model
{
	private $dao;

	const STATUS_AVAILABLE = 'Available';
	const STATUS_PENDING = 'Pending';
	const STATUS_SOLD = 'Sold';
	const STATUS_EXPIRED = 'Expired';
	const STATUS_BANNED = 'Banned';

//----------------------------------------------------------------------------------- Getter/Setter
	function get_id()
	{
		return $this->dao->get_id();
	}

	function set_id($id) {
		$this->dao->set_id($id);
	}

	function get_title()
	{
		return $this->dao->get_title();
	}

	function set_title($title) {
		$this->dao->set_title($title);
	}

	function get_description()
	{
		return $this->dao->get_description();
	}

	function set_description($description) {
		$this->dao->set_description($description);
	}

	function get_category()
	{
		return $this->dao->get_category();
	}

	function set_category($category) {
		$this->dao->set_category($category);
	}

	function get_price()
	{
		return $this->dao->get_price();
	}

	function set_price($price) {
		$this->dao->set_price($price);
	}

	function get_name()
	{
		return $this->dao->get_name();
	}

	function set_name($name) {
		$this->dao->set_name($name);
	}

	function get_latitude()
	{
		return $this->dao->get_latitude();
	}

	function set_latitude($latitude) {
		$this->dao->set_latitude($latitude);
	}

	function get_longitude()
	{
		return $this->dao->get_longitude();
	}

	function set_longitude($longitude) {
		$this->dao->set_longitude($longitude);
	}

	function get_status()
	{
		return $this->dao->get_status();
	}

	function set_status($status) {
		$this->dao->set_status($status);
	}

	function get_create_date()
	{
		return $this->dao->get_create_date();
	}

	function set_create_date($create_date)
	{
		$this->dao->set_create_date($create_date);
	}

	function is_banned()
	{
		return $this->get_status() == 'Banned';
	}

	function to_array()
	{
		$res = array();
		$res['id'] = $this->get_id();
		$res['title'] = $this->get_title();
		$res['description'] = $this->get_description();
		$res['category'] = $this->get_category();
		$res['price'] = $this->get_price();
		$res['latitude'] = $this->get_latitude();
		$res['longitude'] = $this->get_longitude();
		$res['status'] = $this->get_status();

		if (!$this->is_banned())
		{
			$res['name'] = $this->get_name();
			$res['create_date'] = $this->get_create_date();
		}

		return $res;
	}

// --------------------------------------------------------------------------------------- Override

	public static function get_items_by_seller_and_category($seller, $category)
	{
		$items = array();
		$item_daos = Dao_Item::get_items_by_seller_and_category($seller, $category);
		foreach ($item_daos as $dao)
		{
			$item = Model_Item::alloc();
			$item->init_with_dao($dao);
			$items[] = $item;
		}
		return $items;
	}

	public static function get_by_id($id)
	{
		$dao = Dao_Item::get_item_by_id($id);
		if (!$dao)
		{
			return NULL;
		}

		$item = Model_Item::alloc();
		$item->init_with_dao($dao);
		return $item;
	}

// ------------------------------------------------------------------------------------------- Init

	public function save()
	{
		$this->dao->save();
	}

	public function init()
	{
		$this->dao = new Dao_Item();
	}

	public function init_with_dao($dao)
	{
		$this->dao = $dao;
	}
	
}
<?php

class Dao_Item extends Dao_Generated_Item
{
	static $table = 'item';
	
	public static function get_items_by_seller_and_category($seller, $category)
	{
		$builder = new QueryBuilder();
		$builder->select('*', self::$table);

		if ($seller) {
			$builder->where('name', $seller);
		}

		if ($category) {
			$builder->where('category', $category);
		}

		$res = $builder->find_all();
		return self::new_result_from_list($res, 'Dao_Generated_Item');
	}

	public static function get_item_by_id($id)
	{
		$builder = new QueryBuilder();
		$builder->select('*', self::$table)->where('id', $id);

		$res = $builder->find_one();
		return self::new_result($res, 'Dao_Generated_Item');
	}
}
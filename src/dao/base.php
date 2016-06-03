<?php

class Dao_Base
{
	private $fields;
	private $var;
	private $updated;

	function __construct()
	{
		$this->fields = array();
		$this->var = array();
		$this->updated = array();
	}

	public static function new_result_from_list($res, $class)
	{
		$daos = array();
		foreach ($res as $row)
		{
			$dao = new $class;
			$dao->init_with_data($row);
			$daos[] = $dao;
		}
		return $daos;
	}

	public static function new_result($res, $class)
	{
		if (!$res)
		{
			return NULL;
		}

		$dao = new $class;
		$dao->init_with_data($res);
		return $dao;
	}
}
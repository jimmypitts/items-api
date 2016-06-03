<?php

class QueryBuilder {

	private $query;
	private $connection;

	function __construct() {
		$this->query = '';
		$this->connection = connect_db();
	}

	/**
	 * Add a 'select' operation to our query
	 **/
	public function select($selector, $table)
	{
		// Input can be array (for multiple columns), or a string (for single ex. '*')
		if (is_string($selector))
		{
			$selector = array($selector);
		}

		$this->query .= 'SELECT ' . implode(', ', $selector) . ' FROM ' . $table . PHP_EOL;
		return $this;
	}

	/**
	 * Add a 'where' operation to our query
	 **/
	public function where($selector, $subject, $operator='=')
	{
		$this->query .= 'WHERE ' . $selector . $operator . "'" . $subject . "'";
		return $this;
	}

	/**
	 * Make our query against the database
	 **/
	private function query()
	{
		// We can add query logging here if we want
		return $this->connection->query($this->query . ';');
	}

	/**
	 * Return a result from the database with more than one result
	 **/
	public function find_all()
	{
		$result = $this->query();
		if (!$result || $result->num_rows === 0)
		{
			return array();
		}

		$res = array();
		while ($row = $result->fetch_array(MYSQLI_ASSOC))
		{
			$res[] = $row;
		}
		return $res;
	}

	/**
	 * Return a result from the database with the first result
	 **/
	public function find_one()
	{
		$result = $this->query();
		if (!$result || $result->num_rows === 0)
		{
			return NULL;
		}
		return $result->fetch_assoc();
	}
}
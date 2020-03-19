<?php

namespace Api;

use \Exception;

abstract class AbstractType
{

	protected $value;

	public function __construct($value)
	{
		$this->value = $value;
	}

	static protected function error()
	{
		throw new Exception;
	}

	abstract public function getValue();

}

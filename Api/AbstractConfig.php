<?php

namespace Api;
use \Exception;

abstract class AbstractConfig{

	protected $methods;

	abstract protected function getMethods() : array;

	/**
	 * AbstractConfig constructor.
	 */
	public function __construct()
	{
		$this->methods = $this->getMethods();
	}

	/**
	 * @param string $name
	 * @return bool
	 */
	public function hasMethod(string $name) : bool{
		return array_key_exists($name, $this->methods) && class_exists($this->methods[$name]);
	}

	/**
	 * @param string $name
	 * @return string
	 *
	 * @throws Error
	 */
	public function getMethodClass(string $name) : string{

		if(!$this->hasMethod($name)){
			throw new Exception(Error::BAD_METHOD);
		}

		return $this->methods[$name];

	}

}
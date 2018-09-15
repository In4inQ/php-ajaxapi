<?php

/**
 * Class API_Types
 *
 * Управление типами
 */
namespace Api;

class Types{

	/**
	 * @var string
	 */
	protected $type;

	/**
	 * @var mixed
	 */
	protected $value;

	/**
	 * API_Types constructor.
	 *
	 * @param mixed $value
	 * @param mixed $type
	 *
	 * @return void
	 */
	public function __construct($value, string $type){

		$this->value = $value;
		$this->type = $type;

	}

	/**
	 * modType
	 * Модификация типа
	 *
	 * @return mixed
	 */
	public function modType(){

		switch($this->type){

			case "string":
				return (string)$this->value;

			case "number":
				return abs((float)$this->value);

			case "array":

				if(is_string($this->value)){
					return explode(",", $this->value);
				}

				return (array)$this->value;

			case "boolean":
			case "bool":
				return (boolean)$this->value;

			case "object":
				if(is_string($this->value)) {
					return json_decode($this->value);
				}

				return $this->value;

			case "mixed":
			default:
				return $this->value;

		}

	}

	/**
	 * checkType
	 * Проверка типа
	 *
	 * @return bool
	 */
	public function checkType() : bool{

		switch($this->type){

			case "number":
				return is_numeric($this->value);

			case "object":
				return is_array($this->value) || is_object($this->value) || is_object(json_decode($this->value));

			default:
				return true;

		}

	}
	
}
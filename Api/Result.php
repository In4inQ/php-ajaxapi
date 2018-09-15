<?php

/**
 * Class API_Result
 *
 * Подача результата
 */
namespace Api;

class Result{

	/**
	 * @var mixed
	 */
	public $error;

	/**
	 * @var mixed
	 */
	public $result;

	/**
	 * API_Result constructor.
	 *
	 * @param mixed $error
	 * @param mixed $result
	 *
	 * @return void
	 */
	public function __construct($error, $result = null){

		$this->error = $error;
		$this->result = $result;

	}

	/**
	 * @return false|string
	 */
	public function __toString() : string
	{
		return json_encode([
			'error' => $this->error,
			'result' => $this->result
		]);
	}

}
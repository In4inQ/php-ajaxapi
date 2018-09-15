<?php

namespace Api;

use \Exception;

class Error extends Exception{

	const NO_OPTION = "Where the `{var}` option?";
	const BAD_OPTION = "Option {var} is other type!";
	const SERVER_ERROR = "Server Error";
	const BAD_METHOD = "Method not found on server";
	const NEED_AUTH = "Need Auth";

	/**
	 * @var array
	 */
	protected $vars;

	/**
	 * API_Error constructor.
	 *
	 * @param string $key
	 * @param array $vars
	 *
	 * @return void
	 */
	public function __construct(string $error, array $vars = []){

		$this->vars = $vars;

		parent::__construct($error, 0, null);

	}

	/**
	 * __toString
	 *
	 * @return string
	 */
	public function __toString() : string{

		return str_replace(
			array_keys($this->vars),
			array_values($this->vars),
			$this->message
		);

	}

}

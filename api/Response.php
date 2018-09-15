<?php

namespace Api;
class Response{

	/**
	 * @var array
	 */
	public $get;
	public $post;
	public $files;
	public $cookie;

	/**
	 * API_Response constructor.
	 */
	public function __construct(){

		$this->get = $_GET;
		$this->post = $_POST;
		$this->files = $_FILES;
		$this->cookie = $_COOKIE;

	}

	/**
	 * @param string $name
	 * @return null|string
	 */
	public function getPost(string $name) : ?string{
		return array_key_exists($name, $this->post) ? $this->post[$name] : null;
	}

	/**
	 * @param string $name
	 * @return array|null
	 */
	public function getFiles(string $name) : ?array{
		return array_key_exists($name, $this->files) ? $this->files[$name] : null;
	}

	/**
	 * @param string $name
	 * @return null|string
	 */
	public function getParam(string $name) : ?string{
		return array_key_exists($name, $this->get) ? urldecode($this->get[$name]) : null;
	}

	/**
	 * @param string $name
	 * @return null|string
	 */
	public function getCookie(string $name) : ?string{
		return array_key_exists($name, $this->cookie) ? $this->cookie[$name] : null;
	}
	
}
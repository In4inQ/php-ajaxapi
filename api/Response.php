<?php

namespace Api;
class Response{

	/**
	 * @var array
	 */
	public $get = [];
	public $post = [];
	public $files = [];
	public $cookie = [];
//	public $json = [];

	/**
	 * API_Response constructor.
	 */
	public function __construct(){

		$this->post = $_POST;
		$this->files = $_FILES;
		$this->cookie = $_COOKIE;

		$this->get = array_map('urldecode', $_GET);

//		if(stripos($_SERVER["CONTENT_TYPE"], 'application/json')){
//			$data = file_get_contents('php://input');
//			$data = json_decode($data, true);
//			if($data){
//				$this->json = $data;
//			}
//		}


	}

//	/**
//	 * @param string $name
//	 * @return mixed|null
//	 */
//	public function getJson(string $name){
//		return array_key_exists($name, $this->json) ? $this->json[$name] : null;
//	}

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
		return array_key_exists($name, $this->get) ? $this->get[$name] : null;
	}

	/**
	 * @param string $name
	 * @return null|string
	 */
	public function getCookie(string $name) : ?string{
		return array_key_exists($name, $this->cookie) ? $this->cookie[$name] : null;
	}
	
}
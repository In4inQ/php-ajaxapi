<?php
/**
 * Created by PhpStorm.
 * User: Виталий
 * Date: 13.09.2018
 * Time: 15:00
 */

namespace Api;

abstract class AbstractTemplate
{

	const DIR_TMP = __DIR__ . '/../../docs/';
	const DIR_SAVE = __DIR__ . '/../../userdocs/';

	public $file;
	public $filename;

	/**
	 * @return string
	 */
	abstract public function getFileName() : string;

	/**
	 * Template constructor.
	 * @param $filename
	 */
	public function __construct()
	{
		$this->open($this->getFileName());
	}

	/**
	 *
	 */
	public function open(string $filename){
		$this->filename = $filename;
		$this->file = file_get_contents($filename);
	}

	/**
	 * @return string
	 */
	public function get() : string{
		return $this->file;
	}

	/**
	 *
	 */
	public function save($filename = false){

		if(!$filename){
			$filename = $this->filename;
		}

		file_put_contents($filename, $this->file);
	}


	/**
	 * @param string $key
	 * @param string $value
	 */
	public function replace(array $data){
		$this->file = self::arrReplace($data, $this->file);
	}

	/**
	 * @param string $for
	 * @param array $data
	 */
	public function replaceFor(string $for, array $data){

		$this->file = preg_replace_callback('/\[\[' . $for . '\]\](.+?)\[\[\/' . $for . '\]\]/si', function($matches) use ($data){

			$res = '';

			foreach($data as $item){
				$res .= self::arrReplace($item, $matches[1]);
			}

			return $res;

		}, $this->file);

	}

	/**
	 * @param array $data
	 * @param string $str
	 * @return string
	 */
	static protected function arrReplace(array $data, string $str) : string{

		$keys = array_keys($data);
		$keys = array_map(function($e){
			return '{{' . $e . '}}';
		}, $keys);

		$values = array_values($data);

		return str_replace($keys, $values, $str);

	}


}
<?php

namespace Api;
use \Exception;

abstract class AbstractMethod{

	public $options;

	/**
	 * API_Method constructor.
	 *
	 * @return void
	 */
	public function __construct(){
		$this->options = $this->getOptions();
	}

	abstract protected function getOptions() : array;
	abstract protected function start(array $data);
	//

	/**
	 * execute
	 *
	 * @param array $data
	 *
	 * @return array ['error', 'result']
	 */
	public function execute(array $data) : Result{

		$response = null;
		$error = false;

		try{

			$newData = $this->buildData($data);
			$response = $this->start($newData);

		}catch (Exception $e){

			if($e instanceof Error){
				$error = (string)$e;
			}else{
				$error = $e->getMessage();
			}

		}finally{

			return new Result($error, $response);

		}


	}

	/**
	 * isOption
	 * 
	 * @param string $name
	 * 
	 * @return bool
	 */
	public function isOption(string $name){
		
		return array_key_exists($name, $this->options);
		
	}
	
	/**
	 * getOption
	 * 
	 * @param string $name
	 */
	public function getOption(string $name){

		return $this->isOption($name) ? $this->options[$name] : null;

	}

	/**
	 * Проверка и сбор переменных
	 *
	 * @param array $data
	 *
	 * @throws Error
	 * @return array
	 */
	protected function buildData(array $data) : array{

		$result = [];

		if(!$this->isOption('vars')){
			return $result;
		}

		foreach($this->getOption('vars') as $var => $var_data){

			if(!array_key_exists($var, $data)){

				if(array_key_exists('required', $var_data) && $var_data['required']){

					throw new Error(Error::NO_OPTION, ['{var}' => $var]);

				}elseif(array_key_exists('default', $var_data)){

					$value = $var_data['default'];

				}else{

					$value = null;

				}


			}else{

				$value = $data[$var];

			}

			//Проверка и модификация типа
			$value = new Types($value, array_key_exists('type', $var_data) ? $var_data['type'] : '');

			if(array_key_exists('strict', $var_data) && $var_data['strict'] && !$value->checkType()){
				throw new Error(Error::BAD_OPTION, ['{var}' => $var]);
			}

			$result[$var] = $value->modType();

		}

		return $result;

	}

}

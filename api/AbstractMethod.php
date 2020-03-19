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

			$response = $this->start(
				$this->buildData($data)
			);

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

					$value = '';

				}


			}else{

				$value = $data[$var];

			}

			//Проверка и модификация типа
			$defaultTypes = [
				'string' => Types\Str::class,
				'number' => Types\Number::class,
				'bool'   => Types\Boolean::class,
				'boolean' => Types\Boolean::class,
				'object'  => Types\Json::class,
				'array'   => Types\Arr::class,
				'mixed'   => Types\Mixed::class
			];

			$type = $var_data['type'];

			if(array_key_exists($type, $defaultTypes)){
				$type = $defaultTypes[$type];
			}

			if(class_exists($type)){

				$type = new $type($value);

				try{
					$result[$var] = $type->getValue();
				}catch (Exception $e){
					throw new Error(Error::BAD_OPTION, ['{var}' => $var]);
				}

			}else{
				throw new Error('Type {type} does`t exists', ['{type}' => $type]);
			}

		}

		return $result;

	}

}

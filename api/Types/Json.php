<?php
/**
 * Created by PhpStorm.
 * User: Виталий
 * Date: 19.03.2020
 * Time: 11:06
 */

namespace Api\Types;


class Json extends \Api\AbstractType
{

	public function getValue() : \stdClass
	{

		if(is_string($this->value)){
			$json = json_decode($this->value);
		}

		if(is_object($json) || is_array($json)){
			return $json;
		}

		self::error();

	}

}

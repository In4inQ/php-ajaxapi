<?php
/**
 * Created by PhpStorm.
 * User: Виталий
 * Date: 19.03.2020
 * Time: 11:06
 */

namespace Api\Types;


class Arr extends \Api\AbstractType
{

	public function getValue() : array
	{

		if(is_string($this->value)){
			return explode(",", $this->value);
		}

		self::error();

	}

}

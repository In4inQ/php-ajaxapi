<?php
/**
 * Created by PhpStorm.
 * User: Виталий
 * Date: 19.03.2020
 * Time: 10:56
 */

namespace Api\Types;

class Number extends \Api\AbstractType
{

	public function getValue() : float
	{

		if(is_numeric($this->value)){
			return (float)$this->value;
		}

		self::error();

	}

}

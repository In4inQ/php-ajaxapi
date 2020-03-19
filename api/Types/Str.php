<?php
/**
 * Created by PhpStorm.
 * User: Виталий
 * Date: 19.03.2020
 * Time: 10:56
 */

namespace Api\Types;


class Str extends \Api\AbstractType
{

	public function getValue() : string
	{
		return (string)$this->value;
	}

}

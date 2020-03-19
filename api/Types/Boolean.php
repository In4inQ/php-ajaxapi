<?php
/**
 * Created by PhpStorm.
 * User: Виталий
 * Date: 19.03.2020
 * Time: 10:56
 */

namespace Api\Types;


class Boolean extends \Api\AbstractType
{

	public function getValue() : bool
	{
		return (bool)$this->value;
	}

}

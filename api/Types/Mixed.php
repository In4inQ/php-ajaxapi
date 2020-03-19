<?php
/**
 * Created by PhpStorm.
 * User: Виталий
 * Date: 19.03.2020
 * Time: 11:26
 */

namespace Api\Types;


class Mixed extends \Api\AbstractType
{

	public function getValue()
	{
		return $this->value;
	}

}

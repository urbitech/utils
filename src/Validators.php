<?php

namespace URBITECH\Utils;

use Nette\Utils\Strings;

class Validators
{


	public static function validatePostCode($postCode)
	{
		$regexp = "\x01^(?:^[0-9]{3} ?[0-9]{2}$)\\z\x01u";

		if (!Strings::match($postCode, $regexp)) {
			return false;
		}

		return true;
	}
	
}	
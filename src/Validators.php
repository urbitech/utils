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


	public static function validateAddress($address)
	{

		if (
			Strings::length($address->getHouseNumber())
			&& Strings::length($address->getCity())
			&& Strings::length($address->getPostCode())
			&& Validators::validatePostCode($address->getPostCode())
		) {
			return true;
		}

		return false;
	}
}

<?php

namespace URBITECH\Utils;

use Nette\Utils\Strings;

class Address
{

	/** @var string */
	private	$street;

	private	$houseNumber;

	private $city;

	private $postCode;


	public function __construct($street, $houseNumber = null, $city, $postCode = NULL)
	{
		$this->street = $street;
		$this->houseNumber = $houseNumber;
		$this->city = $city;
		$this->postCode = $postCode;

		$zipCodePattern = '/^(\d{3}\s?)(\d{2})/';
		$streetPattern = '#^(.*[^0-9]+) (([a-zA-Z1-9])?([1-9][0-9]*)(/| )?)?([a-zA-Z1-9][0-9]*[a-zA-Z]?)( [A-Z]\/[0-9]{1,4})?$#';

		if (empty($this->postCode) && preg_match($zipCodePattern, $this->city)) {
			try {
				preg_match($zipCodePattern, $this->city, $matches);
				$city = Strings::replace($this->city, [$zipCodePattern => '']);
				$this->postCode = Strings::trim($matches[0]);
				$this->city = Strings::trim($city);
			} catch (\Nette\Utils\RegexpException $e) {
			}
		}

		if (empty($this->houseNumber) && preg_match($streetPattern, $this->street)) {
			try {
				$this->street = Strings::replace($this->street, ['/\s\/\s/' => '/']);
				preg_match($streetPattern, $this->street, $matches);
				$street = isset($matches[1]) ? $matches[1] : null;
				if (preg_match('/\b(č\.?\s?p\.?\s?|č\.?\s?ev?\.?\s?)\b/ui', $street, $m)) {
					$street = Strings::replace($street, ['/\b(č\.?\s?p\.?\s?|č\.?\s?ev?\.?\s?)\b/ui' => '']);
					$street = Strings::replace($street, ['/\./' => '']);
				}

				$this->houseNumber =  Strings::trim(Strings::replace($this->street, ['/' . $street . '/ui' => '']));
				$this->street = Strings::trim($street);
			} catch (\Nette\Utils\RegexpException $e) {
			}
		}
	}


	public function getFullAddress()
	{
		return $this->street . ' ' . $this->houseNumber . ', ' . $this->postCode . ' ' . $this->city;
	}


	public function getStreet()
	{
		return $this->street;
	}


	public function getHouseNumber()
	{
		return $this->houseNumber;
	}


	public function getCity()
	{
		return $this->city;
	}


	public function getPostCode()
	{
		return $this->postCode;
	}
}

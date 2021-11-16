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


	public function __construct($street, $city, $houseNumber = null, $postCode = NULL)
	{
		$this->street = $street;
		$this->city = $city;
		$this->houseNumber = $houseNumber;
		$this->postCode = $postCode;

		$zipCodePattern = '/^(\d{3}\s?)(\d{2})/';
		$streetPattern = '#^(.*[^0-9]+) (([a-zA-Z1-9])?([1-9][0-9]*)(\s?/| )?)?([a-zA-Z1-9][0-9]*[a-zA-Z]?)( [A-Z]\/[0-9]{1,4})?$#';

		if (empty($this->postCode) && preg_match($zipCodePattern, $this->city)) {
			try {
				preg_match($zipCodePattern, $this->city, $matches);
				$city = $this->city ? Strings::replace($this->city, [$zipCodePattern => '']) : null;
				$this->postCode = Strings::trim($matches[0]);
				$this->city = $city ? Strings::trim($city) : null;
			} catch (\Nette\Utils\RegexpException $e) {
			}
		}

		if (empty($this->houseNumber) && preg_match($streetPattern, $this->street)) {
			try {
				$this->street = $this->street ? Strings::replace($this->street, ['/\s\/\s/' => '/']) : null;
				preg_match($streetPattern, $this->street, $matches);
				$street = isset($matches[1]) ? $matches[1] : null;
				if (preg_match('/\b(č\.?\s?p\.?\s?|č\.?\s?ev?\.?\s?)\b/ui', $street, $m)) {
					$street = $street ? Strings::replace($street, ['/\b(č\.?\s?p\.?\s?|č\.?\s?ev?\.?\s?)\b/ui' => '']) : null;
					$street = $street ? Strings::replace($street, ['/\./' => '']) : null;
				}

				$this->houseNumber =  $this->street ? Strings::trim(Strings::replace($this->street, ['/' . $street . '/ui' => ''])) : null;
				$this->street = $street ? Strings::trim($street) : null;
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

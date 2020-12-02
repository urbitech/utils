<?php

namespace URBITECH\Utils;

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

		$pattern = '/^(\d{3}\s?)(\d{2})/';
		$streetPattern = '#^(.*[^0-9]+) (([a-zA-Z1-9])?([1-9][0-9]*)(/| )?)?([a-zA-Z1-9][0-9]*[a-zA-Z]?)( [A-Z]\/[0-9]{1,4})?$#';

		if (empty($this->postCode) && preg_match($pattern, $this->city)) {
			$city = preg_replace($pattern, '', $this->city);
			$this->postCode = trim(str_replace($city, '', $this->city));
			$this->city = trim($city);
		}

		if (empty($this->houseNumber) && preg_match($streetPattern, $this->street)) {
			preg_match($streetPattern, $this->street, $matches);
			$this->houseNumber = trim(str_replace($matches[1], '', $this->street));
			$this->street = trim($matches[1]);
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

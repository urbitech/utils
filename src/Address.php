<?php

namespace URBITECH\Utils;

class Address
{

	/** @var string */
	private	$street;

	private	$houseNumber;

	private $city;

	private $postCode;


	public function __construct($street, $houseNumber, $city, $postCode = NULL)
	{
		$this->street = $street;
		$this->houseNumber = $houseNumber;
		$this->city = $city;
		$this->postCode = $postCode;

		$pattern = '/^(\d{3}\s?)(\d{2})/';
		if ($this->postCode === null && preg_match($pattern, $this->city)) {
			$city = preg_replace($pattern, '', $this->city);
			$this->postCode = str_replace($city, '', $this->city);
			$this->city = $city;
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

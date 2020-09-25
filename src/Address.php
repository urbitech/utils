<?php

namespace URBITECH\Utils;

class Address
{

	/** @var string */
	private	$streetNumber;

	private $city;

	private $postCode;


	public function __construct($streetNumber, $city, $postCode = NULL)
	{
		$this->streetNumber = $streetNumber;
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
		return $this->streetNumber . ', ' . $this->postCode . ' ' . $this->city;
	}


	public function getStreetNumber()
	{
		return $this->streetNumber;
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

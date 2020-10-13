<?php

namespace URBITECH\Utils;

class Position
{

	/** @var string */
	private	$lat;

	private $lng;

	private $place;

	private $name;

	public function __construct($lat, $lng, $place = null, $name = null)
	{
		$this->lat = $lat;
		$this->lng = $lng;
		$this->place = $place;
		$this->name = $name;
	}


	public function getFullPostion()
	{
		return $this->lat . $this->lng;
	}


	public function getLatitude()
	{
		return $this->lat;
	}


	public function getLongitude()
	{
		return $this->lng;
	}


	public function getPlace()
	{
		return $this->place;
	}


	public function getName()
	{
		return $this->name;
	}
}

<?php

namespace URBITECH\Utils;

class Position
{

	/** @var string */
	private	$lat;

	private $lon;


	public function __construct($lat, $lon)
	{
		$this->lat = $lat;
		$this->lon = $lon;
	}


	public function getFullPostion()
	{
		return $this->lat . $this->lon;
	}


	public function getLatitude ()
	{
		return $this->lat;
	}


	public function getLongitude ()
	{
		return $this->lon;
	}

}
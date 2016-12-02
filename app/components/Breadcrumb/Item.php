<?php

namespace App\Components\Breadcrumb;

class Item extends \stdClass
{
	/** @var string */
	public $title = "";

	/** @var string */
	public $link = "";


	/**
	 * @param string $name
	 * @param string $destination
	 * @param array $args
	 */
	public function __construct($name, $destination, array $args)
	{
		$this->name = $name;
		$this->destination = $destination;
		$this->args = $args;
	}


	/**
	 * magic setter
	 * @param string $name
	 * @param array $arguments
	 * @return $this
	 */
	public function __call($name, array $arguments)
	{
		if(strpos($name, "set") === 0){
			$var = lcfirst(substr($name, 3));
			$this->$var = $arguments[0];

			return $this;
		}
	}
}
<?php

namespace App\Components\Breadcrumb;

use Nette\Application\UI;

class Control extends UI\Control
{
	/** @var string */
	protected $templateFile = "default.latte";

	/** @var array */
	protected $items = array();


	/**
	 * @param string $fileName
	 * @return $this
	 */
	public function setTemplateFile($fileName)
	{
		$this->templateFile = $fileName;
		return $this;
	}


	/**
	 * @param string $name
	 * @param string $destination
	 * @param array $args
	 * @return Item
	 */
	public function add($name, $destination, $args = array())
	{
		return $this->items[] = new Item($name, $destination, $args);
	}


	public function render()
	{
		foreach ($this->items as $item) {
			if (!$item->link) $item->link = $this->presenter->link($item->destination, $item->args);
			if (!$item->title) $item->title = $item->name;
		}

		$this->template->setFile(__DIR__ . "/" . $this->templateFile);
		$this->template->items = $this->items;
		$this->template->render();
	}
}
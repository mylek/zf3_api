<?php

namespace Application\Lib\Page;

class Factory implements FactoryInterface
{
	public function create(string $type) : Page
	{
		$type = strtolower($type);
		switch($type)
		{
			case 'test':
				return Test::getInstance();
			default:
				throw new \Exception('Type is not define');
		}
	}
}
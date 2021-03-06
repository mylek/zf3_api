<?php

namespace Application\Lib\Page;

class Factory implements FactoryInterface
{
	public function create(string $type) : Page
	{
		$type = strtolower($type);
		switch($type)
		{
			case 'efortuna':
				return new Efortuna();			
			case 'sts':
				return new Sts();
			default:
				throw new \Exception('Type is not define');
		}
	}
}
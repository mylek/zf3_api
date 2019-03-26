<?php

namespace Application\Lib\Bets;

use Application\Lib\Page\Factory;

class PagesCompare
{
	private $pagesList;
	private $matchs;
	
	public function __construct(array $pages)
	{
		$this->pagesList = $pages;
		$this->matchs = new MatchCollection();
		$this->init();
	}
	
	private function init()
	{
		$factory = new Factory();
		foreach($this->pagesList as $key => $row)
		{
			$matchs = $factory->create($row);
			$this->matchs->offsetSet($key, $matchs->getMatches());
		}
	}
	
	
}
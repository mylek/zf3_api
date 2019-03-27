<?php

namespace Application\Lib\Page;

use Application\Lib\Page\Factory;
use Application\Lib\Page\PagesCollection;

class PagesCompare
{
	private $pagesList;
	private $pages;
	private $scores;
	
	public function __construct(array $pages)
	{
		$this->pagesList = $pages;
		$this->pages = new PagesCollection();
		$this->init();
	}
	
	private function init()
	{
		$factory = new Factory();
		foreach($this->pagesList as $row)
		{
			$page = $factory->create($row);
			$this->pages->offsetSet($row, $page->getMatches());
		}
	}
	
	public function run()
	{
		foreach($this->pages as $pageName => $bets)
		{
			foreach($bets as $betName => $bet1)
			{
				$pageCompareName = $this->pages->findPageToCompare($betName, $pageName);
				if($pageCompareName != '')
				{
					echo $betName . "\r\n";
					$bet2 = $this->pages->offsetGet($pageCompareName)->offsetGet($betName);
					$this->compare([
						$pageName => $bet1,
						$pageCompareName => $bet2
					]);
				}
			}
			
			/*if(!empty($this->pages[$name][$name]))
			{
				$match1 = $this->pages[0][$name];
				$match2 = $this->pages[1][$name];
				$this->compare([$match1, $match2]);
				var_dump('======');
				///var_dump($match1Sum . ' -  ' . $match2Sum . ' = ' . ($match1Sum - $match2Sum));
			}*/
		}
	}
	
	private function compare(array $matchs)
	{
		$this->calculateRow('win', $matchs);
		$this->calculateRow('draw', matchs);
		$this->calculateRow('loss', matchs);
		
		var_dump($this->scores);
	}
	
	private function calculateRow(string $type, $matchs)
	{
		$score = 0.0;
		foreach($matchs as $pageName => $match)
		{
			var_dump($pageName);
			var_dump($match);
			if(0 == $score)
			{
				$score = (float)$match->{$type};
			}
			else
			{
				$score -= (float)$match->{$type};
			}
		}
		
		if($score > 0)
		{
			$this->setScore($type, 1, $score);
		}
		else
		{
			$this->setScore($type, 2, $score);
		}
	}
	
	private function setScore(string $type, string $page, float $score)
	{
		$this->scores[$type] = [
			'page' => $page,
			'score' => abs($score)
		];
	}
	
}
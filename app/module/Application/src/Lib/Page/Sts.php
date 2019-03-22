<?php

namespace Application\Lib\Page;

use Application\Lib\Bets\Bet;
use Application\Lib\Bets\BetCollection;

class Sts extends Page
{
	protected $url = 'https://www.sts.pl/pl/';
	
	public function getMatches()
	{
		$betsData = new BetCollection();
		$dom = $this->getPage('oferta/zaklady-bukmacherskie/zaklady-sportowe/?action=offer&sport=184&region=6521&league=4080');
		$bets = $this->getBetsDoc($dom, "//div[@class='bet_tab']//table//tbody//tr");
		foreach($bets as $row)
		{
			$bet = $this->parsedRow($row);
			$betsData->offsetSet($bet->getId(), $bet);
		}
		var_dump($betsData);
		die;
	}
	
	private function parsedRow(\DOMElement $row) : Bet
	{
		$table = $row->getElementsByTagName('table');
		$td = $row->getElementsByTagName('td');
		$url = $td->item(0)->getElementsByTagName('a')->item(0)->getAttribute('href');
		$params = parse_url($url);
		$urls = [];
		parse_str($params['query'], $urls);
		$td2 = $td->item(1)->getElementsByTagName('td');
		$team1 = trim(substr($td2->item(0)->textContent, 0, strlen($var)-6));
		$team2 = trim(substr($td2->item(2)->textContent, 0, strlen($var)-6));
		$bet = new Bet();
		$bet->setId((int)$urls['oppty']);
		$bet->setName($team1 . " " . $team2);
		$bet->setWin((float)$td2->item(0)->getElementsByTagName('span')->item(0)->nodeValue);
		$bet->setDraw((float)str_replace("\nX\n", '', $td->item(1)->nodeValue));
		$bet->setLoss((float)$td2->item(2)->getElementsByTagName('span')->item(0)->nodeValue);
		$bet->setWinDraw((float) 0);
		$bet->setDrawLoss((float) 0);
		$bet->setWinLoss((float) 0);
		
		return $bet;
	}
	
	private function getRowData(\DOMNodeList $td, int $i)
	{
		return $td->item($i)->getElementsByTagName('a')->item(0)->nodeValue;
	}
}
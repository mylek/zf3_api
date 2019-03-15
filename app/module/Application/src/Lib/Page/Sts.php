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
		$bets = $this->getBetsDoc($dom, ".bet_tab", "//table//tbody//tr");
		
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
		var_dump($row);
		$dom = new \DomDocument();
		$dom->load($row);
		$xpath = new \DOMXPath($dom);
		$td = $xpath->query("//table[@class='subTable']//td");
		
		//$id = (int)$row->getAttribute('data-gtm-enhanced-ecommerce-id');
		//$td = $row->getElementsByTagName('td');
		var_dump($td);die;
		$bet = new Bet();
		$bet->setId($id);
		$bet->setName((string)$this->getRowData($td, 0));
		$bet->setWin((float)$this->getRowData($td, 1));
		$bet->setDraw((float)$this->getRowData($td, 2));
		$bet->setLoss((float)$this->getRowData($td, 3));
		$bet->setWinDraw((float)$this->getRowData($td, 4));
		$bet->setDrawLoss((float)$this->getRowData($td, 5));
		$bet->setWinLoss((float)$this->getRowData($td, 6));
		
		return $bet;
	}
	
	private function getRowData(\DOMNodeList $td, int $i)
	{
		return $td->item($i)->getElementsByTagName('a')->item(0)->nodeValue;
	}
}
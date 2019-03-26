<?php

namespace Application\Lib\Page;

use Application\Lib\Bets\Bet;
use Application\Lib\Bets\BetCollection;

class Efortuna extends Page
{
	protected $url = 'https://www.efortuna.pl/pl/';
	
	public function getMatches()
	{
		$dom = $this->getPage('strona_glowna/pilka-nozna/premier-league-premiership');
		$betsData = new BetCollection();
		$dom = $this->parsedPage();
		
		$xpath = new \DOMXPath($dom->execute('#bet-table-holder-17')->getDocument()); 
		$bets = $xpath->query("//div[@class='bet_tables_holder']//table//tbody//tr");
		
		foreach($bets as $row)
		{
			$bet = $this->parsedRow($row);
			$betsData->offsetSet($bet->nameNormalize(), $bet);
		}
		return $betsData;
	}
	
	private function parsedRow(\DOMElement $row) : Bet
	{
		$id = (int)$row->getAttribute('data-gtm-enhanced-ecommerce-id');
		$td = $row->getElementsByTagName('td');
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
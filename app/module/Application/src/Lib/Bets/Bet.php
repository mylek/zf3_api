<?php

namespace Application\Lib\Bets;

class Bet
{
	protected $id;
	protected $name;
	protected $win;
	protected $draw;
	protected $loss;
	protected $winDraw;
	protected $drawLoss;
	protected $winLoss;
	
	public function getId()
	{
		return $this->id;
	}	
	public function setId(int $id)
	{
		$this->id = $id;
	}	
	
	public function setName(string $name)
	{
		$this->name = $name;
	}
	
	public function setWin(float $win)
	{
		$this->win = $win;
	}
	
	public function setDraw(float $draw)
	{
		$this->draw = $draw;
	}
	
	public function setLoss(float $loss)
	{
		$this->loss = $loss;
	}
	
	public function setWinDraw(float $winDraw)
	{
		$this->winDraw = $winDraw;
	}
	
	public function setDrawLoss(float $drawLoss)
	{
		$this->drawLoss = $drawLoss;
	}	
	
	public function setWinLoss(float $winLoss)
	{
		$this->winLoss = $winLoss;
	}
	
	public function nameNormalize() : string
	{
		$name = trim($this->name);
		$name = str_replace(' - ', ' ', $name);
		$name = preg_replace( '/[^a-z ]+/i', '', $name);
		return strtolower(str_replace(['. ', ' ', '-', "\n", '.'], ['', '_', '', '', ''], $name));
	}
	
}
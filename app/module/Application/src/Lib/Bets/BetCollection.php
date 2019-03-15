<?php

namespace Application\Lib\Bets;

class BetCollection extends \ArrayObject
{	
	public function offsetSet($index, $newval)
    {
        parent::offsetSet($index, $newval);
    }
}
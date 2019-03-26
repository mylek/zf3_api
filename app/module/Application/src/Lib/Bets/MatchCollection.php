<?php

namespace Application\Lib\Bets;

class MatchCollection extends \ArrayObject
{
	public function offsetSet($index, $newval)
    {
        parent::offsetSet($index, $newval);
    }
}
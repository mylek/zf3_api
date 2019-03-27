<?php

namespace Application\Lib\Page;

class PagesCollection extends \ArrayObject
{	
	public function offsetSet($index, $newval)
    {
        parent::offsetSet($index, $newval);
    }
	
	public function findPageToCompare(string $name, string $notPage) : string
	{
		$res = [];
		foreach($this as $key => $row)
		{
			
			if($key == $notPage)
			{
				continue;
			}
			
			// Sprawdza czy ma wpis np stal_resovia
			$page = $this->offsetGet($key)->offsetGet($name);
			if($page != NULL)
			{
				return $key;
			}
		}
		return '';
	}
}
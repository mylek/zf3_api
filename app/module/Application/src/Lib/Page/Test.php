<?php

namespace Application\Lib\Page;
use Zend\Http\Client;

class Test extends Page
{
	public function parsedPage()
	{
		$client = new Client('http://ideo.pl', array(
			'maxredirects' => 0,
			'timeout'      => 30
		));
		$response = $client->send();
		var_dump($response->getBody());
	}
}
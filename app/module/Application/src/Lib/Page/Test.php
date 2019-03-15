<?php

namespace Application\Lib\Page;

use Zend\Dom\Query;

class Test extends Page
{
	protected $url = 'https://www.efortuna.pl/pl/strona_glowna/';
	
	private function getPageContent()
	{
		$response = $this->client->send();
		return $response->getBody();
	}
	
	public function parsedPage()
	{
		$pageContent = $this->getPageContent();
		$dom = new Query($pageContent);
		var_dump($dom->execute('#homepage_actions_0_content'));
	}
}
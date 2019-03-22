<?php

namespace Application\Lib\Page;

use Zend\Http\Client;
use Zend\Dom\Query;

abstract class Page
{
	protected $client;
	protected $connectParams = [
		'maxredirects' => 3,
		'timeout'      => 30
	];
	protected $url;
    protected static $instance;
	
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }
	
	protected function connect($url)
	{
		try
		{
			$client = new Client();
			$client->setUri($this->url.$url);
			$client->setOptions($this->connectParams);
			$this->client = $client;
		}
		catch (\Exception $e)
		{
			throw new \Exception('Error in connect to URL');
		}
		
	}
	
	protected function getPageContent()
	{
		$response = $this->client->send();
		return $response->getBody();
	}
	
	protected function getPage(string $url) : \Zend\Dom\Query
	{
		$this->connect($url);
		return $this->parsedPage();
	}
	
	protected function getBetsDoc(\Zend\Dom\Query $dom, string $root) : \Zend\Dom\NodeList
	{
		return $dom->queryXpath($root);
	}
	
	protected function parsedPage() : Query
	{
		$pageContent = $this->getPageContent();
		if(empty($pageContent))
		{
			throw new \Exception('Content page is empty');
		}
		
		return new Query($pageContent);
	}
	
    protected function __construct() {}
    protected function __clone() {}
    protected function __wakeup() {}
}
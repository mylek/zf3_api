<?php

namespace Application\Lib\Page;

use Zend\Http\Client;

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
			static::$instance->connect();
        }
        return static::$instance;
    }
	
	protected function connect()
	{
		try
		{
			$client = new Client();
			$client->setUri($this->url);
			$client->setOptions($this->connectParams);
			$this->client = $client;
		}
		catch (\Exception $e)
		{
			throw new \Exception('Error in connect to URL');
		}
		
	}
	
    protected function __construct() {}
    protected function __clone() {}
    protected function __wakeup() {}
	
	abstract public function parsedPage();
}
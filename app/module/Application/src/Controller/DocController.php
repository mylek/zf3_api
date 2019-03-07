<?php
namespace Application\Controller;

use RestApi\Controller\ApiController;
use OpenApi;

/**
 * Doc Controller
 */
class DocController extends ApiController
{

    /**
     * bar method
     *
     */
    public function indexAction()
    {
        $openapi = \OpenApi\scan('/var/www/module');
		//header('Content-Type: application/x-yaml');
		echo $openapi->toYaml();
		die;
	}
}
<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use OpenApi;

/**
 * Doc Controller
 */
class DocController extends AbstractActionController
{

    /**
     * Show Swagger docs
     *
     */
    public function indexAction()
    {
		$view = new \Zend\View\Model\ViewModel();
		$view->setTerminal(true);

		return $view;
	}
	
	/**
     * bar method
     *
     */
    public function getAction()
    {
		$this->response->getHeaders()->addHeaderLine('Content-Type: text/plain');
		$openapi = \OpenApi\scan('/var/www/module');
		return $this->response->setContent($openapi->toJson());
	}
}
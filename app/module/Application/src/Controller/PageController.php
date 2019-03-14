<?php
/**
 * @OA\Info(
 *   version="1.0.0",
 *   title="Api for get page content",
 * )
 */
namespace Application\Controller;

use RestApi\Controller\ApiController;
use Zend\View\Model\JsonModel;
use Application\Lib\Page\Factory;

class PageController extends ApiController
{
	
	/**
     * @OA\Get(
     *      path="/api/v1/getPage",
     *      operationId="Get page content",
     *      tags={"Page"},
     *      security={
     *          {"basicAuth": {}}
     *      },
     *      @OA\Parameter(
     *          name="type",
     *          in="query",
     *          description="Paget type",
     *          required=true,
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Page content",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response="400",
     *          description="Error: Bad request. When required parameters were not supplied.",
     *      )
     * )
     *
     * Get page content by type
     *
     * @param string $nip
     * @return void
     */
    public function getPageAction()
	{
		$factory = new Factory();
		$page = $factory->create($this->params()->fromQuery('type', ''));
		
        $this->httpStatusCode = 200;

        $this->apiResponse['you_response'] = $page->parsedPage();

        return $this->createResponse();
    }
}

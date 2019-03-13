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
     *          in="path",
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
		print_r($_GET);die;
        // your action logic

        // Set the HTTP status code. By default, it is set to 200
        $this->httpStatusCode = 200;

        $this->apiResponse['you_response'] = $_GET;

        return $this->createResponse();
    }
}

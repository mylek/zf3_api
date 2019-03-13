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
     *      path="/api/v1",
     *      operationId="Index",
     *      tags={"Index"},
     *      security={
     *          {"basicAuth": {}}
     *      },
     *      @OA\Parameter(
     *          name="nip",
     *          in="path",
     *          description="NIP number",
     *          required=false,
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="NIP status.",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response="400",
     *          description="Error: Bad request. When required parameters were not supplied.",
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="Unauthorized.",
     *      )
     * )
     *
     * Sprawdza poprawność numeru NIP.
     *
     * @param string $nip
     * @return void
     */
    public function indexAction()
    {
        // your action logic

        // Set the HTTP status code. By default, it is set to 200
        $this->httpStatusCode = 200;

        // Set the response
        $this->apiResponse['you_response'] = 'Pages';

        return $this->createResponse();
    }
}

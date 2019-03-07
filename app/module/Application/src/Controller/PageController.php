<?php
namespace Application\Controller;

use RestApi\Controller\ApiController;

class PageController extends ApiController
{
	/**
	 * @OA\Get(
	 *     path="/api/v1",
	 *     @OA\Response(response="200", description="An example resource")
	 * )
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

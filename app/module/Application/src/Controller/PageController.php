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
use Application\Lib\Page\PagesCompare;

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
     *          @OA\Schema(
					type="string",
					enum={"Sts", "Efortuna"},
					default="Sts"
				)
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

        $this->apiResponse['you_response'] = $page->getMatches();

        return $this->createResponse();
    }
	
	/**
     * @OA\Post(
     *     path="/api/v1/comparePages",
     *     description="Compare list match",
     *     operationId="compareMatch",
     *     tags={"Compare"},
     *     security={{"basicAuth": {}}},
			@OA\RequestBody(
     *          description="Order status",
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  type="object",
     *                  required={"pages"},
     *                  @OA\Property(
     *                      property="pages",
     *                      description="pages",
     *                      type="string",
							default="['sts', 'efortuna']"
     *                  )
     *              )
     *          )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Resalt compare match",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     )
     * )
     *
     * Compare match.
     *
     * @param Request $request
     * 
     * @return JsonResponse
     */
	public function comparePagesAction()
	{
		$pages = json_decode($this->getRequest()->getPost('pages'));
		if(empty($pages))
		{
			$this->httpStatusCode = 400;
			$this->apiResponse['you_response'] = "Not set pages list";
			return $this->createResponse();
		}
		
		$pagesCompare = new PagesCompare($pages);
		$pagesCompare->run();
		$this->httpStatusCode = 200;
		$this->apiResponse['you_response'] = json_decode($this->getRequest()->getPost('matchs'));
		return $this->createResponse();
	}
}

<?php

namespace PerseiX\ProjectBundle\Controller;

use ApiBundle\Request\PaginatedRequest;
use PerseiX\ProjectBundle\Model\CategoryCollection;
use ApiBundle\Controller\AbstractApiController;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Class CategoryController
 * @package PerseiX\ProjectBundle\Controller
 */
class CategoryController extends AbstractApiController
{
	/**
	 * @param PaginatedRequest $paginatedRequest
	 * @ApiDoc(
	 *     section="Category",
	 *     resource=true,
	 *     description="Get category collection",
	 *     output="PerseiX\UserBundle\Representation\CategoryRepresentationCollection",
	 * )
	 *
	 * @return Response
	 */
	public function collectionAction(PaginatedRequest $paginatedRequest)
	{
		$collection = $this->getDoctrine()->getRepository('PerseiXProjectBundle:Category')->collectionQuery();

		return $this->paginatedResponse(CategoryCollection::class, $collection, $paginatedRequest);
	}
}
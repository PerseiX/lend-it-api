<?php

namespace PerseiX\ProjectBundle\Controller;

use ApiBundle\Request\PaginatedRequest;
use PerseiX\ProjectBundle\Model\CategoryCollection;
use ApiBundle\Controller\AbstractApiController;
use SortAndFilterBundle\Annotation\Sort;
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
	 * @Sort(availableField={"name"}, default="name", alias="category_repository")
	 *
	 * @return Response
	 */
	public function collectionAction(PaginatedRequest $paginatedRequest)
	{
		$collection = $this->get('repository.category')->collectionQuery();

		return $this->paginatedResponse(CategoryCollection::class, $collection, $paginatedRequest);
	}
}
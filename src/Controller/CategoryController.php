<?php

namespace App\Controller;

use ApiBundle\Request\PaginatedRequest;
use App\Model\CategoryCollection;
use ApiBundle\Controller\AbstractApiController;
use SortAndFilterBundle\Annotation\Sort;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\Operation;
use Swagger\Annotations as SWG;

/**
 * Class CategoryController
 * @package PerseiX\ProjectBundle\Controller
 */
class CategoryController extends AbstractApiController
{
	/**
	 * @param PaginatedRequest $paginatedRequest
	 * @Operation(
	 *     tags={"Category"},
	 *     summary="Get category collection",
	 *     @SWG\Parameter(
	 *         name="sortBy[name]",
	 *         in="query",
	 *         description="ASC|DESC",
	 *         required=false,
	 *         type="array",
	 *              @SWG\Items(
	 *                  type="string"
	 *              )
	 *     ),
	 *     @SWG\Response(
	 *         response="200",
	 *         description="Returned when successful"
	 *     )
	 * )
	 *
	 *
	 * @Sort(availableField={"name"}, default="name", alias="category_repository")
	 *
	 * @return Response
	 * @throws \Doctrine\ORM\ORMException
	 */
	public function collectionAction(PaginatedRequest $paginatedRequest)
	{
		$collection = $this->get('repository.category')->collectionQuery();

		return $this->paginatedResponse(CategoryCollection::class, $collection, $paginatedRequest);
	}
}
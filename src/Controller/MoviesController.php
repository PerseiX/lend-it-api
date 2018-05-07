<?php

namespace App\Controller;

use ApiBundle\Annotation\Scope;
use ApiBundle\Controller\AbstractApiController;
use ApiBundle\Request\PaginatedRequest;
use App\Entity\Category;
use App\Entity\Movie;
use App\Model\MovieCollection;
use Nelmio\ApiDocBundle\Annotation\Operation;
use Swagger\Annotations as SWG;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use SortAndFilterBundle\Annotation\Sort;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Movies
 * @package PerseiX\ProjectBundle
 */
class MoviesController extends AbstractApiController
{
	/**
	 * @param PaginatedRequest $paginatedRequest
	 *
	 * @Operation(
	 *     tags={"Movies"},
	 *     summary="Get movies collection",
	 *     @SWG\Parameter(
	 *         name="sortBy[releasedAt]",
	 *         in="query",
	 *         description="ASC|DESC",
	 *         required=false,
	 *         type="array",
	 *              @SWG\Items(
	 *                  type="string"
	 *              )
	 *     ),
	 *     @SWG\Parameter(
	 *         name="sortBy[title]",
	 *         in="query",
	 *         description="ASC|DESC",
	 *         required=false,
	 *         type="array",
	 *              @SWG\Items(
	 *                  type="string"
	 *              )
	 *     ),
	 *     @SWG\Parameter(
	 *         name="sortBy[popularity]",
	 *         in="query",
	 *         description="ASC|DESC",
	 *         required=false,
	 *         type="array",
	 *              @SWG\Items(
	 *                  type="string"
	 *              )
	 *     ),
	 *     @SWG\Parameter(
	 *         name="with[]",
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
	 * @Scope(scope="category.movies", value="category.movies")
	 * @Sort(availableField={"releasedAt", "title", "popularity"}, default="popularity", alias="movie_repository")
	 *
	 * @return Response
	 * @throws \Doctrine\ORM\ORMException
	 */
	public function collectionAction(PaginatedRequest $paginatedRequest): Response
	{
		$moviesQuery = $this->get('repository.movie')->collectionQuery();

		return $this->paginatedResponse(MovieCollection::class, $moviesQuery, $paginatedRequest);
	}

	/**
	 * @param Movie $movie
	 *
	 * @Operation(
	 *     tags={"Movies"},
	 *     summary="Get single movie",
	 *     @SWG\Response(
	 *         response="200",
	 *         description="Returned when successful"
	 *     )
	 * )
	 *
	 * @ParamConverter("movie", options={
	 *      "mapping": {
	 *            "movieId" = "id"
	 *        }
	 * })
	 *
	 * @return Response
	 */
	public function singleAction(Movie $movie): Response
	{
		return $this->representationResponse($this->transform($movie));
	}

	/**
	 * @param Category         $category
	 * @param PaginatedRequest $paginatedRequest
	 *
	 * @Operation(
	 *     tags={"Movies"},
	 *     summary="Get movies collection by category Id",
	 *     @SWG\Parameter(
	 *         name="sortBy[releasedAT]",
	 *         in="query",
	 *         description="ASC|DESC",
	 *         required=false,
	 *         type="array",
	 *              @SWG\Items(
	 *                  type="string"
	 *              )
	 *     ),
	 *     @SWG\Parameter(
	 *         name="sortBy[title]",
	 *         in="query",
	 *         description="ASC|DESC",
	 *         required=false,
	 *         type="array",
	 *              @SWG\Items(
	 *                  type="string"
	 *              )
	 *     ),
	 *     @SWG\Parameter(
	 *         name="sortBy[popularity]",
	 *         in="query",
	 *         description="ASC|DESC",
	 *         required=false,
	 *         type="array",
	 *              @SWG\Items(
	 *                  type="string"
	 *              )
	 *     ),
	 *     @SWG\Parameter(
	 *         name="with[]",
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
	 * @ParamConverter("category", options={
	 *      "mapping": {
	 *            "categoryId" = "id"
	 *        }
	 * })
	 *
	 * @Scope(scope="category.movies", value="category.movies")
	 * @Sort(availableField={"releasedAt", "title", "popularity"}, default="popularity", alias="movie_repository")
	 *
	 * @return Response
	 * @throws \Doctrine\ORM\ORMException
	 */
	public function moviesByCategoryAction(Category $category, PaginatedRequest $paginatedRequest): Response
	{
		$moviesQuery = $this->get('repository.movie')->getMoviesQueryByCategory($category);

		return $this->paginatedResponse(MovieCollection::class, $moviesQuery, $paginatedRequest, [
			'categoryId' => $category->getId()
		]);
	}
}
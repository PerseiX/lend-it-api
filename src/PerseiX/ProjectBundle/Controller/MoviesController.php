<?php

namespace PerseiX\ProjectBundle\Controller;

use ApiBundle\Annotation\Scope;
use ApiBundle\Controller\AbstractApiController;
use ApiBundle\Request\PaginatedRequest;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use PerseiX\ProjectBundle\Entity\Movie;
use PerseiX\ProjectBundle\Model\MovieCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
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
	 * @ApiDoc(
	 *     section="Movies",
	 *     resource=true,
	 *     description="Get movies collection",
	 *     output="PerseiX\UserBundle\Representation\MovieRepresentationCollection",
	 * )
	 *
	 * @Scope(scope="category.movies", value="category.movies")
	 * @return Response
	 */
	public function collectionAction(PaginatedRequest $paginatedRequest)
	{
//		print_r(cl_image_tag('uQnD9QnokQMPfkyZwXVkSmph9yh_wahgqe'));
//		die;
//		$this->get('speicher210_cloudinary.uploader')->getImage
		$moviesQuery = $this->getDoctrine()->getRepository('PerseiXProjectBundle:Movie')->collectionQuery();

		return $this->paginatedResponse(MovieCollection::class, $moviesQuery, $paginatedRequest);
	}

	/**
	 * @param Movie $movie
	 *
	 * @ApiDoc(
	 *     section="Movies",
	 *     resource=true,
	 *     description="Get single movie",
	 *     output="PerseiX\UserBundle\Representation\MovieRepresentation",
	 * )
	 * @ParamConverter("movie", options={
	 *      "mapping": {
	 *            "movieId" = "id"
	 *        }
	 * })
	 * @return Response
	 */
	public function singleAction(Movie $movie)
	{
		return $this->representationResponse($this->transform($movie));
	}
}
<?php

namespace PerseiX\ProjectBundle\Controller;

use ApiBundle\Controller\AbstractApiController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use PerseiX\ProjectBundle\Model\Movie;
use PerseiX\ProjectBundle\Model\MovieCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Movies
 * @package PerseiX\ProjectBundle
 */
class MoviesController extends AbstractApiController
{
	/**
	 * @param MovieCollection $movieCollection
	 *
	 * @ApiDoc(
	 *     section="Movies",
	 *     resource=true,
	 *     description="Get movies collection",
	 *     output="PerseiX\UserBundle\Representation\MovieRepresentationCollection",
	 * )
	 *
	 * @return Response
	 */
	public function collectionAction(MovieCollection $movieCollection)
	{
		return $this->representationResponse($this->transform($movieCollection));
	}

	/**
	 * @param Request $request
	 *
	 * @ApiDoc(
	 *     section="Movies",
	 *     resource=true,
	 *     description="Get movies collection",
	 *     output="PerseiX\UserBundle\Representation\MovieRepresentation",
	 * )
	 *
	 * @return Response
	 */
	public function singleAction(Request $request)
	{
		$id     = $request->get('movieId');
		$result = $this->get('perseix_project_service.http_fetcher')->fetchSingle($id);
		$movie  = $this->get('perseix_project_factory.movie_factory')->create(json_decode($result));

		return $this->representationResponse($this->transform($movie));
	}
}
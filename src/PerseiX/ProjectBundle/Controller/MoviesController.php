<?php

namespace PerseiX\ProjectBundle\Controller;

use ApiBundle\Annotation\Scope;
use ApiBundle\Controller\AbstractApiController;
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
	public function collectionAction()
	{
		$movies           = $this->getDoctrine()->getRepository('PerseiXProjectBundle:Movie')->findAll();
		$movieCollection = new MovieCollection($movies);

		return $this->representationResponse($this->transform($movieCollection));
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
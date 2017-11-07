<?php

namespace PerseiX\ProjectBundle\Controller;

use ApiBundle\Controller\AbstractApiController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use PerseiX\ProjectBundle\Model\Movie;
use PerseiX\ProjectBundle\Model\MovieCollection;
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
}
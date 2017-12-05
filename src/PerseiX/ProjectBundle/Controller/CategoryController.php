<?php

namespace PerseiX\ProjectBundle\Controller;

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
	 * @ApiDoc(
	 *     section="Category",
	 *     resource=true,
	 *     description="Get category collection",
	 *     output="PerseiX\UserBundle\Representation\CategoryRepresentationCollection",
	 * )
	 *
	 * @return Response
	 */
	public function collectionAction()
	{
		$collection      = $this->getDoctrine()->getRepository('PerseiXProjectBundle:Category')->findAll();
		$collectionModel = new CategoryCollection($collection);

		return $this->representationResponse($this->transform($collectionModel));
	}
}
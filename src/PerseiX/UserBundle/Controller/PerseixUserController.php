<?php

namespace PerseiX\UserBundle\Controller;

use ApiBundle\Controller\AbstractApiController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Class PerseixUserController
 * @package PerseiX\UserBundle\Controller
 */
class PerseixUserController extends AbstractApiController
{
	/**
	 * @param Request $request
	 *
	 * @ApiDoc(
	 *     section="User",
	 *     resource=true,
	 *     description="Get user details base on access token from header",
	 *     output="PerseiX\UserBundle\Representation\UserRepresentation"
	 * )
	 * @return Response
	 */
	public function meAction(Request $request)
	{
		return $this->representationResponse($this->getUser());
	}

}
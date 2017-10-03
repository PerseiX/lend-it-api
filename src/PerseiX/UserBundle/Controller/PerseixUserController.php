<?php

namespace PerseiX\UserBundle\Controller;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PerseixUserController
 * @package PerseiX\UserBundle\Controller
 */
class PerseixUserController extends Controller
{
	/**
	 *
	 * @ApiDoc(
	 *     section="User",
	 *     resource=true,
	 *     description="Get user details base on access token from header",
	 *     output="PerseiX\UserBundle\Representation\UserRepresentation"
	 * )
	 * @return Response
	 *
	 */
	public function meAction(Request $request)
	{
		die;
	}
}
<?php

namespace PerseiX\UserBundle\Controller;

use ApiBundle\Controller\AbstractApiController;
use PerseiX\UserBundle\Form\RegistryType;
use PerseiX\UserBundle\Model\RegistryModel;
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
	 * @ApiDoc(
	 *     section="User",
	 *     resource=true,
	 *     description="Get user details base on access token from header",
	 *     output="PerseiX\UserBundle\Representation\UserRepresentation"
	 * )
	 * @return Response
	 */
	public function meAction()
	{
		return $this->representationResponse($this->getUser());
	}

	/**
	 * @param Request $request
	 * @ApiDoc(
	 *     section="User",
	 *     resource=true,
	 *     description="Register new user",
	 *     output="PerseiX\UserBundle\Representation\UserRepresentation",
	 *     parameters={
	 *          {"name"="username", "dataType"="string", "required"=true, "description"="Username"},
	 *          {"name"="email", "dataType"="email", "required"=true, "description"="Email"},
	 *          {"name"="password[first]", "dataType"="array", "required"=true, "description"="Password"},
	 *          {"name"="password[second]", "dataType"="array", "required"=true, "description"="Repeated password"}
	 *     }
	 * )
	 *
	 * @return Response
	 */
	public function registryAction(Request $request)
	{
		$form = $this->createForm(RegistryType::class);
		$form->handleRequest($request);

		if (false === $form->isSubmitted()) {
			$form->submit($request->request->all());
		}
//		$this->get('doctrine.orm.entity_manager')
		if (true === $form->isValid()) {
			$user    = $this->get('perseix_user_manager.reqistry_manager')->registry($form->getData());
			$manager = $this->getDoctrine()->getManager();

			$manager->persist($user);
			$manager->flush();

			return $this->representationResponse($user);
		} else {
			return $this->formErrorsResponse($form);
		}
	}
}
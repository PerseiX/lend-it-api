<?php

namespace App\Controller;

use ApiBundle\Controller\AbstractApiController;
use App\Model\RegistryModel;
use App\Form\Type\RegistryType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
//use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Nelmio\ApiDocBundle\Annotation\Operation;
use Swagger\Annotations as SWG;

/**
 * Class PerseixUserController
 * @package PerseiX\UserBundle\Controller
 */
class PerseixUserController extends AbstractApiController
{

	/**
	 *
	 * @Operation(
	 *     tags={"User"},
	 *     summary="Get user details base on access token from header",
	 *     @SWG\Response(
	 *         response="200",
	 *         description="Returned when successful"
	 *     )
	 * )
	 *
	 * @return Response
	 */
	public function meAction()
	{
		return $this->representationResponse($this->transform($this->getUser()));
	}

	/**
	 *
	 * @Operation(
	 *     tags={"User"},
	 *     summary="Register new user",
	 *     @SWG\Parameter(
	 *         name="user",
	 *         in="body",
	 *         description="User data",
	 *              @SWG\Schema(
	 *                  type="object",
	 *                    @SWG\Property(property="username", type="string"),
	 *                    @SWG\Property(property="email", type="string"),
	 *                    @SWG\Property(property="password",
	 *                      properties={
	 *                          @SWG\Property(property="first", type="string"),
	 *                          @SWG\Property(property="second", type="string")
	 *                    })
	 *              )
	 *     ),
	 *     @SWG\Response(
	 *         response="200",
	 *         description="Returned when successful"
	 *     )
	 * )
	 *
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
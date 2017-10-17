<?php

namespace PerseiX\UserBundle\Manager;

use FOS\UserBundle\Doctrine\UserManager;
use PerseiX\UserBundle\Exception\UserAlreadyExistException;
use PerseiX\UserBundle\Model\RegistryModel;
use PerseiX\UserBundle\Service\Registration;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Class RegistryManager
 * @package PerseiX\UserBundle\Manager
 */
class RegistryManager
{
	/**
	 * @var UserManager
	 */
	private $userManager;

	/**
	 * @var Registration
	 */
	private $registration;

	/**
	 * RegistryManager constructor.
	 *
	 * @param UserManager  $userManager
	 * @param Registration $registration
	 */
	public function __construct(UserManager $userManager, Registration $registration)
	{
		$this->userManager  = $userManager;
		$this->registration = $registration;
	}

	/**
	 * @param RegistryModel $registryModel
	 *
	 * @return mixed
	 */
	public function registry(RegistryModel $registryModel)
	{
		try {
			$this->checkUserExist($registryModel);

			return $this->registration->registryUser($registryModel);
		} catch (UserAlreadyExistException $e) {
			throw new BadRequestHttpException($e->getMessage());
		}
	}

	/**
	 * @param RegistryModel $registryModel
	 *
	 * @throws UserAlreadyExistException
	 */
	private function checkUserExist(RegistryModel $registryModel)
	{
		if (null !== $this->userManager->findUserByEmail($registryModel->getEmail())) {
			throw new UserAlreadyExistException(
				sprintf("User with %s email already exist", $registryModel->getEmail()
				));
		}

		if (null !== $this->userManager->findUserByUsername($registryModel->getUsername())) {
			throw new UserAlreadyExistException(
				sprintf("User with %s username already exist", $registryModel->getUsername()
				));
		}
	}
}
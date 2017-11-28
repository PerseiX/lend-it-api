<?php

namespace PerseiX\UserBundle\Service;

use Doctrine\Common\Persistence\ObjectManager;
use PerseiX\UserBundle\Entity\UserModel;
use PerseiX\UserBundle\Factory\UserFactory;
use PerseiX\UserBundle\Model\RegistryModel;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class Registration
 * @package PerseiX\UserBundle\Service
 */
class Registration
{
	/**
	 * @var ObjectManager
	 */
	private $em;

	/**
	 * @var EncoderFactoryInterface
	 */
	private $factoryEncoder;

	/**
	 * Registration constructor.
	 *
	 * @param ObjectManager           $em
	 * @param EncoderFactoryInterface $factoryEncoder
	 */
	public function __construct(ObjectManager $em, EncoderFactoryInterface $factoryEncoder)
	{
		$this->em             = $em;
		$this->factoryEncoder = $factoryEncoder;
	}

	/**
	 * @param RegistryModel $registryModel
	 *
	 * @return UserInterface
	 */
	public function registryUser(RegistryModel $registryModel): UserInterface
	{
		$user    = UserFactory::createUser();
		$encoder = $this->factoryEncoder->getEncoder($user);

		$salt     = $this->generateSalt();
		$password = $encoder->encodePassword($registryModel->getPassword(), $salt);

		$user->setUsername($registryModel->getUsername())
		     ->setPassword($password)
		     ->setEnabled(1)
		     ->setSalt($salt)
		     ->setEmail($registryModel->getEmail());

		return $user;
	}

	/**
	 * @return string
	 */
	private function generateSalt(): string
	{
		return rtrim(str_replace('+', '.', base64_encode(random_bytes(32))), '=');
	}
}
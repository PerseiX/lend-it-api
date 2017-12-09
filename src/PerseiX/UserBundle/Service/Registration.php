<?php

namespace PerseiX\UserBundle\Service;

use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PerseiX\UserBundle\Factory\UserFactory;
use PerseiX\UserBundle\Model\RegistryModel;
use FOS\UserBundle\Model\UserInterface;
use PerseiX\UserBundle\Entity\Group;
use FOS\UserBundle\Model\User;

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

		$this->populateGroups($user);

		return $user;
	}

	/**
	 * @return string
	 */
	private function generateSalt(): string
	{
		return rtrim(str_replace('+', '.', base64_encode(random_bytes(32))), '=');
	}

	/**
	 * @param User $user
	 *
	 * @return User
	 */
	private function populateGroups(User $user)
	{
		$customUserGroup = $this->em->getRepository('PerseiXUserBundle:Group')->findOneBy(['name' => Group::CUSTOM_USER]);
		if (null != $customUserGroup) {
			$user->addGroup($customUserGroup);
		}

		return $user;
	}
}
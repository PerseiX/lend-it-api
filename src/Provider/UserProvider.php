<?php

namespace App\Provider;

use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface as SecurityUserInterface;

/**
 * Class UserProvider
 * @package PerseiX\UserBundle\Provider
 */
class UserProvider implements UserProviderInterface
{

	/**
	 * @var UserManagerInterface
	 */
	protected $userManager;

	/**
	 * Constructor.
	 *
	 * @param UserManagerInterface $userManager
	 */
	public function __construct(UserManagerInterface $userManager)
	{
		$this->userManager = $userManager;
	}

	/**
	 * {@inheritdoc}
	 */
	public function loadUserByUsername($username)
	{
		$user = $this->findUser($username);

		if (!$user) {
			throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $username));
		}

//		$user->setRoles(['ROLE_DUPA']);

		return $user;
	}

	/**
	 * {@inheritdoc}
	 */
	public function refreshUser(SecurityUserInterface $user)
	{
		if (!$user instanceof UserInterface) {
			throw new UnsupportedUserException(sprintf('Expected an instance of FOS\UserBundle\Model\UserInterface, but got "%s".', get_class($user)));
		}

		if (!$this->supportsClass(get_class($user))) {
			throw new UnsupportedUserException(sprintf('Expected an instance of %s, but got "%s".', $this->userManager->getClass(), get_class($user)));
		}

		if (null === $reloadedUser = $this->userManager->findUserBy(['id' => $user->getId()])) {
			throw new UsernameNotFoundException(sprintf('User with ID "%s" could not be reloaded.', $user->getId()));
		}

		return $reloadedUser;
	}

	/**
	 * {@inheritdoc}
	 */
	public function supportsClass($class)
	{
		$userClass = $this->userManager->getClass();

		return $userClass === $class || is_subclass_of($class, $userClass);
	}

	/**
	 * @param $username
	 *
	 * @return \FOS\UserBundle\Model\UserInterface
	 */
	protected function findUser($username)
	{
		return $this->userManager->findUserByUsernameOrEmail($username);
	}
}
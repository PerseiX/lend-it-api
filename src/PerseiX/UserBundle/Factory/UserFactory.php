<?php

namespace PerseiX\UserBundle\Factory;

use PerseiX\UserBundle\Entity\User;

/**
 * Class UserFactory
 * @package PerseiX\UserBundle\Factory
 */
class UserFactory
{
	/**
	 * @return User
	 */
	public static function createUser()
	{
		return new User();
	}
}
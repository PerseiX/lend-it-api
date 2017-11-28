<?php

namespace PerseiX\UserBundle\Factory;

use PerseiX\UserBundle\Entity\UserModel;

/**
 * Class UserFactory
 * @package PerseiX\UserBundle\Factory
 */
class UserFactory
{
	/**
	 * @return UserModel
	 */
	public static function createUser()
	{
		return new UserModel();
	}
}
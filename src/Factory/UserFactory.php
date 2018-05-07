<?php

namespace App\Factory;

use App\Entity\UserModel;

/**
 * Class UserFactory
 * @package App\Factory
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
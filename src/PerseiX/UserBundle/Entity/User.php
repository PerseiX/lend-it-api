<?php

namespace PerseiX\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class User extends BaseUser
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @ORM\OneToMany(targetEntity="PerseiX\UserBundle\Entity\RefreshToken", mappedBy="user")
	 */
	protected $refreshToken;

	/**
	 * @ORM\OneToMany(targetEntity="PerseiX\UserBundle\Entity\AuthCode", mappedBy="user")
	 */
	protected $authCode;

	/**
	 * @ORM\OneToMany(targetEntity="PerseiX\UserBundle\Entity\AccessToken", mappedBy="user")
	 */
	protected $accessToken;
	/**
	 * User constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * {@inheritdoc}
	 */
	public function getRoles()
	{
		return ['ROLE_ADMIN'];
	}

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}
}

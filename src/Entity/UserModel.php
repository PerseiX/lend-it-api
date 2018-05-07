<?php

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class UserModel extends BaseUser
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @ORM\OneToMany(targetEntity="App\Entity\RefreshToken", mappedBy="user")
	 */
	protected $refreshToken;

	/**
	 * @ORM\OneToMany(targetEntity="App\Entity\AuthCode", mappedBy="user")
	 */
	protected $authCode;

	/**
	 * @ORM\OneToMany(targetEntity="App\Entity\AccessToken", mappedBy="user")
	 */
	protected $accessToken;

	/**
	 * @ORM\ManyToMany(targetEntity="App\Entity\Group")
	 * @ORM\JoinColumn(referencedColumnName="id")
	 */
	protected $groups;

	/**
	 * User constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

}

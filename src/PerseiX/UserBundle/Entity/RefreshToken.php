<?php
declare(strict_types=1);

namespace PerseiX\UserBundle\Entity;

use FOS\OAuthServerBundle\Entity\RefreshToken as BaseRefreshToken;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class RefreshToken extends BaseRefreshToken
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @ORM\ManyToOne(targetEntity="PerseiX\UserBundle\Entity\Client", inversedBy="user")
	 * @ORM\JoinColumn(nullable=false)
	 */
	protected $client;

	/**
	 * @ORM\ManyToOne(targetEntity="PerseiX\UserBundle\Entity\UserModel", inversedBy="refreshToken")
	 */
	protected $user;
}
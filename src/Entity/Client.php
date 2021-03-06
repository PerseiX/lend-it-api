<?php
declare(strict_types=1);

namespace App\Entity;


use FOS\OAuthServerBundle\Entity\Client as BaseClient;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Client extends BaseClient
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @ORM\OneToMany(targetEntity="App\Entity\RefreshToken", mappedBy="client")
	 */
	protected $user;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\AuthCode", inversedBy="client")
	 */
	protected $authCode;

	/**
	 * Client constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=256)
	 */
	private $name;

	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 *
	 * @return $this
	 */
	public function setName(string $name)
	{
		$this->name = $name;

		return $this;
	}
}
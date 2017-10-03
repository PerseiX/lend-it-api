<?php

namespace PerseiX\UserBundle\Representation;

use ApiBundle\Representation\RepresentationInterface;

/**
 * Class UserRepresentation
 * @package PerseiX\Usr
 */
class UserRepresentation implements RepresentationInterface
{
	/**
	 * @var int
	 */
	private $id;

	/**
	 * @var string
	 */
	private $username;

	/**
	 * @var string
	 */
	private $email;

	/**
	 * @var boolean
	 */
	private $enabled;

	/**
	 * @var \DateTime
	 */
	private $lastLogin;

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 *
	 * @return UserRepresentation
	 */
	public function setId(int $id): UserRepresentation
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getUsername(): string
	{
		return $this->username;
	}

	/**
	 * @param string $username
	 *
	 * @return UserRepresentation
	 */
	public function setUsername(string $username): UserRepresentation
	{
		$this->username = $username;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getEmail(): string
	{
		return $this->email;
	}

	/**
	 * @param string $email
	 *
	 * @return UserRepresentation
	 */
	public function setEmail(string $email): UserRepresentation
	{
		$this->email = $email;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isEnabled(): bool
	{
		return $this->enabled;
	}

	/**
	 * @param bool $enabled
	 *
	 * @return UserRepresentation
	 */
	public function setEnabled(bool $enabled): UserRepresentation
	{
		$this->enabled = $enabled;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getLastLogin(): \DateTime
	{
		return $this->lastLogin;
	}

	/**
	 * @param \DateTime $lastLogin
	 *
	 * @return UserRepresentation
	 */
	public function setLastLogin(\DateTime $lastLogin): UserRepresentation
	{
		$this->lastLogin = $lastLogin;

		return $this;
	}
}
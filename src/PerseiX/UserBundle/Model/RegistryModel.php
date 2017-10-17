<?php

namespace PerseiX\UserBundle\Model;

/**
 * Class RegistryModel
 * @package PerseiX\UserBundle\Model
 */
class RegistryModel
{
	/**
	 * @var string
	 */
	private $password;

	/**
	 * @var string
	 */
	private $username;

	/**
	 * @var string
	 */
	private $repeatPassword;

	/**
	 * @var string
	 */
	private $email;

//	/**
//	 * RegistryModel constructor.
//	 *
//	 * @param string $username
//	 * @param string $password
//	 * @param string $repeatPassword
//	 * @param string $email
//	 */
//	public function __construct(string $username, string $password, string $repeatPassword, string $email)
//	{
//		$this->password       = $password;
//		$this->username       = $username;
//		$this->repeatPassword = $repeatPassword;
//		$this->email          = $email;
//	}

	/**
	 * @return string
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * @param string $password
	 *
	 * @return RegistryModel
	 */
	public function setPassword(string $password): RegistryModel
	{
		$this->password = $password;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getUsername()
	{
		return $this->username;
	}

	/**
	 * @param string $username
	 *
	 * @return RegistryModel
	 */
	public function setUsername(string $username): RegistryModel
	{
		$this->username = $username;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getRepeatPassword()
	{
		return $this->repeatPassword;
	}

	/**
	 * @param string $repeatPassword
	 *
	 * @return RegistryModel
	 */
	public function setRepeatPassword(string $repeatPassword): RegistryModel
	{
		$this->repeatPassword = $repeatPassword;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @param string $email
	 *
	 * @return RegistryModel
	 */
	public function setEmail(string $email): RegistryModel
	{
		$this->email = $email;

		return $this;
	}

}
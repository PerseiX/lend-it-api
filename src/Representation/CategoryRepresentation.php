<?php

namespace App\Representation;

use ApiBundle\Representation\RepresentationInterface;

/**
 * Class CategoryRepresentation
 * @package PerseiX\ProjectBundle\Representation
 */
class CategoryRepresentation implements RepresentationInterface
{
	/**
	 * @var int
	 */
	private $id;

	/**
	 * @var boolean
	 */
	private $active;

	/**
	 * @var string
	 */
	private $name;

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
	 * @return CategoryRepresentation
	 */
	public function setId(int $id): CategoryRepresentation
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isActive(): bool
	{
		return $this->active;
	}

	/**
	 * @param bool $active
	 *
	 * @return CategoryRepresentation
	 */
	public function setActive(bool $active): CategoryRepresentation
	{
		$this->active = $active;

		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getName(): ?string
	{
		return $this->name;
	}

	/**
	 * @param string|null $name
	 *
	 * @return CategoryRepresentation
	 */
	public function setName(string $name = null): CategoryRepresentation
	{
		$this->name = $name;

		return $this;
	}

}
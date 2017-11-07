<?php

namespace PerseiX\ProjectBundle\Representation;

use ApiBundle\Representation\RepresentationInterface;

/**
 * Class MovieRepresentation
 * @package PerseiX\ProjectBundle\Representation
 */
class MovieRepresentation implements RepresentationInterface
{
	/**
	 * @var int
	 */
	private $id;

	/**
	 * @var string
	 */
	private $title;

	/**
	 * @var string
	 */
	private $description;

	/**
	 * @var array
	 */
	private $genreIds;

	/**
	 * @var \DateTime
	 */
	private $releaseAt;

	/**
	 * @var string
	 */
	private $language;

	/**
	 * @var string
	 */
	private $imagePath;

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}

	/**
	 * @param int|null $id
	 *
	 * @return MovieRepresentation
	 */
	public function setId(int $id = null): MovieRepresentation
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * @param string|null $title
	 *
	 * @return MovieRepresentation
	 */
	public function setTitle(string $title = null): MovieRepresentation
	{
		$this->title = $title;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getDescription(): string
	{
		return $this->description;
	}

	/**
	 * @param string|null $description
	 *
	 * @return MovieRepresentation
	 */
	public function setDescription(string $description = null): MovieRepresentation
	{
		$this->description = $description;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getGenreIds(): array
	{
		return $this->genreIds;
	}

	/**
	 * @param array|null $genreIds
	 *
	 * @return MovieRepresentation
	 */
	public function setGenreIds(array $genreIds = null): MovieRepresentation
	{
		$this->genreIds = $genreIds;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getReleaseAt(): \DateTime
	{
		return $this->releaseAt;
	}

	/**
	 * @param \DateTime|null $releaseAt
	 *
	 * @return MovieRepresentation
	 */
	public function setReleaseAt(\DateTime $releaseAt = null): MovieRepresentation
	{
		$this->releaseAt = $releaseAt;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getLanguage(): string
	{
		return $this->language;
	}

	/**
	 * @param string|null $language
	 *
	 * @return MovieRepresentation
	 */
	public function setLanguage(string $language = null): MovieRepresentation
	{
		$this->language = $language;

		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getImagePath(): ?string
	{
		return $this->imagePath;
	}

	/**
	 * @param string|null $imagePath
	 *
	 * @return MovieRepresentation
	 */
	public function setImagePath(string $imagePath = null): MovieRepresentation
	{
		$this->imagePath = $imagePath;

		return $this;
	}

}
<?php

namespace PerseiX\ProjectBundle\Model;

/**
 * Class Movie
 * @package PerseiX\ProjectBundle\Model
 */
class Movie
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
	 * @param int $id
	 *
	 * @return Movie
	 */
	public function setId(int $id): Movie
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getId(): ?int
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getTitle(): ?string
	{
		return $this->title;
	}

	/**
	 * @param string $title
	 *
	 * @return Movie
	 */
	public function setTitle(string $title): Movie
	{
		$this->title = $title;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getDescription(): ?string
	{
		return $this->description;
	}

	/**
	 * @param string $description
	 *
	 * @return Movie
	 */
	public function setDescription(string $description): Movie
	{
		$this->description = $description;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getGenreIds(): ?array
	{
		return $this->genreIds;
	}

	/**
	 * @param array $genreIds
	 *
	 * @return Movie
	 */
	public function setGenreIds(array $genreIds): Movie
	{
		$this->genreIds = $genreIds;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getReleaseAt(): ?\DateTime
	{
		return $this->releaseAt;
	}

	/**
	 * @param \DateTime $releaseAt
	 *
	 * @return Movie
	 */
	public function setReleaseAt(\DateTime $releaseAt): Movie
	{
		$this->releaseAt = $releaseAt;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getLanguage(): ?string
	{
		return $this->language;
	}

	/**
	 * @param string $language
	 *
	 * @return Movie
	 */
	public function setLanguage(string $language): Movie
	{
		$this->language = $language;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getImagePath(): ?string
	{
		return $this->imagePath;
	}

	/**
	 * @param string|null $imagePath
	 *
	 * @return Movie
	 */
	public function setImagePath(string $imagePath = null): Movie
	{
		$this->imagePath = $imagePath;

		return $this;
	}

}
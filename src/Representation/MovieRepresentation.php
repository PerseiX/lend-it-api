<?php

namespace App\Representation;

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
	 * @var \DateTime
	 */
	private $releasedAt;

	/**
	 * @var string
	 */
	private $imagePath;

	/**
	 * @var array[int]
	 */
	private $categoriesIds;

	/**
	 * @var array[CategoryRepository]
	 */
	private $categories;

	/**
	 * @var float
	 */
	private $popularity;

	/**
	 * @var string
	 */
	private $language;

	/**
	 * Movie2Representation constructor.
	 */
	public function __construct()
	{
		$this->categories    = [];
		$this->categoriesIds = [];
	}

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
	 * @return \DateTime
	 */
	public function getReleasedAt(): ?\DateTime
	{
		return $this->releasedAt;
	}

	/**
	 * @param \DateTime|null $releasedAt
	 *
	 * @return MovieRepresentation
	 */
	public function setReleasedAt(\DateTime $releasedAt = null): MovieRepresentation
	{
		$this->releasedAt = $releasedAt;

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

	/**
	 * @return array
	 */
	public function getCategoriesIds(): array
	{
		return $this->categoriesIds;
	}

	/**
	 * @param int|null $categoryId
	 *
	 * @return MovieRepresentation
	 */
	public function setCategoriesId(int $categoryId = null): MovieRepresentation
	{
		$this->categoriesIds[] = $categoryId;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getCategories(): array
	{
		return $this->categories;
	}

	/**
	 * @param CategoryRepresentation|null $categoryRepresentation
	 *
	 * @return MovieRepresentation
	 */
	public function setCategories(CategoryRepresentation $categoryRepresentation = null): MovieRepresentation
	{
		$this->categories[] = $categoryRepresentation;

		return $this;
	}

	/**
	 * @return float|null
	 */
	public function getPopularity(): ?float
	{
		return $this->popularity;
	}

	/**
	 * @param float|null $popularity
	 *
	 * @return MovieRepresentation
	 */
	public function setPopularity(float $popularity = null): MovieRepresentation
	{
		$this->popularity = $popularity;

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
	 * @param string|null $language
	 *
	 * @return MovieRepresentation
	 */
	public function setLanguage(string $language = null): MovieRepresentation
	{
		$this->language = $language;

		return $this;
	}

}
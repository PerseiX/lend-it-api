<?php

namespace App\Entity;

use ApiBundle\Entity\Traits\ActiveTrait;
use ApiBundle\Entity\Traits\IDTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Movie
 * @package PerseiX\ProjectBundle\Entity
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="App\Repository\MovieRepository")
 */
class Movie
{
	use IDTrait;
	use ActiveTrait;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=256)
	 */
	private $title;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=2048, nullable=true)
	 */
	private $description;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(type="datetime", nullable=true)
	 */
	private $releasedAt;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=128, nullable=true)
	 */
	private $imagePath;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=16, nullable=true)
	 */
	private $language;

	/**
	 * @var float
	 *
	 * @ORM\Column(type="float", nullable=true)
	 */
	private $popularity;

	/**
	 * @var ArrayCollection[Category]|null
	 *
	 * @ORM\ManyToMany(targetEntity="App\Entity\Category", mappedBy="movies")
	 * @ORM\JoinColumn(referencedColumnName="id")
	 */
	private $categories;

	/**
	 * Movie constructor.
	 */
	public function __construct()
	{
		$this->categories = new ArrayCollection();
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
	 * @return null|string
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
	 * @return \DateTime|null
	 */
	public function getReleasedAt(): ?\DateTime
	{
		return $this->releasedAt;
	}

	/**
	 * @param \DateTime $releasedAt
	 *
	 * @return Movie
	 */
	public function setReleasedAt(\DateTime $releasedAt): Movie
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
	 * @param string $imagePath
	 *
	 * @return Movie
	 */
	public function setImagePath(string $imagePath): Movie
	{
		$this->imagePath = $imagePath;

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
	 * @return ArrayCollection
	 */
	public function getCategories()
	{
		return $this->categories;
	}

	/**
	 * @param Category|null $category
	 *
	 * @return Movie
	 */
	public function addCategory(Category $category = null): Movie
	{
		if (false === $this->categories->contains($category)) {
			$this->categories->add($category);
			$category->addMovie($this);
		}

		return $this;
	}

	/**
	 * @param Category|null $category
	 *
	 * @return Movie
	 */
	public function removeCategory(Category $category = null): Movie
	{
		if (true === $this->categories->contains($category)) {
			$this->categories->removeElement($category);
			$category->removeMovie($this);
		}

		return $this;
	}

	/**
	 * @return float
	 */
	public function getPopularity(): float
	{
		return $this->popularity;
	}

	/**
	 * @param float $popularity
	 *
	 * @return Movie
	 */
	public function setPopularity(float $popularity): Movie
	{
		$this->popularity = $popularity;

		return $this;
	}
}
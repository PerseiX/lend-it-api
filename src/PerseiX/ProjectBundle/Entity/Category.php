<?php

namespace PerseiX\ProjectBundle\Entity;

use ApiBundle\Entity\Traits\ActiveTrait;
use ApiBundle\Entity\Traits\IDTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Category
 * @package PerseiX\ProjectBundle\Entity
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Category
{
	use IDTrait;
	use ActiveTrait;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=128)
	 */
	private $name;

	/**
	 * @var ArrayCollection[Movie]|null
	 * @ORM\ManyToMany(targetEntity="PerseiX\ProjectBundle\Entity\Movie", indexBy="categories")
	 * @ORM\JoinColumn(referencedColumnName="id")
	 */
	private $movies;

	/**
	 * Category constructor.
	 */
	public function __construct()
	{
		$this->movies = new ArrayCollection();
	}

	/**
	 * @return null|string
	 */
	public function getName(): ?string
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 *
	 * @return Category
	 */
	public function setName(string $name): Category
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * @return ArrayCollection
	 */
	public function getMovies(): ArrayCollection
	{
		return $this->movies;
	}

	/**
	 * @param Movie|null $movie
	 *
	 * @return Category
	 */
	public function addMovie(Movie $movie = null): Category
	{
		if (false === $this->movies->contains($movie)) {
			$this->movies->add($movie);
			$movie->addCategory($this);
		}

		return $this;
	}

	/**
	 * @param Movie|null $movie
	 *
	 * @return Category
	 */
	public function removeMovie(Movie $movie = null): Category
	{
		if (true === $this->movies->contains($movie)) {
			$this->movies->removeElement($movie);
			$movie->removeCategory($this);
		}

		return $this;
	}

	/**
	 * @return string
	 */
	public function __toString()
	{
		return (string)$this->getName();
	}

}
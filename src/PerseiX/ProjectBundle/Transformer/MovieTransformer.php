<?php

namespace PerseiX\ProjectBundle\Transformer;

use ApiBundle\Representation\RepresentationInterface;
use ApiBundle\Transformer\AbstractTransformer;
use PerseiX\AdminBundle\Resolver\PathResolver;
use PerseiX\ProjectBundle\Entity\Category;
use PerseiX\ProjectBundle\Entity\Movie;
use PerseiX\ProjectBundle\Representation\MovieRepresentation;

/**
 * Class MovieTransformer
 * @package PerseiX\ProjectBundle\Transformer
 */
class MovieTransformer extends AbstractTransformer
{

	/**
	 * @var PathResolver
	 */
	private $imagePathResolver;

	/**
	 * @param PathResolver $resolver
	 *
	 * @return $this
	 */
	public function setImagePathResolver(PathResolver $resolver)
	{
		$this->imagePathResolver = $resolver;

		return $this;
	}

	/**
	 * @param $input
	 *
	 * @return bool
	 */
	public function support($input): bool
	{
		return $input instanceof Movie;
	}

	/**
	 * @param $input
	 *
	 * @return RepresentationInterface
	 */
	public function transform($input): RepresentationInterface
	{
		$representation = new MovieRepresentation();

		/** @var Movie $input */
		$representation->setId($input->getId())
		               ->setDescription($input->getDescription())
		               ->setImagePath($this->imagePathResolver->resolve($input->getImagePath()))
		               ->setReleasedAt($input->getReleasedAt())
		               ->setTitle($input->getTitle())
		               ->setLanguage($input->getLanguage())
		               ->setPopularity($input->getPopularity());

		/** @var Category $category */
		foreach ($input->getCategories() as $category) {
			$representation->setCategoriesId($category->getId());
		}

		return $representation;
	}
}
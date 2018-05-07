<?php

namespace App\Transformer\Scope\Category;

use App\Entity\Category;
use App\Entity\Movie;
use ApiBundle\Transformer\Scope\AbstractTransformerScope;
use ApiBundle\Representation\RepresentationInterface;
use App\Representation\MovieRepresentation;
use Negotiation\Exception\InvalidArgument;

/**
 * Class MovieScope
 * @package PerseiX\ProjectBundle\Transformer\Scope\Category
 */
class MovieScope extends AbstractTransformerScope
{

	/**
	 * @return string
	 */
	public function getScopeName(): string
	{
		return 'category.movies';
	}

	/**
	 * @param RepresentationInterface $representation
	 * @param                         $input
	 *
	 * @return RepresentationInterface
	 */
	public function applyScope(RepresentationInterface $representation, $input): RepresentationInterface
	{
		if (false === $input instanceof Movie) {
			throw new InvalidArgument("Invalid argument. This class is not allowed.");
		}

		/** @var Movie $input */
		$categories = $input->getCategories();

		if (0 !== $categories->count()) {
			/** @var Category $category */
			foreach ($categories as $category) {
				$categoryRepresentation = $this->getTransformer()->transform($category);
				/** @var MovieRepresentation $representation */
				$representation->setCategories($categoryRepresentation);
			}
		}

		return $representation;
	}

	/**
	 * @param RepresentationInterface $representation
	 * @param                         $input
	 *
	 * @return bool
	 */
	public function support(RepresentationInterface $representation, $input): bool
	{
		return $representation instanceof MovieRepresentation && $input instanceof Movie;
	}
}
<?php

namespace App\Transformer;

use ApiBundle\Representation\RepresentationInterface;
use ApiBundle\Transformer\AbstractTransformer;
use App\Entity\Category;
use App\Representation\CategoryRepresentation;

/**
 * Class CategoryTransformer
 * @package PerseiX\ProjectBundle\Transformer
 */
class CategoryTransformer extends AbstractTransformer
{

	/**
	 * @param $input
	 *
	 * @return bool
	 */
	public function support($input): bool
	{
		return $input instanceof Category;
	}

	/**
	 * @param $input
	 *
	 * @return RepresentationInterface
	 */
	public function transform($input): RepresentationInterface
	{
		$representation = new CategoryRepresentation();

		/** @var Category $input */
		$representation
			->setActive($input->isActive())
			->setId($input->getId())
			->setName($input->getName());

		return $representation;
	}
}
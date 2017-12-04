<?php

namespace PerseiX\ProjectBundle\Transformer\Collection;

use PerseiX\ProjectBundle\Representation\CategoryRepresentationCollection;
use ApiBundle\Representation\RepresentationInterface;
use PerseiX\ProjectBundle\Model\CategoryCollection;
use ApiBundle\Transformer\AbstractTransformer;
use ApiBundle\Model\AbstractModelCollection;

/**
 * Class CategoryCollectionTransformer
 * @package PerseiX\ProjectBundle\Transformer\Collection
 */
class CategoryCollectionTransformer extends AbstractTransformer
{
	/**
	 * @param $input
	 *
	 * @return bool
	 */
	public function support($input): bool
	{
		return $input instanceof CategoryCollection;
	}

	/**
	 * @param $input
	 *
	 * @return RepresentationInterface
	 */
	public function transform($input): RepresentationInterface
	{
		$collection = [];
		/** @var AbstractModelCollection $input */
		foreach ($input->getCollection() as $item) {
			$collection[] = $this->getTransformer()->transform($item);
		}

		return new CategoryRepresentationCollection($collection);
	}
}
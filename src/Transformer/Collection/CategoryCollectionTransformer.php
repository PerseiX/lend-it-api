<?php

namespace App\Transformer\Collection;

use App\Model\CategoryCollection;
use ApiBundle\Representation\RepresentationInterface;
use ApiBundle\Transformer\AbstractTransformer;
use ApiBundle\Model\AbstractModelCollection;
use App\Representation\CategoryRepresentationCollection;

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
<?php

namespace PerseiX\ProjectBundle\Transformer\Collection;

use ApiBundle\Model\AbstractModelCollection;
use ApiBundle\Representation\RepresentationInterface;
use ApiBundle\Transformer\AbstractTransformer;
use PerseiX\ProjectBundle\Model\MovieCollection;
use PerseiX\ProjectBundle\Representation\MovieRepresentationCollection;

/**
 * Class MovieCollectionTransformer
 * @package Persei\ProjectBundle\Transformer\Collection
 */
class MovieCollectionTransformer extends AbstractTransformer
{
	/**
	 * @param $input
	 *
	 * @return bool
	 */
	public function support($input): bool
	{
		return $input instanceof MovieCollection;
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

		return new MovieRepresentationCollection($collection);
	}
}
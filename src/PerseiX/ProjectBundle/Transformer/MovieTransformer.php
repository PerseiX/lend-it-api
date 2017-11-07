<?php

namespace PerseiX\ProjectBundle\Transformer;

use ApiBundle\Representation\RepresentationInterface;
use ApiBundle\Transformer\AbstractTransformer;
use PerseiX\ProjectBundle\Model\Movie;
use PerseiX\ProjectBundle\Representation\MovieRepresentation;

/**
 * Class MovieTransformer
 * @package PerseiX\ProjectBundle\Transformer
 */
class MovieTransformer extends AbstractTransformer
{

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
		               ->setGenreIds($input->getGenreIds())
		               ->setImagePath($input->getImagePath())
		               ->setLanguage($input->getLanguage())
		               ->setReleaseAt($input->getReleaseAt())
		               ->setTitle($input->getTitle());

		return $representation;
	}
}
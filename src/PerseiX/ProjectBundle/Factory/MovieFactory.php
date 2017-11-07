<?php

namespace PerseiX\ProjectBundle\Factory;

use PerseiX\ProjectBundle\Model\Movie;
use PerseiX\ProjectBundle\Resolver\ImagePathResolver;

/**
 * Class MovieFactory
 * @package PerseiX\ProjectBundle\Factory
 */
class MovieFactory
{
	public function create(\stdClass $object)
	{
		$movie = new Movie();
		$movie
			->setId($object->id)
			->setLanguage($object->original_language)
			->setTitle($object->title)
			->setReleaseAt(new \DateTime($object->release_date))
			->setGenreIds($object->genre_ids)
			->setDescription($object->overview)
			->setImagePath(ImagePathResolver::resolve($object->poster_path));

		return $movie;
	}
}
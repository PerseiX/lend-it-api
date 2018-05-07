<?php

namespace App\Resolver;

/**
 * Class ImagePathResolver
 * @package PerseiX\ProjectBundle\Resolver
 */
class ImagePathResolver
{
	const URL = 'https://image.tmdb.org/t/p/w500';

	/**
	 * @param string|null $imagePath
	 *
	 * @return null|string
	 */
	public static function resolve(string $imagePath = null): ?string
	{
		if (null != $imagePath) {
			return self::URL . $imagePath;
		}

		return null;
	}
}
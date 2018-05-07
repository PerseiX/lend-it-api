<?php

namespace App\Resolver\Admin;

use App\Resolver\Admin\PathResolver;
use Speicher210\CloudinaryBundle\Cloudinary\Cloudinary;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class ImagePathResolver
 * @package PerseiX\AdminBundle\Resolver
 */
class ImagePathResolver implements PathResolver
{
	const DIR = 'uploads/movies';

	/**
	 * @var Cloudinary
	 */
	private $cloudinary;

	/**
	 * ImagePathResolver constructor.
	 *
	 * @param Cloudinary $cloudinary
	 */
	public function __construct(Cloudinary $cloudinary)
	{
		$this->cloudinary = $cloudinary;
	}

	/**
	 * @param string|null $imagePublicId
	 *
	 * @return null|string
	 */
	public function resolve(string $imagePublicId = null): ?string
	{
		if (null === $imagePublicId) {
			return null;
		}

		$options = [];

		return $this->cloudinary::cloudinary_url($imagePublicId, $options);
	}
}
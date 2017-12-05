<?php

namespace PerseiX\AdminBundle\Resolver;

use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class ImagePathResolver
 * @package PerseiX\AdminBundle\Resolver
 */
class ImagePathResolver implements PathResolver
{
	const DIR = 'uploads/movies';

	/**
	 * @var RequestStack
	 */
	private $request;

	/**
	 * ImagePathResolver constructor.
	 *
	 * @param RequestStack $request
	 */
	public function __construct(RequestStack $request)
	{
		$this->request = $request->getCurrentRequest();
	}

	/**
	 * @param string|null $fileName
	 *
	 * @return null|string
	 */
	public function resolve(string $fileName = null): ?string
	{
		if (null === $fileName) {
			return null;
		}
		$url = str_replace('app_dev.php', '', $this->request->getUriForPath(self::DIR . '/' . $fileName));

		return $url;
	}
}
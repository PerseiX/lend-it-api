<?php

namespace PerseiX\AdminBundle\Resolver;

/**
 * Interface PathResolver
 * @package PerseiX\AdminBundle\Resolver
 */
interface PathResolver
{
	/**
	 * @param string|null $path
	 *
	 * @return null|string
	 */
	public function resolve(string $path = null): ?string;
}
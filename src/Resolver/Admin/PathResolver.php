<?php

namespace App\Resolver\Admin;

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
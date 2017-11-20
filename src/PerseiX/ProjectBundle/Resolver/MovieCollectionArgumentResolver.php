<?php

namespace PerseiX\ProjectBundle\Resolver;

use PerseiX\ProjectBundle\Factory\MovieFactory;
use PerseiX\ProjectBundle\Model\MovieCollection;
use PerseiX\ProjectBundle\Service\HttpFetcher;
use PerseiX\ProjectBundle\Service\ProxyFetcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

/**
 * Class MovieCollectionArgumentResolver
 * @package Persei\ProjectBundle\Resolver
 */
class MovieCollectionArgumentResolver implements ArgumentValueResolverInterface
{
	/**
	 * @var ProxyFetcher
	 */
	private $proxyFetcher;

	/**
	 * @var MovieFactory
	 */
	private $movieFactory;

	/**
	 * MovieCollectionArgumentResolver constructor.
	 *
	 * @param ProxyFetcher  $proxyFetcher
	 * @param MovieFactory $movieFactory
	 */
	public function __construct(ProxyFetcher $proxyFetcher, MovieFactory $movieFactory)
	{
		$this->proxyFetcher  = $proxyFetcher;
		$this->movieFactory = $movieFactory;
	}

	/**
	 * @param Request          $request
	 * @param ArgumentMetadata $argument
	 *
	 * @return bool
	 */
	public function supports(Request $request, ArgumentMetadata $argument)
	{
		return $argument->getType() === MovieCollection::class;
	}

	/**
	 * @param Request          $request
	 * @param ArgumentMetadata $argument
	 *
	 * @return \Generator
	 */
	public function resolve(Request $request, ArgumentMetadata $argument)
	{
		$results    = json_decode($this->proxyFetcher->fetch())->results;
		$collection = [];
		foreach ($results as $result) {
			$collection[] = $this->movieFactory->create($result);
		}
		yield new MovieCollection($collection);
	}
}
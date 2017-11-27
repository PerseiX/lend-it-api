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
	 * @var MovieFactory
	 */
	private $movieFactory;

	/**
	 * @var HttpFetcher
	 */
	private $httpFetcher;

	/**
	 * MovieCollectionArgumentResolver constructor.
	 *
	 * @param MovieFactory $movieFactory
	 * @param HttpFetcher  $httpFetcher
	 */
	public function __construct(MovieFactory $movieFactory, HttpFetcher $httpFetcher)
	{
		$this->movieFactory = $movieFactory;
		$this->httpFetcher  = $httpFetcher;
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
		$results    = json_decode($this->httpFetcher->fetch())->results;
		$collection = [];
		foreach ($results as $result) {
			$collection[] = $this->movieFactory->create($result);
		}
		yield new MovieCollection($collection);
	}
}
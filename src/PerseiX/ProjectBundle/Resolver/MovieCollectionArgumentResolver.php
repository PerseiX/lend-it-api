<?php

namespace PerseiX\ProjectBundle\Resolver;

use PerseiX\ProjectBundle\Factory\MovieFactory;
use PerseiX\ProjectBundle\Model\MovieCollection;
use PerseiX\ProjectBundle\Service\HttpFetcher;
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
	 * @var HttpFetcher
	 */
	private $httpFetcher;

	/**
	 * @var MovieFactory
	 */
	private $movieFactory;

	/**
	 * MovieCollectionArgumentResolver constructor.
	 *
	 * @param HttpFetcher  $httpFetcher
	 * @param MovieFactory $movieFactory
	 */
	public function __construct(HttpFetcher $httpFetcher, MovieFactory $movieFactory)
	{
		$this->httpFetcher  = $httpFetcher;
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
		$results    = json_decode($this->httpFetcher->fetch())->results;
		$collection = [];
		foreach ($results as $result) {
			$collection[] = $this->movieFactory->create($result);
		}
		yield new MovieCollection($collection);
	}
}
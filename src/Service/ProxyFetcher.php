<?php

namespace App\Service;

use Predis\ClientInterface;

/**
 * Class ProxyFetcher
 * @package PerseiX\ProjectBundle\Service
 */
class ProxyFetcher
{
	const COLLECTION_KEY = "movies_collection";

	/**
	 * @var ClientInterface
	 */
	private $redis;

	/**
	 * @var HttpFetcher
	 */
	private $httpFetcher;

	/**
	 * ProxyFetcher constructor.
	 *
	 * @param ClientInterface $redis
	 * @param HttpFetcher     $httpFetcher
	 */
	public function __construct(ClientInterface $redis, HttpFetcher $httpFetcher)
	{
		$this->redis       = $redis;
		$this->httpFetcher = $httpFetcher;
	}

	/**
	 * @return string
	 */
	public function fetch()
	{
		if (null === $this->redis->get(self::COLLECTION_KEY)) {
			$data = $this->httpFetcher->fetch();
			$this->redis->set(self::COLLECTION_KEY, $data);

			return $data;
		} else {
			return $this->redis->get(self::COLLECTION_KEY);
		}
	}
}
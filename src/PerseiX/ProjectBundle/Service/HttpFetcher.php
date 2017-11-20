<?php

namespace PerseiX\ProjectBundle\Service;

use GuzzleHttp\Client;

/**
 * Class HttpFetcher
 * @package Persei\ProjectBundle\Service
 */
class HttpFetcher
{
	const COLLECTION_URL = 'https://api.themoviedb.org/3/movie/popular?api_key=684c5d83e02a6730d4886694f0bc4fbe&language=en-US&query=string&page=2&include_adult=true';

	/**
	 * @var Client
	 */
	private $client;

	/**
	 * HttpFetcher constructor.
	 *
	 * @param Client $client
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	public function fetch()
	{
		return $this->client
			->get(self::COLLECTION_URL)
			->getBody()->getContents();
	}

	/**
	 * @param int $id
	 *
	 * @return string
	 */
	public function fetchSingle(int $id)
	{
		return $this->client
			->get('https://api.themoviedb.org/3/movie/' . $id . '?api_key=684c5d83e02a6730d4886694f0bc4fbe')
			->getBody()->getContents();
	}
}
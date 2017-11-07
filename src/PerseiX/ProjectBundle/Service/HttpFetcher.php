<?php

namespace PerseiX\ProjectBundle\Service;

use GuzzleHttp\Client;

/**
 * Class HttpFetcher
 * @package Persei\ProjectBundle\Service
 */
class HttpFetcher
{
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
		return $this->client->get('https://api.themoviedb.org/3/search/movie?api_key=684c5d83e02a6730d4886694f0bc4fbe&language=en-US&query=string&page=1&include_adult=false')
		                    ->getBody()->getContents();
	}
}
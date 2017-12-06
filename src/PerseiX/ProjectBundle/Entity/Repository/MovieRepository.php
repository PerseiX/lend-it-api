<?php

namespace PerseiX\ProjectBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * Class MovieRepository
 * @package PerseiX\ProjectBundle\Entity\Repository
 */
class MovieRepository extends EntityRepository
{
	/**
	 * @return Query
	 */
	public function collectionQuery(): Query
	{
		$query = $this->createQueryBuilder('movie_repository')
		              ->getQuery();

		return $query;
	}
}
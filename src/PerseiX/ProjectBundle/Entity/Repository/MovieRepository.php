<?php

namespace PerseiX\ProjectBundle\Entity\Repository;

use SortAndFilterBundle\Model\Repository\ApiRepository;
use Doctrine\ORM\Query;

/**
 * Class MovieRepository
 * @package PerseiX\ProjectBundle\Entity\Repository
 */
class MovieRepository extends ApiRepository
{
	/**
	 * @return Query
	 */
	public function collectionQuery(): Query
	{
		$qb = $this->createQueryBuilder('movie_repository');
		$queryBuilder = $this->customerSorting->apply($qb);

		return $queryBuilder->getQuery();
	}
}
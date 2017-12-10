<?php

namespace PerseiX\ProjectBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use SortAndFilterBundle\Model\Repository\ApiRepository;

/**
 * Class CategoryRepository
 * @package PerseiX\ProjectBundle\Entity\Repository
 */
class CategoryRepository extends ApiRepository
{
	/**
	 * @return Query
	 */
	public function collectionQuery(): Query
	{
		$qb           = $this->createQueryBuilder('category_repository');
		$queryBuilder = $this->customerSorting->apply($qb);

		return $queryBuilder->getQuery();
	}
}
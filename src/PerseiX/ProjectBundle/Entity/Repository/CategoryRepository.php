<?php

namespace PerseiX\ProjectBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * Class CategoryRepository
 * @package PerseiX\ProjectBundle\Entity\Repository
 */
class CategoryRepository extends EntityRepository
{
	/**
	 * @return Query
	 */
	public function collectionQuery(): Query
	{
		$query = $this->createQueryBuilder('category_repository')
		              ->getQuery();

		return $query;
	}
}
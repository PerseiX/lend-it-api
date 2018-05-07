<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\ORM\EntityRepository;
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

		return $qb->getQuery();
	}

	/**
	 * @param Category $category
	 *
	 * @return Query
	 */
	public function getMoviesQueryByCategory(Category $category): Query
	{

		$qb = $this->createQueryBuilder('movie_repository')
		           ->andWhere('category_repository.id = :categoryId')
		           ->leftJoin('movie_repository.categories', 'category_repository')
		           ->setParameter('categoryId', $category->getId());

		$queryBuilder = $this->customerSorting->apply($qb);

		return $qb->getQuery();
	}
}
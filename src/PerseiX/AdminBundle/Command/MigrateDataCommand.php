<?php

namespace PerseiX\AdminBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Output\OutputInterface;
use PerseiX\AdminBundle\Resolver\ImagePathResolver;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Filesystem\Filesystem;
use PerseiX\ProjectBundle\Entity\Category;
use PerseiX\ProjectBundle\Entity\Movie;

/**
 * Class MigrateDataCommand
 * @package PerseiX\AdminBundle\Command
 */
class MigrateDataCommand extends ContainerAwareCommand
{
	protected function configure()
	{
		$this->setName('movie:data:migrate');
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
//		$this->migrateMovie($output);
//		$this->migrateCategory();
		$em = $this->getContainer()->get('doctrine.orm.entity_manager');
		$em->flush();
	}

	private function migrateMovie(OutputInterface $output)
	{
		$em        = $this->getContainer()->get('doctrine.orm.entity_manager');
		$moviePath = 'https://api.themoviedb.org/3/movie/popular?api_key=684c5d83e02a6730d4886694f0bc4fbe&language=pl-PL&page=2';

		$guzzle        = $this->getContainer()->get('guzzle_client');
		$movies        = $guzzle->get($moviePath)->getBody()->getContents();
		$moviesDecoded = \GuzzleHttp\json_decode($movies);

		foreach ($moviesDecoded->results as $movie) {

			$imagePath = 'https://image.tmdb.org/t/p/w500' . $movie->poster_path;
			$fileName  = trim($movie->poster_path, '/');

			$dir        = $this->getContainer()->getParameter('kernel.root_dir') . '/../web/' . ImagePathResolver::DIR;
			$filesystem = new Filesystem();
			$filesystem->copy($imagePath, $dir . $movie->poster_path);

			$movieEntity = new Movie();
			$movieEntity
				->setActive(true)
				->setReleasedAt(new \DateTime($movie->release_date))
				->setDescription($movie->overview)
				->setImagePath($fileName)
				->setLanguage($movie->original_language)
				->setTitle($movie->original_title);

			foreach ($movie->genre_ids as $genre) {
				$category = $em->getRepository('PerseiXProjectBundle:Category')->findOneBy(['id' => $genre]);

				if (null !== $category) {
					$movieEntity->addCategory($category);
				}
			}
			$output->writeln(sprintf('<info>Migrate movie: %s</info>', $movie->original_title));
			$em->persist($movieEntity);
		}
	}

	private function migrateCategory()
	{
		$em           = $this->getContainer()->get('doctrine.orm.entity_manager');
		$categoryPath = 'https://api.themoviedb.org/3/genre/movie/list?api_key=684c5d83e02a6730d4886694f0bc4fbe&language=pl-PL';

		$guzzle          = $this->getContainer()->get('guzzle_client');
		$category        = $guzzle->get($categoryPath)->getBody()->getContents();
		$categoryDecoded = \GuzzleHttp\json_decode($category);

		foreach ($categoryDecoded->genres as $genre) {
			$category = new Category();

			$category
				->setId($genre->id)
				->setName($genre->name)
				->setActive(true);

			$em->persist($category);
		}
	}

}
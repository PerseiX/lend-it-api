<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
	public function registerBundles()
	{
		$bundles = [
			new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
			new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
			new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
			new Bazinga\Bundle\HateoasBundle\BazingaHateoasBundle(),
			new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
			new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
			new Symfony\Bundle\SecurityBundle\SecurityBundle(),
			new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
			new Symfony\Bundle\MonologBundle\MonologBundle(),
			new PerseiX\ProjectBundle\PerseiXProjectBundle(),
			new FOS\OAuthServerBundle\FOSOAuthServerBundle(),
			new JMS\SerializerBundle\JMSSerializerBundle(),
			new Nelmio\ApiDocBundle\NelmioApiDocBundle(),
			new PerseiX\AdminBundle\PerseiXAdminBundle(),
			new Symfony\Bundle\TwigBundle\TwigBundle(),
			new PerseiX\UserBundle\PerseiXUserBundle(),
			new FOS\UserBundle\FOSUserBundle(),
			new FOS\RestBundle\FOSRestBundle(),
			new ApiBundle\ApiBundle(),
			//			new Snc\RedisBundle\SncRedisBundle(),
		];

		$bundles = array_merge($bundles, [
			new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
			new Sonata\BlockBundle\SonataBlockBundle(),
			new Sonata\AdminBundle\SonataAdminBundle(),
			new Knp\Bundle\MenuBundle\KnpMenuBundle(),
			new Sonata\CoreBundle\SonataCoreBundle(),
		]);

		if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
			$bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
			$bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
			$bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();

			if ('dev' === $this->getEnvironment()) {
				$bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
				$bundles[] = new Symfony\Bundle\WebServerBundle\WebServerBundle();
			}
		}

		return $bundles;
	}

	public function getRootDir()
	{
		return __DIR__;
	}

	public function getCacheDir()
	{
		return dirname(__DIR__) . '/var/cache/' . $this->getEnvironment();
	}

	public function getLogDir()
	{
		return dirname(__DIR__) . '/var/logs';
	}

	public function registerContainerConfiguration(LoaderInterface $loader)
	{
		$loader->load($this->getRootDir() . '/config/config_' . $this->getEnvironment() . '.yml');
	}
}

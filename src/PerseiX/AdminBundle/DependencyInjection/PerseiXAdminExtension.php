<?php

namespace PerseiX\AdminBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class PerseiXAdminExtension
 * @package PerseiX\AdminBundle\DependencyInjection
 */
class PerseiXAdminExtension extends Extension
{
	/**
	 * @param array            $configs
	 * @param ContainerBuilder $container
	 */
	public function load(array $configs, ContainerBuilder $container)
	{

		$loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
		$loader->load('admins.yml');
		$loader->load('services.yml');
	}
}
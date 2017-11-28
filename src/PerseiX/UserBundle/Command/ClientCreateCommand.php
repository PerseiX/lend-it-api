<?php

namespace PerseiX\UserBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class ClientCreateCommand
 * @package UserBundle\Command
 */
class ClientCreateCommand extends ContainerAwareCommand
{
	const CLIENT_MANAGER = 'fos_oauth_server.client_manager.default';

	/**
	 * {@inheritdoc}
	 */
	protected function configure()
	{
		$this->setName('oauth2:client:create')
		     ->setDescription("Command allow you crete OAuth2 client.")
		     ->setHelp("Use command with parameters: allowedGrantType clientName redirectUris")
		     ->addArgument('allowedGrantType', InputArgument::REQUIRED, 'Allowed grant types [authorization_code, refresh_token]')
		     ->addArgument('clientName', InputArgument::REQUIRED, 'Client name')
		     ->addArgument('redirectUris', InputArgument::IS_ARRAY | InputArgument::REQUIRED, 'Redirect uris');
	}

	/**
	 * @param InputInterface  $input
	 * @param OutputInterface $output
	 *
	 * {@inheritdoc}
	 */
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$allowedGrantType = $input->getArgument('allowedGrantType');
		$clientName       = $input->getArgument('clientName');
		$redirectUris     = $input->getArgument('redirectUris');

		$clientManager = $this->getContainer()->get(self::CLIENT_MANAGER);
		$client        = $clientManager->createClient();
		$client->setRedirectUris($redirectUris);
		$client->setAllowedGrantTypes([$allowedGrantType]);
		$client->setName($clientName);
		$clientManager->updateClient($client);

		$output->writeln(sprintf("Added client with id: %s secret: %s", $client->getPublicId(), $client->getSecret()));
	}

}
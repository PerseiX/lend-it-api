<?php

namespace PerseiX\UserBundle\Transformer;

use ApiBundle\Representation\RepresentationInterface;
use ApiBundle\Transformer\AbstractTransformer;
use PerseiX\UserBundle\Entity\User;
use PerseiX\UserBundle\Representation\UserRepresentation;

/**
 * Class UserTransformer
 * @package PerseiX\UserBundle\Transformer
 */
class UserTransformer extends AbstractTransformer
{

	/**
	 * @param $input
	 *
	 * @return bool
	 */
	public function support($input): bool
	{
		return $input instanceof User;
	}

	/**
	 * @param $input
	 *
	 * @return RepresentationInterface
	 */
	public function transform($input): RepresentationInterface
	{
		$representation = new UserRepresentation();

		/** @var User $input */
		$representation
			->setId($input->getId())
			->setEmail($input->getEmail())
			->setEnabled($input->isEnabled())
			->setLastLogin($input->getLastLogin())
			->setUsername($input->getUsername());

		return $representation;
	}
}
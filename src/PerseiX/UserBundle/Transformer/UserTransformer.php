<?php

namespace PerseiX\UserBundle\Transformer;

use ApiBundle\Representation\RepresentationInterface;
use ApiBundle\Transformer\AbstractTransformer;
use PerseiX\UserBundle\Entity\UserModel;
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
		return $input instanceof UserModel;
	}

	/**
	 * @param $input
	 *
	 * @return RepresentationInterface
	 */
	public function transform($input): RepresentationInterface
	{
		$representation = new UserRepresentation();

		/** @var UserModel $input */
		$representation
			->setId($input->getId())
			->setEmail($input->getEmail())
			->setEnabled($input->isEnabled())
			->setLastLogin($input->getLastLogin())
			->setUsername($input->getUsername());

		return $representation;
	}
}
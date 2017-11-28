<?php

namespace PerseiX\UserBundle\Validator\Constraints;

use PerseiX\UserBundle\Exception\PropertyNotFoundException;
use Symfony\Component\Validator\ConstraintValidator;
use PerseiX\UserBundle\Exception\ClassNotExist;
use Symfony\Component\Validator\Constraint;
use Doctrine\ORM\EntityManager;

/**
 * Class UniqueFieldValidator
 * @package PerseiX\UserBundle\Validator\Constraints
 */
class UniqueFieldValidator extends ConstraintValidator
{
	/**
	 * @var EntityManager
	 */
	private $em;

	/**
	 * UniqueFieldValidator constructor.
	 *
	 * @param EntityManager $em
	 */
	public function __construct(EntityManager $em)
	{
		$this->em = $em;
	}

	/**
	 * @param mixed      $value
	 * @param Constraint $constraint
	 *
	 * @throws ClassNotExist
	 * @throws PropertyNotFoundException
	 */
	public function validate($value, Constraint $constraint)
	{

		if (false === class_exists($constraint->entityClass)) {
			throw new ClassNotExist(
				sprintf("Class '%s' does not exist in 'entityClass' property", $constraint->entityClass)
			);
		}

		$object = new $constraint->entityClass;
		if (false === property_exists($object, $constraint->field)) {
			throw new PropertyNotFoundException(
				sprintf("Property '%s' in class '%s' not exist", $constraint->field, $constraint->entityClass)
			);
		}

		$result = $this->em->getRepository($constraint->entityClass)->findBy([$constraint->field => $value]);

		if (count($result) > 0) {
			$this->context->buildViolation($constraint->message)
			              ->setParameter('{{ field }}', $constraint->field)
			              ->addViolation();
		}
	}
}
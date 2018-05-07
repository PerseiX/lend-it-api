<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class UniqueField
 * @package PerseiX\UserBundle\Validator\Constraints
 */
class UniqueField extends Constraint
{
	public $message = "Podany {{ field }} już istnieje.";

	/**
	 * @var string
	 */
	public $field;

	/**
	 * @var null
	 */
	public $entityClass = null;

	/**
	 * @return string
	 */
	public function validatedBy()
	{
		return get_class($this) . 'Validator';
	}

}
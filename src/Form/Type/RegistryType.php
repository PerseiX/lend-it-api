<?php

namespace App\Form\Type;

use App\Model\RegistryModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class RegistryType
 * @package PerseiX\UserBundle\Form
 */
class RegistryType extends AbstractType
{

	/**
	 * @param FormBuilderInterface $builder
	 * @param array                $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('username', TextType::class)
			->add('password', RepeatedType::class, [
				'type' => PasswordType::class,
				'invalid_message' => 'Podane hasła nie są identyczne.'
			])
			->add('email', EmailType::class);
	}

	/**
	 * @param OptionsResolver $resolver
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class'         => RegistryModel::class,
			'allow_extra_fields' => true,
			'csrf_protection'    => false
		]);
	}

}
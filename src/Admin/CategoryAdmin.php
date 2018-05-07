<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class CategoryAdmin
 * @package PerseiX\AdminBundle\Admin
 */
class CategoryAdmin extends AbstractAdmin
{
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper->add('name', TextType::class)
		           ->add('active', ChoiceType::class, [
			           'choices' => [
				           'Yes' => true,
				           'No'  => false
			           ]
		           ]);
	}

	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper->add('name')
		               ->add('active');
	}

	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper->addIdentifier('name')
		           ->add('active', null, [
			           'editable' => true
		           ]);
	}
}
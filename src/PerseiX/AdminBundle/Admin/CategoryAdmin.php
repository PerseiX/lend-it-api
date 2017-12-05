<?php

namespace PerseiX\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class CategoryAdmin
 * @package PerseiX\AdminBundle\Admin
 */
class CategoryAdmin extends AbstractAdmin
{
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper->add('name', 'text')
		           ->add('active', 'choice', [
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
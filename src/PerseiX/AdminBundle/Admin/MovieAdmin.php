<?php

namespace PerseiX\AdminBundle\Admin;

use PerseiX\AdminBundle\Form\Type\UploadFileType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class MovieADmin
 * @package PerseiX\AdminBundle\Admin
 */
class MovieAdmin extends AbstractAdmin
{
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
			->add('title', 'text')
			->add('description', 'text')
			->add('releasedAt', 'date')
			->add('categories', 'sonata_type_model', [
				'multiple'     => true,
				'by_reference' => false
			])
			->add('active', 'choice', [
				'choices' => [
					'Yes' => true,
					'No'  => false
				]
			])
			->add('imagePath', UploadFileType::class, [
				'required' => false
			]);
	}

	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
			->add('title')
			->add('active');
	}

	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
			->addIdentifier('title')
			->add('releasedAt')
			->add('active', null, [
				'editable' => true
			])
			->add('imagePath', null, [
				'template' => 'PerseiXAdminBundle:Sonata:image_preview.html.twig'
			]);
	}

}
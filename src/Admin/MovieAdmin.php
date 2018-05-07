<?php

namespace App\Admin;

use App\Form\Type\UploadFileType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class MovieADmin
 * @package PerseiX\AdminBundle\Admin
 */
class MovieAdmin extends AbstractAdmin
{
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
			->add('title', TextType::class)
			->add('description', TextType::class)
			->add('releasedAt', DateType::class)
			->add('popularity', TextType::class)
			->add('categories', ModelType::class, [
				'multiple'     => true,
				'by_reference' => false
			])
			->add('active', ChoiceType::class, [
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
			->add('categories')
			->add('active', null, [
				'editable' => true
			])
			->add('imagePath', null, [
				'template' => 'PerseiXAdminBundle:Sonata:image_preview.html.twig'
			]);
	}

}
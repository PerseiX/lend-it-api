<?php

namespace PerseiX\AdminBundle\Form\Type;

use PerseiX\AdminBundle\Resolver\ImagePathResolver;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class UploadFIleType
 * @package PerseiX\AdminBundle\Form\Type
 */
class UploadFileType extends FileType
{

	/**
	 * @var  string
	 */
	private $rootDir;

	/**
	 * UploadFileType constructor.
	 *
	 * @param $rootDir
	 */
	public function __construct($rootDir)
	{
		$this->rootDir = $rootDir;
	}

	/**
	 * @param FormBuilderInterface $builder
	 * @param array                $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
				$file = $event->getData();

				if (true === $file instanceof UploadedFile) {
					/** @var UploadedFile $file */
					$dir  = $this->rootDir . '/../web/' . ImagePathResolver::DIR;
					$path = md5($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();

					$file->move($dir, $path);
					$event->setData($path);
				} else {
					$event->setData($event->getForm()->getData());
				}
			})
			->addModelTransformer(new CallbackTransformer(
				function ($value) {
					return;
				},
				function ($value) {
					return $value;
				}));
	}

	/**
	 * @param OptionsResolver $resolver
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		parent::configureOptions($resolver);
	}

	/**
	 * @return null|string
	 */
	public function getBlockPrefix()
	{
		return 'persei_file';
	}

	/**
	 * @return null|string
	 */
	public function getParent()
	{
		return 'file';
	}
}
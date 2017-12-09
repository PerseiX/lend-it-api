<?php

namespace PerseiX\AdminBundle\Form\Type;

use PerseiX\AdminBundle\Resolver\ImagePathResolver;
use Speicher210\CloudinaryBundle\Cloudinary\Uploader;
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
	 * @var Uploader
	 */
	private $uploader;

	/**
	 * UploadFileType constructor.
	 *
	 * @param string   $rootDir
	 * @param Uploader $uploader
	 */
	public function __construct(string $rootDir, Uploader $uploader)
	{
		$this->rootDir  = $rootDir;
		$this->uploader = $uploader;
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
					$response = $this->uploader->upload($file);
					$publicId = $response['public_id'];

					$event->setData($publicId);
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
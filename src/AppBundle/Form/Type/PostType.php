<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class PostType extends AbstractType 
{

	public function buildForm(FormBuilderInterface $build, array $options)
	{
		$build
			->add('title', TextType::class)
            ->add('content', TextareaType::class)
            ->add('imageFile', null, ['label'=>'Image for post'])
            ->add('create', SubmitType::class);
	}

}

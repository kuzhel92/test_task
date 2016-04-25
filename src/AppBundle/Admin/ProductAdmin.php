<?php

# src/App/JoboardBundle/Admin/CategoryAdmin.php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProductAdmin extends Admin
{
    // установка сортировки по умолчанию
    protected $datagridValues = [
        '_sort_order' => 'ASC',
        '_sort_by'    => 'name'
    ];

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('category')
            ->add('price')
            ->add('description')
            ->add('manufacture')
            ->add('imagePath')
            ->add('imageFile', FileType::class)
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')           
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name')
            ->add('category')
            ->add('price')
            ->add('description')
            ->add('manufacture')
            ->add('imagePath')
        ;
    }
}
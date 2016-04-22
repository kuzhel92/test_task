<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Extension\Core\Type;

class BlogController extends Controller
{
    /**
     * @Route("/create", name="create_post")
     * @Template 
     */
    public function createAction()
    {
        $form = $this->createFormBuilder(['title'=>null, 'content'=>null])
                   ->add('title', Type\TextType::class)
                   ->add('content', Type\TextareaType::class)
                   ->add('save', Type\SubmitType::class)
                   ->getForm();
        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/show")
     * @Template 
     */
    public function showAction()
    {
        return [];
    }

    /**
     * @Route("/update")
     * @Template 
     */
    public function updateAction()
    {
        return [];
    
    }

    /**
     * @Route("/remove")
     * @Template 
     */
    public function removeAction()
    {
        return [];
        
    }

    /**
     * @Route("/blog", name="blog")
     * @Template 
     */
    public function indexAction()
    {
        return [];
    }

}

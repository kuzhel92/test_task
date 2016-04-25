<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Blog;
use AppBundle\Form\Type\PostType;

class BlogController extends Controller
{
    /**
     * @Route("/create", name="create_post")
     * @Template 
     */
    public function createAction(Request $r)
    {
        $post = new Blog;
        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($r);
         $img_file = $post->getImageFile();
            if ($img_file) {
                $original_name = $img_file->getClientOriginalName();
                $img_file->move('public/images', $original_name);
                $path = 'public/images/' . $original_name;
                $post->setImagePath($path);
            }

        if ($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('homepage');



        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/show/{post}", name="show_post")
     * @Template 
     */
    public function showAction(Blog $post)
    {
        return ['post' => $post];
    }

    /**
     * @Route("/update/{post}", name="update_post")
     * @Template 
     */
    public function updateAction(Blog $post, Request $r)
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($r);
        $img_file = $post->getImageFile();
            if ($img_file) {
                $original_name = $img_file->getClientOriginalName();
                $img_file->move('../web/public/images', $original_name);
                $path = '../web/public/images/' . $original_name;
                $post->setImagePath($path);
            }
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('blog');
        }
        return ['form' => $form->createView()];
    
    }

    /**
     * @Route("/remove/{post}", name="remove_post")
     * @Template 
     */
    public function removeAction(Blog $post)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();
        return $this->redirectToRoute('blog');
        
    }

    /**
     * @Route("/blog", name="blog")
     * @Template 
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager()->getRepository('AppBundle:Blog');
        $posts = $em->findAll();
        return ['posts' => $posts];
    }

}

<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Manufacture;
use AppBundle\Form\ManufactureType;

/**
 * Manufacture controller.
 *
 * @Route("/manufacture")
 */
class ManufactureController extends Controller
{
    /**
     * Lists all Manufacture entities.
     *
     * @Route("/", name="manufacture_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $manufactures = $em->getRepository('AppBundle:Manufacture')->findAll();

        return $this->render('manufacture/index.html.twig', array(
            'manufactures' => $manufactures,
        ));
    }

    /**
     * Creates a new Manufacture entity.
     *
     * @Route("/new", name="manufacture_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $manufacture = new Manufacture();
        $form = $this->createForm('AppBundle\Form\ManufactureType', $manufacture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($manufacture);
            $em->flush();

            return $this->redirectToRoute('manufacture_show', array('id' => $manufacture->getId()));
        }

        return $this->render('manufacture/new.html.twig', array(
            'manufacture' => $manufacture,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Manufacture entity.
     *
     * @Route("/{id}", name="manufacture_show")
     * @Method("GET")
     */
    public function showAction(Manufacture $manufacture)
    {
        $deleteForm = $this->createDeleteForm($manufacture);

        return $this->render('manufacture/show.html.twig', array(
            'manufacture' => $manufacture,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Manufacture entity.
     *
     * @Route("/{id}/edit", name="manufacture_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Manufacture $manufacture)
    {
        $deleteForm = $this->createDeleteForm($manufacture);
        $editForm = $this->createForm('AppBundle\Form\ManufactureType', $manufacture);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($manufacture);
            $em->flush();

            return $this->redirectToRoute('manufacture_edit', array('id' => $manufacture->getId()));
        }

        return $this->render('manufacture/edit.html.twig', array(
            'manufacture' => $manufacture,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Manufacture entity.
     *
     * @Route("/{id}", name="manufacture_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Manufacture $manufacture)
    {
        $form = $this->createDeleteForm($manufacture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($manufacture);
            $em->flush();
        }

        return $this->redirectToRoute('manufacture_index');
    }

    /**
     * Creates a form to delete a Manufacture entity.
     *
     * @param Manufacture $manufacture The Manufacture entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Manufacture $manufacture)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('manufacture_delete', array('id' => $manufacture->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

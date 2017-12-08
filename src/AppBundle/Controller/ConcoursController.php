<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Concours;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Concour controller.
 *
 */
class ConcoursController extends Controller
{
    /**
     * Lists all concour entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $concours = $em->getRepository('AppBundle:Concours')->findAll();

        return $this->render('concours/index.html.twig', array(
            'concours' => $concours,
        ));
    }

        /**
     * Creates a new session entity.
     *
     */
    public function newFromProgrmmeAction(Request $request)
    {
      $em = $this->getDoctrine()->getManager();
      $programmes = $em->getRepository('AppBundle:Programme')->findAll();
      foreach ( $programmes as  $programme) {
          $concour = new Concours($programme);
           $em->persist($concour);
      }
     $em->flush();
   return $this->redirectToRoute('concours_index');
    }

    /**
     * Creates a new concour entity.
     *
     */
    public function newAction(Request $request)
    {
        $concour = new Concours();
        $form = $this->createForm('AppBundle\Form\ConcoursType', $concour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($concour);
            $em->flush();

            return $this->redirectToRoute('concours_show', array('id' => $concour->getId()));
        }

        return $this->render('concours/new.html.twig', array(
            'concour' => $concour,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a concour entity.
     *
     */
    public function showAction(Concours $concour)
    {
        $deleteForm = $this->createDeleteForm($concour);

        return $this->render('concours/show.html.twig', array(
            'concour' => $concour,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing concour entity.
     *
     */
    public function editAction(Request $request, Concours $concour)
    {
        $deleteForm = $this->createDeleteForm($concour);
        $editForm = $this->createForm('AppBundle\Form\ConcoursType', $concour);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('concours_edit', array('id' => $concour->getId()));
        }

        return $this->render('concours/edit.html.twig', array(
            'concour' => $concour,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a concour entity.
     *
     */
    public function deleteAction(Request $request, Concours $concour)
    {
        $form = $this->createDeleteForm($concour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($concour);
            $em->flush();
        }

        return $this->redirectToRoute('concours_index');
    }

    /**
     * Creates a form to delete a concour entity.
     *
     * @param Concours $concour The concour entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Concours $concour)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('concours_delete', array('id' => $concour->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

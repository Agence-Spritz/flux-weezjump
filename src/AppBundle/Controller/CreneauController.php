<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Creneau;
use AppBundle\Entity\Jour;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Creneau controller.
 *
 */
class CreneauController extends Controller
{
    
    public function indexAction(Request $request, Jour $jour)
    {
        $em = $this->getDoctrine()->getManager();

        $creneaux = $em->getRepository('AppBundle:Creneau')->findBy(array ('jour' => $jour));

        return $this->render('creneau/index.html.twig', array(
            'creneaux' => $creneaux,
        ));
    }

    /**
     * Creates a new creneau entity.
     *
     */
    public function newAction(Request $request)
    {
        $creneau = new Creneau();
        $form = $this->createForm('AppBundle\Form\CreneauType', $creneau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($creneau);
            $em->flush();

            return $this->redirectToRoute('creneau_show', array('id' => $creneau->getId()));
        }

        return $this->render('creneau/new.html.twig', array(
            'creneau' => $creneau,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a creneau entity.
     *
     */
    public function showAction(Creneau $creneau)
    {
        $deleteForm = $this->createDeleteForm($creneau);

        return $this->render('creneau/show.html.twig', array(
            'creneau' => $creneau,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing creneau entity.
     *
     */
    public function editAction(Request $request, Creneau $creneau)
    {
        $deleteForm = $this->createDeleteForm($creneau);
        $editForm = $this->createForm('AppBundle\Form\CreneauType', $creneau);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('creneau_edit', array('id' => $creneau->getId()));
        }

        return $this->render('creneau/edit.html.twig', array(
            'creneau' => $creneau,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a creneau entity.
     *
     */
    public function deleteAction(Request $request, Creneau $creneau)
    {
        $form = $this->createDeleteForm($creneau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($creneau);
            $em->flush();
        }

        return $this->redirectToRoute('creneau_index');
    }

    /**
     * Creates a form to delete a creneau entity.
     *
     * @param Creneau $creneau The creneau entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Creneau $creneau)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('creneau_delete', array('id' => $creneau->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

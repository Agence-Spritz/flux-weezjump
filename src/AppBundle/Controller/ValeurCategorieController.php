<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ValeurCategorie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Valeurcategorie controller.
 *
 */
class ValeurCategorieController extends Controller
{
    /**
     * Lists all valeurCategorie entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $valeurCategories = $em->getRepository('AppBundle:ValeurCategorie')->findAll();

        return $this->render('valeurcategorie/index.html.twig', array(
            'valeurCategories' => $valeurCategories,
        ));
    }

    /**
     * Creates a new valeurCategorie entity.
     *
     */
    public function newAction(Request $request)
    {
        $valeurCategorie = new Valeurcategorie();
        $form = $this->createForm('AppBundle\Form\ValeurCategorieType', $valeurCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($valeurCategorie);
            $em->flush();

            return $this->redirectToRoute('valeurcategorie_show', array('id' => $valeurCategorie->getId()));
        }

        return $this->render('valeurcategorie/new.html.twig', array(
            'valeurCategorie' => $valeurCategorie,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a valeurCategorie entity.
     *
     */
    public function showAction(ValeurCategorie $valeurCategorie)
    {
        $deleteForm = $this->createDeleteForm($valeurCategorie);

        return $this->render('valeurcategorie/show.html.twig', array(
            'valeurCategorie' => $valeurCategorie,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing valeurCategorie entity.
     *
     */
    public function editAction(Request $request, ValeurCategorie $valeurCategorie)
    {
        $deleteForm = $this->createDeleteForm($valeurCategorie);
        $editForm = $this->createForm('AppBundle\Form\ValeurCategorieType', $valeurCategorie);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('valeurcategorie_edit', array('id' => $valeurCategorie->getId()));
        }

        return $this->render('valeurcategorie/edit.html.twig', array(
            'valeurCategorie' => $valeurCategorie,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a valeurCategorie entity.
     *
     */
    public function deleteAction(Request $request, ValeurCategorie $valeurCategorie)
    {
        $form = $this->createDeleteForm($valeurCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($valeurCategorie);
            $em->flush();
        }

        return $this->redirectToRoute('valeurcategorie_index');
    }

    /**
     * Creates a form to delete a valeurCategorie entity.
     *
     * @param ValeurCategorie $valeurCategorie The valeurCategorie entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ValeurCategorie $valeurCategorie)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('valeurcategorie_delete', array('id' => $valeurCategorie->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

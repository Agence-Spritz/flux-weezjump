<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\ValeurCategorie;
use AppBundle\Entity\Categorie;
use AppBundle\Entity\Creneau;
use AppBundle\Form\ValeurCategorieType;
/**
 * Valeurcategorie controller.
 *
 */
class ValeurCategorieController extends Controller {

    /**
     * Lists all valeurCategorie entities.
     *
     */
    public function indexAction() {
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
    public function newAction(Request $request, $id_creneau, $id_categorie) {

        $em = $this->getDoctrine()->getManager();
        $creneau = $em->getRepository('AppBundle:Creneau')->find($id_creneau);
        $categorie = $em->getRepository('AppBundle:Categorie')->find($id_categorie);
        
        if(!$creneau or !$categorie)
            return new Response('', 404);
        
        $valeurCategorie = $em->getRepository('AppBundle:ValeurCategorie')->findOneBy(array('creneau' => $creneau, 'categorie' => $categorie));
        if (!$valeurCategorie) {
            $valeurCategorie = new Valeurcategorie();
            $valeurCategorie->setCreneau($creneau);
            $valeurCategorie->setCategorie($categorie);
            $valeurCategorie->setQuantite(0);
            $em->persist($valeurCategorie);
            $em->flush();
        }

        $form = $this->createEditForm($valeurCategorie);

        return $this->render('valeurcategorie/edit.html.twig', array(
                    'valeurCategorie' => $valeurCategorie,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a valeurCategorie entity.
     *
     */
    public function showAction(ValeurCategorie $valeurCategorie) {
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
    public function editAction(Request $request, ValeurCategorie $valeurCategorie) {
        $editForm = $this->createEditForm($valeurCategorie);
        $editForm->handleRequest($request);

        $em = $this->getDoctrine()->getManager();

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $valeurCategorie->setQuantite($valeurCategorie->getQuantite() + $editForm->get('quantite')->getData());
            $em->persist($valeurCategorie);
            $em->flush();
        }
        
        return new Response('', 200);

//        return $this->render('valeurcategorie/edit.html.twig', array(
//                    'valeurCategorie' => $valeurCategorie,
//                    'edit_form' => $editForm->createView(),
//        ));
    }

    /**
     * Deletes a valeurCategorie entity.
     *
     */
    public function deleteAction(Request $request, ValeurCategorie $valeurCategorie) {
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
    private function createDeleteForm(ValeurCategorie $valeurCategorie) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('valeurcategorie_delete', array('id' => $valeurCategorie->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }
    
    
    private function createEditForm(ValeurCategorie $valeurCategorie) {
       return $this->createForm(ValeurCategorieType::class, $valeurCategorie, array(
            'action' => $this->generateUrl('valeurcategorie_edit', array('id' => $valeurCategorie->getId())),
            'method' => 'POST',
        ));
    }

}

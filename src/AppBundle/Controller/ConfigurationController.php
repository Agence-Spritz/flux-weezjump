<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Configuration;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Configuration controller.
 *
 */
class ConfigurationController extends Controller {

    /**
     * Lists all configuration entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $configurations = $em->getRepository('AppBundle:Configuration')->findAll();

        return $this->render('configuration/index.html.twig', array(
                    'configurations' => $configurations,
        ));
    }

    /**
     * Creates a new configuration entity.
     *
     */
    public function newAction(Request $request) {
        $configuration = new Configuration();
        $form = $this->createForm('AppBundle\Form\ConfigurationType', $configuration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($configuration);
            $em->flush();

            return $this->redirectToRoute('configuration_show', array('id' => $configuration->getId()));
        }

        return $this->render('configuration/new.html.twig', array(
                    'configuration' => $configuration,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a configuration entity.
     *
     */
    public function showAction(Configuration $configuration) {
        $deleteForm = $this->createDeleteForm($configuration);

        return $this->render('configuration/show.html.twig', array(
                    'configuration' => $configuration,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing configuration entity.
     *
     */
    public function editAction(Request $request, Configuration $configuration) {
        $deleteForm = $this->createDeleteForm($configuration);
        $editForm = $this->createForm('AppBundle\Form\ConfigurationType', $configuration);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('configuration_edit', array('id' => $configuration->getId()));
        }

        return $this->render('configuration/edit.html.twig', array(
                    'configuration' => $configuration,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    public function editMaximumAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $configuration = $em->getRepository('AppBundle:Configuration')->findOneBy(array('reference' => 'maximum'));

        $editForm = $this->createForm('AppBundle\Form\ConfigurationType', $configuration, array('action' => $this->generateUrl('configuration_edit_maximum')));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $prochainsJours = $em->getRepository('AppBundle:Jour')->prochainsJours();
            foreach ($prochainsJours as $jour) {
                $jour->setMaximum($configuration->getValeur());
                $em->persist($jour);
            }

            $em->flush();

            return $this->redirectToRoute('configuration_edit_maximum', array('id' => $configuration->getId()));
        }

        return $this->render('configuration/edit_maximum.html.twig', array(
                    'configuration' => $configuration,
                    'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a configuration entity.
     *
     */
    public function deleteAction(Request $request, Configuration $configuration) {
        $form = $this->createDeleteForm($configuration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($configuration);
            $em->flush();
        }

        return $this->redirectToRoute('configuration_index');
    }

    /**
     * Creates a form to delete a configuration entity.
     *
     * @param Configuration $configuration The configuration entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Configuration $configuration) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('configuration_delete', array('id' => $configuration->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}

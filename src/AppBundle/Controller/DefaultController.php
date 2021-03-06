<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use \DateTime;

class DefaultController extends Controller {

    public function indexAction(Request $request, $date = null) {
        if (!$date)
            $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d 00:00:00'));
        else
            $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $date . ' 00:00:00');

        if (!$dateTime instanceof DateTime)
            return $this->redirectToRoute('fos_user_security_login');


        $em = $this->getDoctrine()->getManager();


        $jour = $em->getRepository('AppBundle:Jour')->findOneByDay($dateTime);
        if (!$jour) {
            $JourServices = $this->get('jour.services');
            $jour = $JourServices->creerJour($dateTime);
        }

        if (!$jour)
            return $this->redirectToRoute('fos_user_security_login');

        $categories = $em->getRepository('AppBundle:Categorie')->findBy(array(), array('ord' => 'ASC'));

        return $this->render('default/index.html.twig', array(
                    'jour' => $jour,
                    'categories' => $categories,
        ));
    }

    public function statistiquesAction(Request $request, $date = null) {
        if (!$date)
            $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d 00:00:00'));
        else
            $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $date . ' 00:00:00');

        if (!$dateTime instanceof DateTime)
            return $this->redirectToRoute('fos_user_security_login');


        $em = $this->getDoctrine()->getManager();

        $jour = $em->getRepository('AppBundle:Jour')->findOneByDay($dateTime);
        if (!$jour) {
            $JourServices = $this->get('jour.services');
            $jour = $JourServices->creerJour($dateTime);
        }

        if (!$jour)
            return $this->redirectToRoute('fos_user_security_login');

        $creneaux = $em->getRepository('AppBundle:Creneau')->findByJour($jour);
        $categories = $em->getRepository('AppBundle:Categorie')->findBy(array(), array('ord' => 'ASC'));

        return $this->render('default/statistiques.html.twig', array(
                    'jour' => $jour,
                    'creneaux' => $creneaux,
                    'categories' => $categories,
        ));
    }

    public function parametresAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        return $this->render('default/parametres.html.twig', array());
    }

}

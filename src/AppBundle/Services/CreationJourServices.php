<?php

namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use AppBundle\Entity\Jour;

class CreationJourServices {

    private $em;
    private $container;
    private $token_storage;

    function __construct(EntityManager $em, Container $container, TokenStorageInterface $token_storage) {
        $this->em = $em;
        $this->container = $container;
        $this->token_storage = $token_storage;
    }

    public function creerJour(\DateTime $date = null) {

        if (!$date)
            $date = new \DateTime();

        $jour = $this->em->getRepository('AppBundle:Jour')->findOneByDay($date);

        if ($jour)
            return;

        $weezjumpResaServices = $this->container->get('weezjump.resa.services');
        $heures_ouverture_fermeture = $weezjumpResaServices->checkHeureOuvertureFermeture($date);

        $jour = new Jour();
        $jour->setDay($date);
        $jour->setDebut($heures_ouverture_fermeture['ouverture']);
        $jour->setFin($heures_ouverture_fermeture['fermeture']);
        $jour->setMaximum(15);

        $this->em->persist($jour);
        $this->em->flush();
        $this->em->refresh($jour);

        $creationCreneauServices = $this->container->get('creation.creneau.services');
        $creationCreneauServices->creerCreneauxDuJour($jour);

        $this->em->refresh($jour);
        return $jour;
    }

}

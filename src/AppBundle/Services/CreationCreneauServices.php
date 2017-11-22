<?php

namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use AppBundle\Entity\Jour;
use AppBundle\Entity\Creneau;

class CreationCreneauServices {

    private $em;
    private $container;
    private $token_storage;

    function __construct(EntityManager $em, Container $container, TokenStorageInterface $token_storage) {
        $this->em = $em;
        $this->container = $container;
        $this->token_storage = $token_storage;
    }

    public function creerCreneauxDuJour(Jour $jour) {

        $debutCreneau = $jour->getDebut();
        $finJour = $jour->getFin();

        if (!$debutCreneau or ! $finJour)
            return;

        $this->creerCreneau($debutCreneau, $jour);

        for ($i = 0; $i <= 48; $i++) {
            $debutCreneau->modify('+30minutes');
            if ($debutCreneau->format('U') > $finJour->format('U'))
                break;

            $this->creerCreneau($debutCreneau, $jour);
        }
    }

    public function creerCreneau(\DateTime $debutCreneau, Jour $jour = null) {

        if (!$jour)
            $jour = $jour = $this->em->getRepository('AppBundle:Jour')->findOneByDay($debutCreneau);
        if (!$jour)
            return;

        $creneau = $this->em->getRepository('AppBundle:Creneau')->findOneByDebut($debutCreneau);
        if ($creneau)
            return;

        $creneau = new Creneau();
        $creneau->setJour($jour);
        $creneau->setDebut($debutCreneau);
        $creneau->setDuree(1);
        $creneau->setActive(1);
        $creneau->setCouleur('red');

        $this->em->persist($creneau);
        $this->em->flush();
    }

}

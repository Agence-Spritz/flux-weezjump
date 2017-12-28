<?php

namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use AppBundle\Entity\Jour;

class JourServices {

    private $em;
    private $container;
    private $token_storage;
    private $creneauServices;

    function __construct(EntityManager $em, Container $container, TokenStorageInterface $token_storage) {
        $this->em = $em;
        $this->container = $container;
        $this->token_storage = $token_storage;
        $this->creneauServices = $this->container->get('creneau.services');
        ;
    }

    public function creerJour(\DateTime $date = null) {

        if (!$date)
            $date = new \DateTime();

        $jour = $this->em->getRepository('AppBundle:Jour')->findOneByDay($date);

        if ($jour)
            return;

        $configurationMaximum = $this->em->getRepository('AppBundle:Configuration')->findOneByReference('maximum');
        if (!$configurationMaximum)
            return;

        $weezjumpResaServices = $this->container->get('weezjump.resa.services');
        $heures_ouverture_fermeture = $weezjumpResaServices->checkHeureOuvertureFermeture($date);

        $jour = new Jour();
        $jour->setDay($date);
        $jour->setDebut($heures_ouverture_fermeture['ouverture']);
        $jour->setFin($heures_ouverture_fermeture['fermeture']);
        $jour->setMaximum($configurationMaximum->getValeur());

        $this->em->persist($jour);
        $this->em->flush();
        $this->em->refresh($jour);

        $creneauServices = $this->container->get('creneau.services');
        $creneauServices->creerCreneauxDuJour($jour);

        $this->em->refresh($jour);
        return $jour;
    }

    public function getCreneauxActifs(Jour $jour, $passes = false) {
        $creneaux_actifs = array();
        foreach ($jour->getCreneaux() as $creneau) {
            if (!$creneau->getActive())
                continue;
            if (!$creneau->getDebut() or ! $creneau->getFin())
                continue;
            if ($creneau->getDebut()->format('U') <= date('U') and $creneau->getFin()->format('U') >= date('U'))
                $creneaux_actifs[] = $creneau;
            if ($passes) {
                if ($creneau->getDebut()->format('U') < date('U') and $creneau->getFin()->format('U') < date('U'))
                    $creneaux_actifs[] = $creneau;
            }
        }
        return $creneaux_actifs;
    }

    public function countVisiteursActifs(Jour $jour) {
        $count = 0;
        foreach ($this->getCreneauxActifs($jour) as $creneau) {
            $count = $count + $creneau->getQuantite();
            $count = $count + $this->creneauServices->checkQuantiteReserveeCreneau($creneau);
        }
        return $count;
    }

    public function totalDuJour(Jour $jour) {
        $count = 0;
        foreach ($this->getCreneauxActifs($jour, true) as $creneau) {
            $count = $count + $creneau->getQuantite();
            $count = $count + $this->creneauServices->checkQuantiteReserveeCreneau($creneau);
        }
        return $count;
    }

}

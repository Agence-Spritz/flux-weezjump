<?php

namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use AppBundle\Entity\Jour;
use AppBundle\Entity\Creneau;
use \DateTime;

class CreneauServices {

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
            if ($debutCreneau->format('U') >= $finJour->format('U'))
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

        $finCreneau = DateTime::createFromFormat('Y-m-d H:i:s', $debutCreneau->format('Y-m-d H:i:s'));
        $finCreneau->modify('+1hour');

        $creneau = new Creneau();
        $creneau->setJour($jour);
        $creneau->setDebut($debutCreneau);
        $creneau->setFin($finCreneau);
        $creneau->setDuree(1);
        $creneau->setActive(1);
        $creneau->setCouleur($this->trouverCouleur($creneau));

        $this->em->persist($creneau);
        $this->em->flush();
    }

    private function trouverCouleur(Creneau $creneau) {

        $array_couleur = $this->container->getParameter('couleurs');

        $debutCreneau = DateTime::createFromFormat('U', $creneau->getDebut()->format('U'));
        $debutCreneau->modify('-30minutes');
        $creneau_precedent = $this->em->getRepository('AppBundle:Creneau')->findOneByDebut($debutCreneau);
        if ($creneau_precedent and $couleur_a_supprimer = $creneau_precedent->getCouleur())
            $array_couleur = array_filter($array_couleur, function ($value) use ($couleur_a_supprimer) {
                return $value != $couleur_a_supprimer;
            }, ARRAY_FILTER_USE_BOTH);

        $debutCreneau->modify('+60minutes');
        $creneau_suivant = $this->em->getRepository('AppBundle:Creneau')->findOneByDebut($debutCreneau);
        if ($creneau_suivant and $couleur_a_supprimer = $creneau_suivant->getCouleur())
            $array_couleur = array_filter($array_couleur, function ($value) use ($couleur_a_supprimer) {
                return $value != $couleur_a_supprimer;
            }, ARRAY_FILTER_USE_BOTH);

        shuffle($array_couleur);
        if (count($array_couleur))
            return $array_couleur[0];
    }

    public function countPlacesRestantes(Creneau $creneau) {
        $maximum = $creneau->getJour()->getMaximum();
        $count = $maximum - $creneau->getQuantite();
        
        if($creneau->fini())
            return '-';

        $jourServices = $this->container->get('jour.services');
        $creneaux_actifs = $jourServices->getCreneauxActifs($creneau->getJour());

        if (in_array($creneau, $creneaux_actifs))
            foreach ($creneaux_actifs as $creneau_actif) {
                if ($creneau_actif == $creneau)
                    continue;
                $count = $count - $creneau_actif->getQuantite();
            }
        return $count;
    }

}

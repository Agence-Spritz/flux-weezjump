<?php

namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use AppBundle\Entity\Jour;
use AppBundle\Entity\Creneau;
use \DateTime;
use \DateTimeZone;

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

        if ($finCreneau->format('U') > $jour->getFin()->format('U'))
            return;

        $creneau = new Creneau();
        $creneau->setJour($jour);
        $creneau->setDebut($debutCreneau);
        $creneau->setFin($finCreneau);
        $creneau->setDuree(1);
        $creneau->setActive(1);
        $couleur = $this->trouverCouleur($creneau);
        $creneau->setCouleur($couleur);

        $this->em->persist($creneau);
        $this->em->flush();
    }

    private function trouverCouleur(Creneau $creneau) {

        $array_couleur = $this->container->getParameter('couleurs');

        $timezone = new DateTimeZone('Europe/London');
        $debutCreneau = DateTime::createFromFormat('Y-m-d H:i:s', $creneau->getDebut()->format('Y-m-d H:i:s'));
        $debutCreneau->modify('-30minutes');
        $creneau_precedent = $this->em->getRepository('AppBundle:Creneau')->findOneByDebut($debutCreneau);


        if ($creneau_precedent and $couleur_creneau_precedent = $creneau_precedent->getCouleur()) {
            $array = array_keys($array_couleur, $couleur_creneau_precedent);
            foreach ($array as $key => $value) {
                $key_couleur = $value;
                break;
            }
            if (isset($key_couleur) and $key_couleur >= 0 and $key_couleur < 7 and isset($array_couleur[$key_couleur + 1])) {
                return $array_couleur[$key_couleur + 1];
            } else
                return $array_couleur[0];
        }

        shuffle($array_couleur);
        if (count($array_couleur))
            return $array_couleur[0];
    }

    public function checkQuantiteReserveeCreneau(Creneau $creneau) {
        $weezjumpResaServices = $this->container->get('weezjump.resa.services');
        return $weezjumpResaServices->checkQuantiteReserveeCreneau($creneau);
    }

    public function countPlacesRestantesPremiereMoitie(Creneau $creneau) {
        $creneauPrecedent = $creneau->creneauPrecedent();
        $quantite_reservee = $this->checkQuantiteReserveeCreneau($creneau);
        if ($creneauPrecedent and $creneauPrecedent->getActive()) {
            $quantite_reservee_creneau_precedent = $this->checkQuantiteReserveeCreneau($creneauPrecedent);
            return round(($creneau->getJour()->getMaximum() - $creneauPrecedent->getQuantite() - $creneau->getQuantite() - $quantite_reservee - $quantite_reservee_creneau_precedent), 0);
        }
        return round(($creneau->getJour()->getMaximum() - $creneau->getQuantite() - $quantite_reservee), 0);
    }

    public function countPlacesRestantesDeuxiemeMoitie(Creneau $creneau) {
        $creneauSuivant = $creneau->creneauSuivant();
        $quantite_reservee = $this->checkQuantiteReserveeCreneau($creneau);
        if ($creneauSuivant and $creneauSuivant->getActive()) {
            $quantite_reservee_creneau_suivant = $this->checkQuantiteReserveeCreneau($creneauSuivant);
            return round(($creneau->getJour()->getMaximum() - $creneauSuivant->getQuantite() - $creneau->getQuantite() - $quantite_reservee - $quantite_reservee_creneau_suivant), 0);
        }
        return round(($creneau->getJour()->getMaximum() - $creneau->getQuantite() - $quantite_reservee), 0);
    }

}

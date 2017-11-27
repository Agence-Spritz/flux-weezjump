<?php

namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use DateTime;
use AppBundle\Entity\Creneau;

class WeezjumpResaServices {

    private $em;
    private $container;
    private $token_storage;
    private $database_host;
    private $database_user;
    private $database_password;
    private $database_name;
    private $connection;
    private $noms_jours = array(
        1 => 'Lundi',
        2 => 'Mardi',
        3 => 'Mercredi',
        4 => 'Jeudi',
        5 => 'Vendredi',
        6 => 'Samedi',
        7 => 'Dimanche',
    );

    function __construct(EntityManager $em, Container $container, TokenStorageInterface $token_storage) {
        $this->em = $em;
        $this->container = $container;
        $this->token_storage = $token_storage;

        $this->database_host = $this->container->getParameter('database_resa_host');
        $this->database_user = $this->container->getParameter('database_resa_user');
        $this->database_password = $this->container->getParameter('database_resa_password');
        $this->database_name = $this->container->getParameter('database_resa_name');

        $this->connectToBDDWeezjumpResa();
    }

    public function connectToBDDWeezjumpResa() {

        $this->connection = mysql_connect($this->database_host, $this->database_user, $this->database_password);

        if (!$this->connection) {
            echo "Unable to connect to DB: " . mysql_error();
            exit;
        }

        if (!mysql_select_db($this->database_name)) {
            echo "Unable to select mydbname: " . mysql_error();
            exit;
        }
    }

    public function checkHeureOuvertureFermeture(\DateTime $date = null) {

        $ouverture_normale = true;

        if (!$date)
            $date = new \DateTime();

        $nom_jour = $this->noms_jours[date('N', $date->format('U'))];

        $sql = "SELECT * FROM ouvertureExp WHERE dateDebut <= '" . $date->format('Y-m-d') . "' AND dateFin >= '" . $date->format('Y-m-d') . "' ";
        $result = mysql_query($sql, $this->connection);
        if (mysql_num_rows($result) != 0)
            $ouverture_normale = false;

        if ($ouverture_normale)
            $sql = "SELECT ouvNorm as ouverture, fermNorm as fermeture FROM semaine WHERE jour = '" . $nom_jour . "' LIMIT 1 ";
        else
            $sql = "SELECT ouvEx as ouverture, fermEx as fermeture FROM semaine WHERE jour = '" . $nom_jour . "' LIMIT 1 ";

        $result = mysql_query($sql, $this->connection);
        while ($row = mysql_fetch_assoc($result)) {
            $heure_ouverture = $row["ouverture"];
            $heure_fermeture = $row["fermeture"];
        }
        mysql_free_result($result);

        $ouverture = DateTime::createFromFormat('Y-m-d H:i:s', $date->format('Y-m-d') . ' 00:00:00');
        $fermeture = DateTime::createFromFormat('Y-m-d H:i:s', $date->format('Y-m-d') . ' 00:00:00');

        if ($heure_ouverture >= 0 and $heure_ouverture <= 23)
            $ouverture->modify('+' . $heure_ouverture . 'hours');
        if ($heure_fermeture >= 0 and $heure_fermeture <= 24)
            $fermeture->modify('+' . $heure_fermeture . 'hours');

        return array('ouverture' => $ouverture, 'fermeture' => $fermeture);
    }

    public function checkQuantiteReserveeCreneau(Creneau $creneau) {

        $count = 0;

        $dateTimeDebut = $creneau->getDebut();
        if (!$dateTimeDebut)
            return;

        $sql = "SELECT SUM(nbClient) AS nbClient 
                FROM reservationClient 
                WHERE dateResa = '" . $dateTimeDebut->format('Y-m-d') . "' AND heureResa = '" . $dateTimeDebut->format('H:i:s') . "';";

        $result = mysql_query($sql, $this->connection);
        while ($row = mysql_fetch_assoc($result)) {
            $count = $row["nbClient"];
        }
        mysql_free_result($result);

        return $count ? $count : 0;
    }

}

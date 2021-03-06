<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use \DateTime;

/**
 * Creneau
 *
 * @ORM\Table(name="creneau")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CreneauRepository")
 */
class Creneau {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="debut", type="datetime")
     */
    private $debut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin", type="datetime")
     */
    private $fin;

    /**
     * @var int
     *
     * @ORM\Column(name="duree", type="integer", nullable=true)
     */
    private $duree;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    private $active;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=255, nullable=true)
     */
    private $couleur;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Jour", inversedBy="creneaux")
     * @ORM\JoinColumn(name="jour_id", referencedColumnName="id")
     *
     * */
    protected $jour;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ValeurCategorie", mappedBy="creneau")
     * @ORM\OrderBy({"id" = "DESC"})
     * */
    private $valeurCategories;

    public function __construct() {
        $this->valeurCategories = new ArrayCollection();
    }

    public function __toString() {
        return (string) $this->id;
    }

    public function fini() {
        if ($this->getFin()->format('U') < date('U'))
            return true;
        return false;
    }

    public function getQuantite($symbole = null, $payante = null) {
        $quantite = 0;
        if ($symbole)
            return $this->getQuantiteParSymbole($symbole, $payante);
        else
            foreach ($this->getValeurCategories() as $valeurCategorie) {
                $quantite = $quantite + $valeurCategorie->getQuantite($payante);
            }
        return $quantite;
    }

    public function getQuantiteParSymbole($symbole = null, $payante = null) {
        if (!$symbole)
            return null;
        if ($this->getValeurCategorie($symbole))
            return $this->getValeurCategorie($symbole)->getQuantite($payante);
        return null;
    }

    public function getValeurCategorie($symbole = null) {
        if (!$symbole)
            return null;
        if ($this->getValeurCategories())
            foreach ($this->getValeurCategories() as $valeurCategorie) {
                if ($valeurCategorie->getCategorie() && $valeurCategorie->getCategorie()->getSymbole() == $symbole)
                    return $valeurCategorie;
            }
        return null;
    }

    public function creneauPrecedent() {
        if (!$this->getDebut())
            return null;
        $debutCreneau = DateTime::createFromFormat('Y-m-d H:i:s', $this->getDebut()->format('Y-m-d H:i:s'));
        $debutCreneau->modify('-30minutes');
        foreach ($this->getJour()->getCreneaux() as $creneau) {
            if ($creneau->getDebut() and $creneau->getDebut()->format('Y-m-d H:i:s') == $debutCreneau->format('Y-m-d H:i:s'))
                return $creneau;
        }
    }

    public function creneauSuivant() {
        if (!$this->getDebut())
            return null;
        $debutCreneau = DateTime::createFromFormat('Y-m-d H:i:s', $this->getDebut()->format('Y-m-d H:i:s'));
        $debutCreneau->modify('+30minutes');
        foreach ($this->getJour()->getCreneaux() as $creneau) {
            if ($creneau->getDebut() and $creneau->getDebut()->format('Y-m-d H:i:s') == $debutCreneau->format('Y-m-d H:i:s'))
                return $creneau;
        }
    }
    
    public function enCours(){
        if (!$this->getDebut())
            return false;
        if (!$this->getFin())
            return false;
        if($this->getFin()->format('U') < date('U'))
            return false;
        if($this->getDebut()->format('U') > date('U'))
            return false;
        return true;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set debut
     *
     * @param \DateTime $debut
     *
     * @return Creneau
     */
    public function setDebut($debut) {
        $this->debut = $debut;

        return $this;
    }

    /**
     * Get debut
     *
     * @return \DateTime
     */
    public function getDebut() {
        return $this->debut;
    }

    /**
     * Set duree
     *
     * @param integer $duree
     *
     * @return Creneau
     */
    public function setDuree($duree) {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return int
     */
    public function getDuree() {
        return $this->duree;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Creneau
     */
    public function setActive($active) {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return bool
     */
    public function getActive() {
        return $this->active;
    }

    /**
     * Set couleur
     *
     * @param string $couleur
     *
     * @return Creneau
     */
    public function setCouleur($couleur) {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return string
     */
    public function getCouleur() {
        return $this->couleur;
    }

    /**
     * Set jour
     *
     * @param \AppBundle\Entity\Jour $jour
     *
     * @return Creneau
     */
    public function setJour(\AppBundle\Entity\Jour $jour = null) {
        $this->jour = $jour;

        return $this;
    }

    /**
     * Get jour
     *
     * @return \AppBundle\Entity\Jour
     */
    public function getJour() {
        return $this->jour;
    }

    /**
     * Add valeurCategory
     *
     * @param \AppBundle\Entity\ValeurCategorie $valeurCategory
     *
     * @return Creneau
     */
    public function addValeurCategory(\AppBundle\Entity\ValeurCategorie $valeurCategory) {
        $this->valeurCategories[] = $valeurCategory;

        return $this;
    }

    /**
     * Remove valeurCategory
     *
     * @param \AppBundle\Entity\ValeurCategorie $valeurCategory
     */
    public function removeValeurCategory(\AppBundle\Entity\ValeurCategorie $valeurCategory) {
        $this->valeurCategories->removeElement($valeurCategory);
    }

    /**
     * Get valeurCategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getValeurCategories() {
        return $this->valeurCategories;
    }

    /**
     * Set fin
     *
     * @param \DateTime $fin
     *
     * @return Creneau
     */
    public function setFin($fin) {
        $this->fin = $fin;

        return $this;
    }

    /**
     * Get fin
     *
     * @return \DateTime
     */
    public function getFin() {
        return $this->fin;
    }

}

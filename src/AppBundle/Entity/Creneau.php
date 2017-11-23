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

    public function getQuantite($symbole = null) {
        if (!$symbole)
            return null;
        if ($this->getValeurCategorie())
            return $this->getValeurCategorie()->getQuantite();
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

    public function getFin() {
        if (!$this->debut or ! $this->duree)
            return null;
        $fin = DateTime::createFromFormat('U', $this->debut->format('U'));
        $fin->modify('+' . $this->duree . 'hour');
        return $fin;
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

}

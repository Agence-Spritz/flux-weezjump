<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Jour
 *
 * @ORM\Table(name="jour")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\JourRepository")
 */
class Jour
{
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
     * @ORM\Column(name="day", type="date")
     */
    private $day;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="debut", type="datetime", nullable=true)
     */
    private $debut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin", type="datetime", nullable=true)
     */
    private $fin;

    /**
     * @var int
     *
     * @ORM\Column(name="maximum", type="integer", nullable=true)
     */
    private $maximum;
    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Creneau", mappedBy="jour")
     * @ORM\OrderBy({"id" = "ASC"})
     * */
    private $creneaux;

    public function __construct() {
        $this->creneaux = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set day
     *
     * @param \DateTime $day
     *
     * @return Jour
     */
    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get day
     *
     * @return \DateTime
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set debut
     *
     * @param \DateTime $debut
     *
     * @return Jour
     */
    public function setDebut($debut)
    {
        $this->debut = $debut;

        return $this;
    }

    /**
     * Get debut
     *
     * @return \DateTime
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * Set fin
     *
     * @param \DateTime $fin
     *
     * @return Jour
     */
    public function setFin($fin)
    {
        $this->fin = $fin;

        return $this;
    }

    /**
     * Get fin
     *
     * @return \DateTime
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * Set maximum
     *
     * @param integer $maximum
     *
     * @return Jour
     */
    public function setMaximum($maximum)
    {
        $this->maximum = $maximum;

        return $this;
    }

    /**
     * Get maximum
     *
     * @return int
     */
    public function getMaximum()
    {
        return $this->maximum;
    }

    /**
     * Add creneaux
     *
     * @param \AppBundle\Entity\Creneau $creneaux
     *
     * @return Jour
     */
    public function addCreneaux(\AppBundle\Entity\Creneau $creneaux)
    {
        $this->creneaux[] = $creneaux;

        return $this;
    }

    /**
     * Remove creneaux
     *
     * @param \AppBundle\Entity\Creneau $creneaux
     */
    public function removeCreneaux(\AppBundle\Entity\Creneau $creneaux)
    {
        $this->creneaux->removeElement($creneaux);
    }

    /**
     * Get creneaux
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCreneaux()
    {
        return $this->creneaux;
    }
}

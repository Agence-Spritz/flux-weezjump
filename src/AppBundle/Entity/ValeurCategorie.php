<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ValeurCategorie
 *
 * @ORM\Table(name="valeur_categorie")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ValeurCategorieRepository")
 */
class ValeurCategorie
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
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer", nullable=true)
     */
    private $quantite;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Creneau", inversedBy="valeurCategories")
     * @ORM\JoinColumn(name="creneau_id", referencedColumnName="id")
     * 
     * */
    protected $creneau;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Categorie", inversedBy="valeurCategories")
     * @ORM\JoinColumn(name="categorie_id", referencedColumnName="id")
     * 
     * */
    protected $categorie;


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
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return ValeurCategorie
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set creneau
     *
     * @param \AppBundle\Entity\Creneau $creneau
     *
     * @return ValeurCategorie
     */
    public function setCreneau(\AppBundle\Entity\Creneau $creneau = null)
    {
        $this->creneau = $creneau;

        return $this;
    }

    /**
     * Get creneau
     *
     * @return \AppBundle\Entity\Creneau
     */
    public function getCreneau()
    {
        return $this->creneau;
    }

    /**
     * Set categorie
     *
     * @param \AppBundle\Entity\Categorie $categorie
     *
     * @return ValeurCategorie
     */
    public function setCategorie(\AppBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \AppBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
}

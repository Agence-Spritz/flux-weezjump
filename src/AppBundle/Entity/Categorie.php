<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategorieRepository")
 */
class Categorie
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="symbole", type="string", length=255)
     */
    private $symbole;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="duree", type="integer", nullable=true)
     */
    private $duree;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer", nullable=true)
     */
    private $quantite;

    /**
     * @var boolean
     *
     * @ORM\Column(name="hidden", type="boolean", nullable=true)
     */
    private $hidden;
    
    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ValeurCategorie", mappedBy="categorie")
     * @ORM\OrderBy({"id" = "DESC"})
     * */
    private $valeurCategories;

    public function __construct() {
        $this->valeurCategories = new ArrayCollection();
    }

    public function __toString() {
        return $this->name;
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
     * Set name
     *
     * @param string $name
     *
     * @return Categorie
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set symbole
     *
     * @param string $symbole
     *
     * @return Categorie
     */
    public function setSymbole($symbole)
    {
        $this->symbole = $symbole;

        return $this;
    }

    /**
     * Get symbole
     *
     * @return string
     */
    public function getSymbole()
    {
        return $this->symbole;
    }

    /**
     * Add valeurCategory
     *
     * @param \AppBundle\Entity\ValeurCategorie $valeurCategory
     *
     * @return Categorie
     */
    public function addValeurCategory(\AppBundle\Entity\ValeurCategorie $valeurCategory)
    {
        $this->valeurCategories[] = $valeurCategory;

        return $this;
    }

    /**
     * Remove valeurCategory
     *
     * @param \AppBundle\Entity\ValeurCategorie $valeurCategory
     */
    public function removeValeurCategory(\AppBundle\Entity\ValeurCategorie $valeurCategory)
    {
        $this->valeurCategories->removeElement($valeurCategory);
    }

    /**
     * Get valeurCategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getValeurCategories()
    {
        return $this->valeurCategories;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Categorie
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set duree
     *
     * @param integer $duree
     *
     * @return Categorie
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return integer
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return Categorie
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return integer
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set hidden
     *
     * @param boolean $hidden
     *
     * @return Categorie
     */
    public function setHidden($hidden)
    {
        $this->hidden = $hidden;

        return $this;
    }

    /**
     * Get hidden
     *
     * @return boolean
     */
    public function getHidden()
    {
        return $this->hidden;
    }
}

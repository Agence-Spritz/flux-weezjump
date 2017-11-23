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
}

<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Competition as Competition;

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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Licence", mappedBy="categorie")
     */
    private $licences;

    /**
     * @ORM\ManyToMany(targetEntity="Competition", mappedBy="categories")
     * @ORM\JoinColumn(nullable=true)
     */
    private $competitions;

    public function __toString()
    {
        return $this->nom;
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Categorie
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->licences = new \Doctrine\Common\Collections\ArrayCollection();
        $this->competitions = new \Doctrine\Common\Collections\ArrayCollection();

    }

    /**
     * Add licence
     *
     * @param \AppBundle\Entity\Licence $licence
     *
     * @return Categorie
     */
    public function addLicence(\AppBundle\Entity\Licence $licence)
    {
        $this->licences[] = $licence;

        return $this;
    }

    /**
     * Remove licence
     *
     * @param \AppBundle\Entity\Licence $licence
     */
    public function removeLicence(\AppBundle\Entity\Licence $licence)
    {
        $this->licences->removeElement($licence);
    }

    /**
     * Get licences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLicences()
    {
        return $this->licences;
    }

    /**
     * Add competition
     *
     * @param \AppBundle\Competition $competition
     *
     * @return Categorie
     */
    public function addCompetition(\AppBundle\Competition $competition)
    {
        $this->competitions[] = $competition;

        return $this;
    }

    /**
     * Remove competition
     *
     * @param \AppBundle\Competition $competition
     */
    public function removeCompetition(\AppBundle\Competition $competition)
    {
        $this->competitions->removeElement($competition);
    }

    /**
     * Get competitions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCompetitions()
    {
        return $this->competitions;
    }

}

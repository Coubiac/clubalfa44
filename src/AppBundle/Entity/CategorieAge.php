<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Competition as Competition;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use AppBundle\Validator\Constraints as AlfaAssert;

/**
 * CategorieAge
 *
 * @ORM\Table(name="categorie_age")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategorieAgeRepository")
 * @UniqueEntity("nom", message="Une catégorie d'age existe déja avec ce nom.")
 * @AlfaAssert\IsNotOverlapInterval()
 */
class CategorieAge
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
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     */
    private $nom;

    /**
     * @var int
     *
     * @ORM\Column(name="age_min", type="integer")
     */
    private $ageMin;

    /**
     * @var int
     *
     * @ORM\Column(name="age_max", type="integer")
     */
    private $ageMax;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $prixBase;



    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Licence", mappedBy="categorieAge", cascade={"persist", "merge"})
     */
    private $licences;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Inscrit", mappedBy="categorieAge", cascade={"persist"})
     */
    private $inscrits;



    /**
     * @ORM\ManyToMany(targetEntity="Competition", mappedBy="categorieAges")
     * @ORM\JoinColumn(nullable=true)
     */
    private $competitions;

    public function __toString()
    {
        return (string)$this->nom;
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
     * @return CategorieAge
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
        $this->inscrits = new \Doctrine\Common\Collections\ArrayCollection();

    }

    /**
     * Add licence
     *
     * @param \AppBundle\Entity\Licence $licence
     *
     * @return CategorieAge
     */
    public function addLicence(\AppBundle\Entity\Licence $licence)
    {
        $this->licences[] = $licence;
        $licence->setCategorieAge($this);

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
     * @param \AppBundle\Entity\Competition $competition
     *
     * @return CategorieAge
     */
    public function addCompetition(Competition $competition)
    {
        $this->competitions[] = $competition;
        $competition->addCategorieAges($this);

        return $this;
    }

    /**
     * Remove competition
     *
     * @param \AppBundle\Entity\Competition $competition
     */
    public function removeCompetition(Competition $competition)
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


    /**
     * Set ageMin
     *
     * @param integer $ageMin
     *
     * @return CategorieAge
     */
    public function setAgeMin($ageMin)
    {
        $this->ageMin = $ageMin;

        return $this;
    }

    /**
     * Get ageMin
     *
     * @return integer
     */
    public function getAgeMin()
    {
        return $this->ageMin;
    }

    /**
     * Set ageMax
     *
     * @param integer $ageMax
     *
     * @return CategorieAge
     */
    public function setAgeMax($ageMax)
    {
        $this->ageMax = $ageMax;

        return $this;
    }

    /**
     * Get ageMax
     *
     * @return integer
     */
    public function getAgeMax()
    {
        return $this->ageMax;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return CategorieAge
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
     * Set prixBase
     *
     * @param integer $prixBase
     *
     * @return CategorieAge
     */
    public function setPrixBase($prixBase)
    {
        $this->prixBase = $prixBase;

        return $this;
    }

    /**
     * Get prixBase
     *
     * @return integer
     */
    public function getPrixBase()
    {
        return $this->prixBase;
    }

    /**
     * @return mixed
     */
    public function getInscrits()
    {
        return $this->inscrits;
    }

    /**
     * @param mixed $inscrits
     * @return CategorieAge
     */
    public function setInscrits($inscrits)
    {
        $this->inscrits = $inscrits;
        return $this;
    }

    /**
     * Add Inscrit
     *
     * @param \AppBundle\Entity\Inscrit $Inscrit
     *
     * @return CategorieAge
     */
    public function addInscrit(Inscrit $Inscrit)
    {
        $this->inscrits[] = $Inscrit;
        $Inscrit->setCategorieAge($this);

        return $this;
    }

    /**
     * Remove Inscrit
     *
     * @param \AppBundle\Entity\Inscrit $Inscrit
     */
    public function removeInscrit(Inscrit $Inscrit)
    {
        $this->inscrits->removeElement($Inscrit);
    }


}

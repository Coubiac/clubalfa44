<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Competition
 *
 * @ORM\Table(name="inscrits")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CompetitionRepository")
 */
class Inscrit
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
     * @ORM\Column(name="date_inscription", type="datetime")
     */
    private $dateInscription;

    /**
     *
     * @var string
     * @ORM\Column(name="nom", type="string")
     * @Assert\NotBlank(message = "Veuillez indiquer votre nom")
     */
    private $nom;

    /**
     *
     * @var string
     * @ORM\Column(name="prenom", type="string")
     * @Assert\NotBlank(message = "Veuillez indiquer votre prénom")
     */
    private $prenom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_naissance", type="datetime")
     * @Assert\NotBlank(message = "Veuillez indiquer votre date de naissance")
     */
    private $dateNaissance;


    /**
     * Many Inscrit have One competition.
     * @ManyToOne(targetEntity="Competition", inversedBy="inscrits")
     * @JoinColumn(name="competition_id", referencedColumnName="id")
     */
    private $competition;

    /**
     * @ORM\ManyToOne(targetEntity="CategorieAge", inversedBy="inscrits", cascade={"persist"})
     * @ORM\JoinColumn(name="categorieage_id", referencedColumnName="id")
     */
    private $categorieAge;

    public function __toString()
    {
        return $this->prenom . ' ' . $this->nom . ' ' . $this->dateNaissance->format('d/m/Y');
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return DateTime
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    /**
     * @param DateTime $dateInscription
     * @return Inscrit
     */
    public function setDateInscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;
        return $this;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return Inscrit
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     * @return Inscrit
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * @param DateTime $dateNaissance
     * @return Inscrit
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCompetition()
    {
        return $this->competition;
    }

    /**
     * @param mixed $competition
     * @return Inscrit
     */
    public function setCompetition($competition)
    {
        $this->competition = $competition;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategorieAge()
    {
        return $this->categorieAge;
    }

    /**
     * @param mixed $categorieAge
     * @return Inscrit
     */
    public function setCategorieAge($categorieAge)
    {
        $this->categorieAge = $categorieAge;
        return $this;
    }



}

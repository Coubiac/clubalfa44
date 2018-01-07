<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AlfaAssert;



/**
 * Licence
 *
 * @ORM\Table(name="licence")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LicenceRepository")
 * @AlfaAssert\CheckAgeMini()
 */
class Licence
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
     * @ORM\Column(name="numero", type="string", length=255, unique=true)
     */
    private $numero;

    /**
     * @var bool
     *
     * @ORM\Column(name="isActive", type="boolean", options={"default":0})
     */
    private $isActive;

    /**
     * @var bool
     *
     * @ORM\Column(name="has_add_grappling", type="boolean", options={"default":0})
     */
    private $hasAddGrappling;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_grappling_option", type="boolean", options={"default":0})
     */
    private $isGrapplingOption;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateInscription", type="datetime")
     */
    private $dateInscription;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="licences")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=25, unique=false)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=25, unique=false)
     */
    private $prenom;

    /**
     * @ORM\Column(type="integer", length=5)
     */
    private $codePostal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="datetime", length=255)
     */
    private $birthdate;

    /**
     * @ORM\ManyToOne(targetEntity="Saison", inversedBy="licences", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $saison;

    /**
     * @ORM\ManyToOne(targetEntity="Activite", inversedBy="licences", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $activite;

    /**
     * @ORM\ManyToOne(targetEntity="CategorieAge", inversedBy="licences", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorieAge;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Commande", inversedBy="licences", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    private $commande;


    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * Licence constructor.
     */
    public function __construct()
    {
        $this->setNumero(strtoupper(uniqid("LIC")));
        $this->setDateInscription(new DateTime());
        $this->setActive(false);
        $this->setGrapplingOption(false);
    }

    public function __toString()
    {
        return (string)$this->numero;
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
     * Set numero
     *
     * @param integer $numero
     *
     * @return Licence
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return int
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Licence
     */
    public function setActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isGrapplingOption
     *
     * @return bool
     */
    public function isGrapplingOption()
    {
        return $this->isGrapplingOption;
    }

    /**
     * Set isGrapplingOption
     *
     * @param boolean $grapplingOption
     *
     * @return Licence
     */
    public function setGrapplingOption($grapplingOption)
    {
        $this->isGrapplingOption = $grapplingOption;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->isActive;
    }

    /**
     * Set hasAddGrappling
     *
     * @param boolean $hasAddGrappling
     *
     * @return Licence
     */
    public function setHasAddGrappling($hasAddGrappling)
    {
        $this->hasAddGrappling = $hasAddGrappling;

        return $this;
    }

    /**
     * Get hasAddGrappling
     *
     * @return bool
     */
    public function hasAddGrappling()
    {
        return $this->hasAddGrappling;
    }


    /**
     * Set dateInscription
     *
     * @param \DateTime $dateInscription
     *
     * @return Licence
     */
    public function setDateInscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    /**
     * Get dateInscription
     *
     * @return \DateTime
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Licence
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set saison
     *
     * @param \AppBundle\Entity\Saison $saison
     *
     * @return Licence
     */
    public function setSaison(Saison $saison)
    {
        $this->saison = $saison;

        return $this;
    }

    /**
     * Get saison
     *
     * @return \AppBundle\Entity\Saison
     */
    public function getSaison()
    {
        return $this->saison;
    }

    /**
     * Set activite
     *
     * @param \AppBundle\Entity\Activite $activite
     *
     * @return Licence
     */
    public function setActivite(Activite $activite)
    {
        $this->activite = $activite;

        return $this;
    }

    /**
     * Get activite
     *
     * @return \AppBundle\Entity\Activite
     */
    public function getActivite()
    {
        return $this->activite;
    }

    /**
     * Set categorieAge
     *
     * @param \AppBundle\Entity\CategorieAge $categorieAge
     *
     * @return Licence
     */
    public function setCategorieAge(CategorieAge $categorieAge)
    {
        $this->categorieAge = $categorieAge;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \AppBundle\Entity\CategorieAge
     */
    public function getCategorieAge()
    {
        return $this->categorieAge;
    }


    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Licence
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Licence
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set codePostal
     *
     * @param integer $codePostal
     *
     * @return Licence
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return integer
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Licence
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Licence
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     *
     * @return Licence
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }


    /**
     * Set commande
     *
     * @param \AppBundle\Entity\Commande $commande
     *
     * @return Licence
     */
    public function setCommande(\AppBundle\Entity\Commande $commande)
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * Get commande
     *
     * @return \AppBundle\Entity\Commande
     */
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * Set prix
     *
     * @param integer $prix
     *
     * @return Licence
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return int
     */
    public function getPrix()
    {
        return $this->prix;
    }

}

<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ContenuStatic
 *
 * @ORM\Table(name="contenu_static")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContenuStaticRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ContenuStatic
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
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\ContenuStaticEmplacement", inversedBy="contenuStatic", cascade={"persist"})
     */
    private $emplacement;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=70)
     * @Assert\NotBlank(message = "Veuillez indiquer un titre")
     * @Assert\Length(max=70, maxMessage="Votre titre ne peut dépasser {{ limit }} caractères.")
     * @Assert\Length(min=5, minMessage="Votre titre doit comporter au moins {{ limit }} caractères.")
     */
    private $titre;

    /**
     * @var string
     * @ORM\Column(name="description", type="string", length=150)
     * @Assert\NotBlank(message = "Veuillez indiquer une description")
     * @Assert\Length(max=150, maxMessage="Votre description ne peut dépasser {{ limit }} caractères.")
     * @Assert\Length(min=10, minMessage="Votre description doit comporter au moins {{ limit }} caractères.")
     */
    private $description;


    /**
     * @Gedmo\Slug(fields={"titre"})
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     * @Assert\NotBlank(message = "Cette page ne peut pas être vide")
     *
     */
    private $contenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastmod", type="datetime", nullable=true)
     */
    private $lastmod;


    public function __toString()
    {
        return (string)$this->titre;
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return ContenuStatic
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ContenuStatic
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
     * Set slug
     *
     * @param string $slug
     *
     * @return ContenuStatic
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return ContenuStatic
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set emplacement
     *
     * @param \AppBundle\Entity\ContenuStaticEmplacement $emplacement
     *
     * @return ContenuStatic
     */
    public function setEmplacement(\AppBundle\Entity\ContenuStaticEmplacement $emplacement = null)
    {
        $this->emplacement = $emplacement;

        return $this;
    }

    /**
     * Get emplacement
     *
     * @return \AppBundle\Entity\ContenuStaticEmplacement
     */
    public function getEmplacement()
    {
        return $this->emplacement;
    }

    /**
     * @return \DateTime
     */
    public function getLastmod()
    {
        return $this->lastmod;
    }

    /**
     * @param \DateTime $lastmod
     */
    public function setLastmod($lastmod)
    {
        $this->lastmod = $lastmod;
    }

    /**
     * @ORM\PreUpdate
     */
    public function updateLastMod()
    {
        $this->lastmod = new DateTime();
    }
}

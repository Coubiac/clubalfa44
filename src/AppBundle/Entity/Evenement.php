<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\User as User;
use Doctrine\ORM\Mapping\JoinTable;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EvenementRepository")
 */
class Evenement
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
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updateAt", type="datetime")
     */
    private $updateAt;

    /**
     * @ORM\OneToMany(targetEntity="Photo", mappedBy="evenement", cascade={"persist"})
     */
    private $photos;


    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="evenements", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $inscrits;

    public function __construct()
    {
        $this->inscrits = new ArrayCollection();
        $this->photos = new ArrayCollection();


    }
    public function __toString()
    {
        return $this->getTitre();
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Evenement
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Evenement
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
     * @return Evenement
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
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Evenement
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     *
     * @return Evenement
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * Get updateAt
     *
     * @return \DateTime
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    /**
     * Add inscrit
     *
     * @param User $inscrit
     *
     * @return Evenement
     */
    public function addInscrit(User $inscrit)
    {
        $this->inscrits[] = $inscrit;

        return $this;
    }

    /**
     * Remove inscrit
     *
     * @param User $inscrit
     */
    public function removeInscrit(User $inscrit)
    {
        $this->inscrits->removeElement($inscrit);
    }

    /**
     * Get inscrits
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInscrits()
    {
        return $this->inscrits;
    }


    /**
     * Add posts
     *
     * @param \AppBundle\Entity\Photo $photo
     * @return Evenement
     */
    public function addPhoto($photo)
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
            $photo->setEvenement($this);
        }

        return $this;
    }

    /**
     * Remove photo
     *
     * @param \AppBundle\Entity\Photo $photo
     */
    public function removePhoto(\AppBundle\Entity\Photo $photo)
    {
        $this->photos->removeElement($photo);
        $photo->setEvenement(null);
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotos()
    {
        return $this->photos;
    }
}

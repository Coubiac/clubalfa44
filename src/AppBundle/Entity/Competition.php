<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Inscrit as Inscrit;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Competition
 *
 * @ORM\Table(name="competition")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CompetitionRepository")
 * @Vich\Uploadable
 */
class Competition
{
    /**
     * Nombres de compétitions par pages
     */
    const NUM_ITEMS = 4;
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
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="resultat", type="text", nullable=true)
     */
    private $resultat;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Photo", mappedBy="competition", cascade={"persist"}))
     */
    private $photos;


    /**
     * @ORM\OneToMany(targetEntity="Inscrit", mappedBy="competition", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $inscrits;

    /**
     * @ORM\ManyToMany(targetEntity="CategorieAge", inversedBy="competitions")
     * @ORM\JoinColumn(nullable=true)
     */
    private $categorieAges;

    /**
     * @ORM\ManyToOne(targetEntity="Activite", inversedBy="competitions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $activite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="competition_image", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_at", type="datetime")
     */
    private $updateAt;



    public function __toString()
    {
        return $this->getTitre();
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;
        if ($image) {
            $this->setUpdateAt(new DateTime());
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
        if ($image) {
            $this->setUpdateAt(new DateTime());
        }
    }

    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return \DateTime
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    /**
     * @param \DateTime $updateAt
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;
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
     * @return Competition
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
     * Set description
     *
     * @param string $description
     *
     * @return Competition
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
     * Set titre
     *
     * @param string $titre
     *
     * @return Competition
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
     * Set resultat
     *
     * @param string $resultat
     *
     * @return Competition
     */
    public function setResultat($resultat)
    {
        $this->resultat = $resultat;

        return $this;
    }

    /**
     * Get resultat
     *
     * @return string
     */
    public function getResultat()
    {
        return $this->resultat;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->inscrits = new ArrayCollection();
        $this->photos = new ArrayCollection();
        $this->categorieAges = new ArrayCollection();


    }

    /**
     * Add inscrit
     *
     * @param Inscrit $inscrit
     *
     * @return Competition
     */
    public function addInscrit(Inscrit $inscrit)
    {
        $this->inscrits[] = $inscrit;

        return $this;
    }

    /**
     * Remove inscrit
     *
     * @param Inscrit $inscrit
     */
    public function removeInscrit(Inscrit $inscrit)
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
     * Add photo
     *
     * @param \AppBundle\Entity\Photo $photo
     *
     * @return Competition
     */
    public function addPhoto(\AppBundle\Entity\Photo $photo)
    {
        $this->photos[] = $photo;

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

    /**
     * Set activite
     *
     * @param \AppBundle\Entity\activite $activite
     *
     * @return Competition
     */
    public function setActivite(\AppBundle\Entity\activite $activite)
    {
        $this->activite = $activite;

        return $this;
    }

    /**
     * Get activite
     *
     * @return \AppBundle\Entity\activite
     */
    public function getActivite()
    {
        return $this->activite;
    }

    /**
     * Add categorieAge
     *
     * @param \AppBundle\Entity\CategorieAge $categorieAge
     *
     *
     * @return Competition
     */
    public function addCategorieAges(\AppBundle\Entity\CategorieAge $categorieAge)
    {
        $this->categorieAges[] = $categorieAge;

        return $this;
    }

    /**
     * Remove categorieAge
     *
     * @param \AppBundle\Entity\CategorieAge $category
     */
    public function removeCategoryAge(\AppBundle\Entity\CategorieAge $categorieAge)
    {
        $this->categorieAges->removeElement($categorieAge);
    }

    /**
     * Get categorieAges
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategorieAges()
    {
        return $this->categorieAges;
    }
}

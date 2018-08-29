<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\User as User;
use Doctrine\ORM\Mapping\JoinTable;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EvenementRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Vich\Uploadable
 */
class Evenement
{

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
     * @ORM\Column(name="titre", type="string", length=255)
     * @Assert\Length(max=100, maxMessage="Votre titre ne peut dépasser {{ limit }} caractères.")
     * @Assert\Length(min=2, minMessage="Votre titre doit comporter au moins 2 caractères.")
     * @Assert\NotBlank(message = "Veuillez compléter  ce champ")
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string")
     * @Assert\NotBlank(message = "Veuillez compléter  ce champ")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     * @Assert\NotBlank(message = "Veuillez compléter  ce champ")
     *
     */
    private $contenu;
    /**
     * @Gedmo\Slug(fields={"titre"})
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;



    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="evenement_image", fileNameProperty="image")
     * @var File
     */
    private $imageFile;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_at", type="datetime")
     */
    private $updateAt;

    /**
     * @ORM\OneToMany(targetEntity="Photo", mappedBy="evenement", cascade={"persist"})
     */
    private $photos;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $weezeventLink;



    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="evenements", cascade={"persist"})
     * @JoinTable(name="evenements_users")
     * @ORM\JoinColumn(nullable=true)
     */
    private $inscrits;

    public function __construct()
    {
        $this->dateCreation = new \DateTime();
        $this->inscrits = new ArrayCollection();
        $this->photos = new ArrayCollection();


    }
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
     * Set weezeventLink
     * @param string $weezeventLink
     *
     * @return Evenement
     */
    public function setWeezeventLink($weezeventLink)
    {
        $this->weezeventLink = $weezeventLink;
        return $this;
    }

    /**
     * Get weezeventLink
     *
     * @return string
     */
    public function getWeezeventLink()
    {
        return $this->weezeventLink;
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
    public function addPhoto(\AppBundle\Entity\Photo $photo)
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
     * Set slug
     *
     * @param string $slug
     * @return Evenement
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

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
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Evenement
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }
}

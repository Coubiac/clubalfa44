<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Activite
 *
 * @ORM\Table(name="activite")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ActiviteRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Vich\Uploadable
 */
class Activite
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
     * @var int
     *
     * @ORM\Column(name="placesDisponibles", type="integer")
     */
    private $placesDisponibles;

    /**
     * @var int
     *
     * @ORM\Column(name="prix", type="integer")
     */
    private $prix;

    /**
     * @var int
     *
     * @ORM\Column(name="age_mini", type="integer")
     */
    private $ageMini;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Licence", mappedBy="activite", cascade={"persist", "merge"})
     */
    private $licences;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="activite_image", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_at", type="datetime")
     */
    private $updateAt;



    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;
        if ($image) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Competition", mappedBy="activite")
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
     * @return Activite
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
     * Set placesDisponibles
     *
     * @param integer $placesDisponibles
     *
     * @return Activite
     */
    public function setPlacesDisponibles($placesDisponibles)
    {
        $this->placesDisponibles = $placesDisponibles;

        return $this;
    }

    /**
     * Get placesDisponibles
     *
     * @return int
     */
    public function getPlacesDisponibles()
    {
        return $this->placesDisponibles;
    }

    /**
     * Set prix
     *
     * @param integer $prix
     *
     * @return Activite
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

    /**
     * Constructor
     */
    public function __construct()
    {

        //$this->licences = new ArrayCollection();
        //$this->competitions = new ArrayCollection();

    }

    /**
     * Add licence
     *
     * @param \AppBundle\Entity\Licence $licence
     *
     * @return Activite
     */
    public function addLicence(\AppBundle\Entity\Licence $licence)
    {
        $this->licences[] = $licence;
        $licence->setActivite($this);

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
     * @return Activite
     */
    public function addCompetition(\AppBundle\Entity\Competition $competition)
    {
        $this->competitions[] = $competition;
        $competition->setActivite($this);

        return $this;
    }

    /**
     * Remove competition
     *
     * @param \AppBundle\Entity\Competition $competition
     */
    public function removeCompetition(\AppBundle\Entity\Competition $competition)
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
     * Set updateAt
     *
     * @param \DateTime $updateAt
     *
     * @return Activite
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
     * Set ageMini
     *
     * @param integer $ageMini
     *
     * @return Activite
     */
    public function setAgeMini($ageMini)
    {
        $this->ageMini = $ageMini;

        return $this;
    }

    /**
     * Get ageMini
     *
     * @return int
     */
    public function getAgeMini()
    {
        return $this->ageMini;
    }

}

<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Photo
 *
 * @ORM\Table(name="photo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PhotoRepository")
 */
class Photo
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
     * @ORM\Column(name="dateUpload", type="datetime")
     */
    private $dateUpload;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Evenement", inversedBy="photos")
     * @ORM\JoinColumn(nullable=true)
     */
    private $evenement;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Competition", inversedBy="photos")
     * @ORM\JoinColumn(nullable=true)
     */
    private $competition;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Actualite", inversedBy="photos")
     * @ORM\JoinColumn(nullable=true)
     */
    private $actualite;





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
     * Set dateUpload
     *
     * @param \DateTime $dateUpload
     *
     * @return Photo
     */
    public function setDateUpload($dateUpload)
    {
        $this->dateUpload = $dateUpload;

        return $this;
    }

    /**
     * Get dateUpload
     *
     * @return \DateTime
     */
    public function getDateUpload()
    {
        return $this->dateUpload;
    }

    /**
     * Set evenement
     *
     * @param \AppBundle\Evenement $evenement
     *
     * @return Photo
     */
    public function setEvenement(\AppBundle\Evenement $evenement = null)
    {
        $this->evenement = $evenement;

        return $this;
    }

    /**
     * Get evenement
     *
     * @return \AppBundle\Evenement
     */
    public function getEvenement()
    {
        return $this->evenement;
    }

    /**
     * Set competition
     *
     * @param \AppBundle\Competition $competition
     *
     * @return Photo
     */
    public function setCompetition(\AppBundle\Competition $competition = null)
    {
        $this->competition = $competition;

        return $this;
    }

    /**
     * Get competition
     *
     * @return \AppBundle\Competition
     */
    public function getCompetition()
    {
        return $this->competition;
    }

    /**
     * Set actualite
     *
     * @param \AppBundle\Actualite $actualite
     *
     * @return Photo
     */
    public function setActualite(\AppBundle\Actualite $actualite = null)
    {
        $this->actualite = $actualite;

        return $this;
    }

    /**
     * Get actualite
     *
     * @return \AppBundle\Actualite
     */
    public function getActualite()
    {
        return $this->actualite;
    }
}

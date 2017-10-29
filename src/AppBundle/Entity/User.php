<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 27/10/2017
 * Time: 14:51
 */
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="app_users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $email;

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
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Actualite", mappedBy="author")
     */
    private $actualites;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Licence", mappedBy="proprietaire")
     */
    private $licences;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Evenement", inversedBy="inscrits")
     * @ORM\JoinColumn(nullable=true)
     */
    private $inscriptionsEvenements;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Competition", inversedBy="inscrits")
     * @ORM\JoinColumn(nullable=true)
     */
    private $inscriptionsCompetitions;

    public function __construct()
    {
        $this->isActive = true;
        $this->inscriptionsEvenements = new ArrayCollection();
        $this->inscriptionsCompetitions = new ArrayCollection();


    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }


    public function getPassword()
    {
        return $this->password;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set codePostal
     *
     * @param integer $codePostal
     *
     * @return User
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
     * @return User
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
     * @return User
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
     * @return User
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
     * Add actualite
     *
     * @param \AppBundle\Entity\Actualite $actualite
     *
     * @return User
     */
    public function addActualite(\AppBundle\Entity\Actualite $actualite)
    {
        $this->actualites[] = $actualite;

        return $this;
    }

    /**
     * Remove actualite
     *
     * @param \AppBundle\Entity\Actualite $actualite
     */
    public function removeActualite(\AppBundle\Entity\Actualite $actualite)
    {
        $this->actualites->removeElement($actualite);
    }

    /**
     * Get actualites
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActualites()
    {
        return $this->actualites;
    }

    /**
     * Add licence
     *
     * @param \AppBundle\Entity\Licence $licence
     *
     * @return User
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
     * Add inscriptionsEvenement
     *
     * @param \AppBundle\Evenement $inscriptionsEvenement
     *
     * @return User
     */
    public function addInscriptionsEvenement(\AppBundle\Evenement $inscriptionsEvenement)
    {
        $this->inscriptionsEvenements[] = $inscriptionsEvenement;

        return $this;
    }

    /**
     * Remove inscriptionsEvenement
     *
     * @param \AppBundle\Evenement $inscriptionsEvenement
     */
    public function removeInscriptionsEvenement(\AppBundle\Evenement $inscriptionsEvenement)
    {
        $this->inscriptionsEvenements->removeElement($inscriptionsEvenement);
    }

    /**
     * Get inscriptionsEvenements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInscriptionsEvenements()
    {
        return $this->inscriptionsEvenements;
    }

    /**
     * Add inscriptionsCompetition
     *
     * @param \AppBundle\Competition $inscriptionsCompetition
     *
     * @return User
     */
    public function addInscriptionsCompetition(\AppBundle\Competition $inscriptionsCompetition)
    {
        $this->inscriptionsCompetitions[] = $inscriptionsCompetition;

        return $this;
    }

    /**
     * Remove inscriptionsCompetition
     *
     * @param \AppBundle\Competition $inscriptionsCompetition
     */
    public function removeInscriptionsCompetition(\AppBundle\Competition $inscriptionsCompetition)
    {
        $this->inscriptionsCompetitions->removeElement($inscriptionsCompetition);
    }

    /**
     * Get inscriptionsCompetitions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInscriptionsCompetitions()
    {
        return $this->inscriptionsCompetitions;
    }
}

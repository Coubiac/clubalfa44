<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Competition
 *
 * @ORM\Table(name="inscrits")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CompetitionRepository")
 * @UniqueEntity(fields={"nom", "prenom"}, message="Il semble que vous soyez déja inscrit !")
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
     * @Assert\LessThan("-4 years")
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


    private $normalizeChars = array('Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
        'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ń'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
        'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
        'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
        'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ń'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
        'ú'=>'u', 'û'=>'u', 'ü'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f',
        'ă'=>'a', 'ș'=>'s', 'ț'=>'t', 'Ă'=>'A', 'Ș'=>'S', 'Ț'=>'T');

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
        $nom = strtr($nom, $this->normalizeChars);

        $nom = ucfirst(strtolower($nom));
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

        $prenom = strtr($prenom, $this->normalizeChars);

        $prenom = ucfirst(strtolower($prenom));

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

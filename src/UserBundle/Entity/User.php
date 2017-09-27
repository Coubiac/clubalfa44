<?php

namespace UserBundle\Entity;


use AppBundle\Entity\Observation;
use AppBundle\Entity\Comment;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Context\ExecutionContextInterface;


/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 * @Vich\Uploadable
 */
class User extends BaseUser
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateRegister", type="datetime")
     */
    protected $dateRegister;


    /**
     * @ORM\Column(name="firstName", type="string", length=255)
     *
     * @Assert\NotBlank(message="Veuillez renseigner votre prénom.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=2,
     *     max=40,
     *     minMessage="Le prénom doit comporter plus de 2 caractères.",
     *     maxMessage="Prénom trop long.",
     * )
     */
    protected $firstName;

    /**
     * @ORM\Column(name="lastName", type="string", length=255)
     *
     * @Assert\NotBlank(message="Veuillez renseigner votre nom.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=2,
     *     max=40,
     *     minMessage="Le nom doit comporter plus de 2 caractères.",
     *     maxMessage="Nom trop long.",
     * )
     */
    protected $lastName;

    /**
     * @Assert\Regex(
     *  pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,16}$/",
     *  message="Le mot de passe doit contenir entre 8 et 16 caractères alphanumériques dont une majuscule, une minuscule et un chiffre."
     * )
     */
    protected $plainPassword;

    /**
     * @ORM\Column(name="town", type="text", length=255)
     *
     * @Assert\NotBlank(message="Veuillez renseigner votre adresse.")
     * @Assert\Length(
     *     min=2,
     *     max=40,
     *     minMessage="Votre adresse doit comporter plus de deux caractères",
     *     maxMessage="Ce nom est trop long.",
     * )
     */
    protected $adress;


    /**
     * @var string
     * @Assert\NotBlank(message="Veuillez préciser votre code postal.")
     * @Assert\Length(max="5", min="5", minMessage="Code postal invalide", maxMessage="Code postal invalide")
     * @Assert\Regex("/[0-9]{2}[0-9]{3}/", message="Code postal à 5 chiffres, sans espace.")
     *
     * @ORM\Column(name="codePostal", length=5)
     */
    protected $codePostal;

    /**
     * @ORM\Column(name="town", type="string", length=255)
     *
     * @Assert\NotBlank(message="Veuillez renseigner votre ville.")
     * @Assert\Length(
     *     min=2,
     *     max=40,
     *     minMessage="Le nom de la ville doit comporter plus de 2 caractères.",
     *     maxMessage="Ce nom est trop long.",
     * )
     */
    protected $town;

    /**
     * @var \DateTime
     *
     * @ORM\Column(nullable=true, name="birthDate", type="date")
     * @Assert\Date()
     */
    protected $birthDate;


    public function __construct()
    {
        parent::__construct();
        $this->dateRegister = new \Datetime();
        $this->observations = new ArrayCollection();
        $this->comments = new ArrayCollection();


    }

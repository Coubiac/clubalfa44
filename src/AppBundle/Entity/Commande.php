<?php

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Licence;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommandeRepository")
 */
class Commande
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
     * @ORM\Column(name="numero", type="string", length=255, unique=true)
     */
    private $numero;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCommande", type="datetime")
     */
    private $dateCommande;

    /**
     * @var int
     *
     * @ORM\Column(name="licence_count", type="integer")
     * @Assert\Range(max=10)
     */
    private $licenceCount;

    /**
     * @var int
     *
     * @ORM\Column(name="total", type="integer")
     */
    private $total;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Licence", mappedBy="commande", cascade={"persist"})
     * @Assert\Valid()
     */
    private $licences;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="commandes", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    private $user;

    /**
     * Commande constructor.
     */
    public function __construct()
    {
        $this->licences = new ArrayCollection();
        $this->setTotal(0);
        $this->setNumero(strtoupper(uniqid("CMD")));
        $this->setDateCommande(new \Datetime());
    }

    public function __toString()
    {
        return (string)$this->getNumero();
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
     * @param string $numero
     *
     * @return Commande
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set dateCommande
     *
     * @param \DateTime $dateCommande
     *
     * @return Commande
     */
    public function setDateCommande($dateCommande)
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    /**
     * Get dateCommande
     *
     * @return \DateTime
     */
    public function getDateCommande()
    {
        return $this->dateCommande;
    }

    /**
     * Set licenceCount
     *
     * @param integer $quantity
     *
     * @return Commande
     */
    public function setLicenceCount($quantity)
    {
        $this->licenceCount = $quantity;
        return $this;
    }

    /**
     * Get licenceCount
     *
     * @return int
     */
    public function getLicenceCount()
    {
        return $this->licenceCount;
    }

    /**
     * Set total
     *
     * @param integer $total
     *
     * @return Commande
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Add licence
     *
     * @param \AppBundle\Entity\Licence $licence
     *
     * @return Commande
     */
    public function addLicence(\AppBundle\Entity\Licence $licence)
    {
        $this->licences[] = $licence;
        $licence->setCommande($this);
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
     * Set Licences
     * @param Licence[]|ArrayCollection
     */
    /**
     * @param mixed $licences
     */
    public function setLicences($licences)
    {
        $this->licences = $licences;

    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Commande
     */
    public function setUser(\AppBundle\Entity\User $user)
    {
        $this->user = $user;
        $user->addCommande($this);

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
}

<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContenuStaticEmplacement
 *
 * @ORM\Table(name="contenu_static_emplacement")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContenuStaticEmplacementRepository")
 */
class ContenuStaticEmplacement
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="url", type="string", length=255, unique=false)
     */
    private $url;

    /**
     * @var float
     * @ORM\Column(name="priority", type="decimal")
     */
    private $priority;





    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\ContenuStatic", mappedBy="emplacement")
     */
    private $contenuStatic;

    public function __toString()
    {
        return (string)$this->getName();
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
     * Set name
     *
     * @param string $name
     *
     * @return ContenuStaticEmplacement
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return ContenuStaticEmplacement
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set contenuStatic
     *
     * @param \AppBundle\Entity\ContenuStatic $contenuStatic
     *
     * @return ContenuStaticEmplacement
     */
    public function setContenuStatic(\AppBundle\Entity\ContenuStatic $contenuStatic = null)
    {
        $this->contenuStatic = $contenuStatic;

        return $this;
    }

    /**
     * Get contenuStatic
     *
     * @return \AppBundle\Entity\ContenuStatic
     */
    public function getContenuStatic()
    {
        return $this->contenuStatic;
    }
}

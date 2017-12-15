<?php
namespace AppBundle\Manager;
use AppBundle\Entity\Activite;
use AppBundle\Entity\CategorieAge;
use AppBundle\Entity\Commande;
use AppBundle\Entity\Licence;
use AppBundle\Entity\Saison;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CommandeManager extends Controller
{
    protected $em;
    protected $session;
    protected $tokenStorage;

    public function __construct(EntityManagerInterface $em, SessionInterface $session, TokenStorageInterface $tokenStorage)
    {
        $this->em = $em;
        $this->session = $session;
        $this->tokenStorage = $tokenStorage;
    }
    //Calcul du total de la commande
    /**
     * @param Commande $commande
     * @return int
     */

    public function setCommandeTotal(Commande $commande)
    {
        $total = 0;
        foreach ($commande->getLicences() as $licence)
        {
            $total += $licence->getPrix();
        }
        $commande->setTotal($total);
        return $total;
    }
    // Création d'une nouvelle commande ou récupération d'une commande en cours dans une session
    /**
     * @return Commande|mixed
     */
    public function createCommande()
    {
        if ($this->getCommande())
        {
            $commande = $this->getCommande();
        }
        else
        {
            $commande = new Commande();
        }
        return $commande;
    }

    // conversion d'une commande en variable php.
    /**
     * @return bool|mixed
     */
    public function getCommande()
    {
        if ($this->session->has('commande'))
        {

            $commande = $this ->session->get('commande');

            foreach ($commande->getLicences() as $licence){
                $licence->setUser($this->tokenStorage->getToken()->getUser());
                if($licence->getCategorieAge()){
                    $licence->setCategorieAge($this->em->getRepository(CategorieAge::class)->find($licence->getCategorieAge()->getId()));
                }
                if($licence->getSaison()){
                    $licence->setSaison($this->em->getRepository(Saison::class)->find($licence->getSaison()->getId()));
                }
                if($licence->getActivite()){
                    $licence->setActivite($this->em->getRepository(Activite::class)->find($licence->getActivite()->getId()));
                }

            }

        }
        else
        {
            return false;
        }
        return $commande;
    }


    //Linéarisation qui conserve le type de la variable originale pour stocker une commande.
    /**
     * @param $commande
     * @return mixed
     */
    public function saveCommande(Commande $commande)
    {

        $this->session->set('commande', $commande) ;
        dump($this ->session->get('commande'));
        
        return $commande;
    }


    //Adaptation du nombre de licences au nombre précisé dans le formumaire après un retour et une modification du nombre.
    /**
     * @param $commande
     * @return mixed
     */
    public function adaptlicences(Commande $commande)
    {
        $nb = $commande->getLicenceCount();
        while ($nb != count($commande->getLicences()))
        {
            if ($nb > count($commande->getLicences()))
            {
                $commande->addlicence(new licence());
            }
            elseif ($nb < count($commande->getLicences()))
            {
                $commande->removelicence($commande->getLicences()->last());
            }
        }
        return $commande;
    }

    //On enregistre la commande en BDD et on supprime la session
    /**
     * @param Commande $commande
     */
    public function flushAndRemoveSession(Commande $commande)
    {
        $this->em->persist($commande);
        $this->em->flush();
        $this->session->remove('commande');
    }
}

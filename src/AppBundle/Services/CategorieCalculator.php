<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 06/12/2017
 * Time: 15:28
 */
namespace AppBundle\Services;

use AppBundle\Entity\Commande;
use AppBundle\Entity\CategorieAge;
use Doctrine\ORM\EntityManagerInterface;

class CategorieCalculator

{

    protected $em;


    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function setCategoriesAge(Commande $commande){
        foreach ($commande->getLicences() as $licence)
        {
            if ($licence->getActivite() == 'LUTTE' || $licence->getActivite() == 'GRAPPLING-FIGHT'){
                $saison = $licence->getSaison();

                $age = $saison->getDateDebut()->format('Y') - $licence->getBirthDate()->format('Y');
                $categorie = $this->em->getRepository(CategorieAge::class)->selectAgeCategory($age);

                if(!is_null($categorie)){
                    $licence->setCategorieAge($categorie);
                }


            }
            else{
                $categorie = $this->em->getRepository(CategorieAge::class)->find('15');

                $licence->setCategorieAge($categorie);
            }


        }
        $commande = $this->em->merge($commande);


        return $commande;

    }


}

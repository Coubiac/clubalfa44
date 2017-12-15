<?php

namespace AppBundle\Services;

use AppBundle\Entity\Commande;
use AppBundle\Entity\Licence;
use Doctrine\Common\Collections\ArrayCollection;

class PriceCalculator
{

    const REDUC_LUTTE_2EME_LICENCE = 7;
    const REDUC_LUTTE_3EME_LICENCE = 20;
    const REDUC_FITNESS_2EME_LICENCE = 20;


    private $categorieCalculator;

    public function __construct(CategorieCalculator $categorieCalculator)
    {
        $this->categorieCalculator = $categorieCalculator;
    }


    public function setPrices(Commande $commande)
    {
        $this->categorieCalculator->setCategoriesAge($commande);
        $this->setLutteLicencesPrice($commande);
        $this->setFitnessLicencesPrice($commande);
        $this->setGrapplingLicencePrice($commande);

        return $commande;
    }

    private function sortLicencesCommandeByBirthdate(Commande $commande)
    {
        $licences = $commande->getLicences();

        $iterator = $licences->getIterator();
        $iterator->uasort(function ($a, $b) {
            return ($a->getBirthdate() < $b->getBirthdate()) ? -1 : 1;
        });
        $licences = new ArrayCollection(array_values(iterator_to_array($iterator)));
        $commande->setLicences($licences);
        return $commande;

    }

    private function setLutteLicencesPrice(Commande $commande){

        $this->sortLicencesCommandeByBirthdate($commande);


        $lutteLicences = $commande->getLicences()->filter(function (Licence $licence) {
            if ($licence->getActivite() == 'LUTTE')
                return $licence; // filter based on activity name.
        });

        $keys = $lutteLicences->getKeys();
        $count = count($keys);


        for ($i = 0; $i < $count; $i++) {
            $key = $keys[$i];
            $prixBase = $lutteLicences[$key]->getCategorieAge()->getPrixBase();

            if ($i == 0) {
                $lutteLicences[$key]->setPrix($prixBase);
            }
            if ($i == 1) {
                $lutteLicences[$key]->setPrix($prixBase - self::REDUC_LUTTE_2EME_LICENCE);
            }
            if ($i > 1) {
                $lutteLicences[$key]->setPrix($prixBase - self::REDUC_LUTTE_3EME_LICENCE);
            }
        }
        return $commande;

    }

    private function setFitnessLicencesPrice(Commande $commande){

        $fitnessLicences = $commande->getLicences()->filter(function (Licence $licence) {
            if ($licence->getActivite() == 'FITNESS' || $licence->getActivite() == 'MUSCULATION')
                return $licence; // filter based on activity name.
        });

        if ($fitnessLicences->count() > 1) {
            foreach ($fitnessLicences as $fitnessLicence) {
                $fitnessLicence->setPrix($fitnessLicence->getActivite()->getPrix() - self::REDUC_FITNESS_2EME_LICENCE);
            }
        } elseif ($fitnessLicences->count() == 1) {
            foreach ($fitnessLicences as $fitnessLicence) {
                $fitnessLicence->setPrix($fitnessLicence->getActivite()->getPrix());
            }
        }
        return $commande;

    }

    private function setGrapplingLicencePrice(Commande $commande){

        $grapplingLicences = $commande->getLicences()->filter(function (Licence $licence) {
            if ($licence->getActivite() == 'GRAPPLING-FIGHT')
                return $licence; // filter based on activity name.
        });

        foreach ($grapplingLicences as $grapplingLicence){
            $grapplingLicence->setPrix($grapplingLicence->getActivite()->getPrix());
        }
        return $commande;
    }


}

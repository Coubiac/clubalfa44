<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\CategorieAge;

class CategorieAgeFixture extends Fixture{

    public function load(ObjectManager $manager)
    {

        $u7 = array(
            'nom' => 'U7',
            'description' => 'POUSSIN A',
            'ageMin' => 4,
            'ageMax' => 6,
            'prixBase' => 107
        );

        $u9 = array(
            'nom' => 'U9',
            'description' => 'POUSSIN B',
            'ageMin' => 7,
            'ageMax' => 8,
            'prixBase' => 107
        );

        $u11 = array(
            'nom' => 'U9',
            'description' => 'POUSSIN C',
            'ageMin' => 9,
            'ageMax' => 10,
            'prixBase' => 122
        );

        $u13 = array(
            'nom' => 'U13',
            'description' => 'BENJAMIN',
            'ageMin' => 11,
            'ageMax' => 12,
            'prixBase' => 122
        );

        $u15 = array(
            'nom' => 'U15',
            'description' => 'MINIME',
            'ageMin' => 13,
            'ageMax' => 14,
            'prixBase' => 122
        );

        $u17 = array(
            'nom' => 'U17',
            'description' => 'CADET',
            'ageMin' => 15,
            'ageMax' => 16,
            'prixBase' => 128
        );

        $u20 = array(
            'nom' => 'U18',
            'description' => 'JUNIOR',
            'ageMin' => 17,
            'ageMax' => 19,
            'prixBase' => 128
        );

        $u35 = array(
            'nom' => 'U35',
            'description' => 'SENIOR',
            'ageMin' => 20,
            'ageMax' => 34,
            'prixBase' => 128
        );

        $u40 = array(
            'nom' => 'U40',
            'description' => 'VETERAN A',
            'ageMin' => 35,
            'ageMax' => 39,
            'prixBase' => 128
        );

        $u45 = array(
            'nom' => 'U45',
            'description' => 'VETERAN B',
            'ageMin' => 40,
            'ageMax' => 44,
            'prixBase' => 128
        );

        $u55 = array(
            'nom' => 'U55',
            'description' => 'VETERAN C',
            'ageMin' => 45,
            'ageMax' => 54,
            'prixBase' => 128
        );


        $u65 = array(
            'nom' => 'U65',
            'description' => 'VETERAN D',
            'ageMin' => 55,
            'ageMax' => 64,
            'prixBase' => 128
        );

        $u100 = array(
            'nom' => 'U100',
            'description' => 'VETERAN E',
            'ageMin' => 65,
            'ageMax' => 100,
            'prixBase' => 128
        );

        $u1000 = array(
            'nom' => 'NON',
            'description' => 'APPLICABLE',
            'ageMin' => 1000,
            'ageMax' => 2000,
            'prixBase' => 1000
        );

        $categoriesAges = [$u7,$u9,$u11,$u13,$u15,$u17,$u20,$u35,$u40,$u45,$u55,$u65,$u100,$u1000];

        foreach ($categoriesAges as $categorieArray){

            $categorieAge = new CategorieAge();
            $categorieAge->setNom($categorieArray["nom"]);
            $categorieAge->setDescription($categorieArray["description"]);
            $categorieAge->setAgeMin($categorieArray["ageMin"]);
            $categorieAge->setAgeMax($categorieArray["ageMax"]);
            $categorieAge->setPrixBase($categorieArray["prixBase"]);
            $manager->persist($categorieAge);
            $manager->flush();
        }
    }

}

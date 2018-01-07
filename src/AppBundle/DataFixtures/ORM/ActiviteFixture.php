<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Activite;

class ActiviteFixture extends Fixture
{

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $lutte = array(
            'nom' => 'LUTTE',
            'placesDisponibles' => '10',
            'ageMin' => 4,
            'prix' => 128
        );

        $grappling = array(
            'nom' => 'GRAPPLING-FIGHT',
            'placesDisponibles' => '10',
            'ageMin' => 4,
            'prix' => 128
        );

        $fitness = array(
            'nom' => 'FITNESS',
            'placesDisponibles' => '10',
            'ageMin' => 16,
            'prix' => 180
        );

        $musculation = array(
            'nom' => 'MUSCULATION',
            'placesDisponibles' => '10',
            'ageMin' => 18,
            'prix' => 180
        );

        $activites = [$lutte, $grappling, $fitness, $musculation];

        foreach ($activites as $array) {

            $activite = new Activite();
            $activite->setNom($array["nom"])->setPlacesDisponibles($array["placesDisponibles"])->setAgeMini($array["ageMin"])->setPrix($array["prix"]);
            $manager->persist($activite);
            $manager->flush();

        }

    }
}

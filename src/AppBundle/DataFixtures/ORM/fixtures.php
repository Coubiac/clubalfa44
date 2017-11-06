<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\ContenuStatic;
use AppBundle\Entity\User;

class fixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $contenuIndex = new ContenuStatic();
        $contenuIndex
            ->setEmplacement("index")
            ->setTitre("club Alfa 44")
            ->setDescription('Club de Lutte, Fitness, Musculation, Grappling Fight')
            ->setContenu("Lorem ipsum dolor sit amet, consectetur adipiscing elit.ros tortor");


        $manager->persist($contenuIndex);
        $manager->flush();

        $contenuLutte = new ContenuStatic();
        $contenuLutte
            ->setEmplacement("lutte")
            ->setTitre("Lutte")
            ->setDescription('l\'activité LUTTE au club Alfa')
            ->setContenu("Lorem ipsum dolor sit amet, consectetur adipiscing elit.ros tortor");


        $manager->persist($contenuLutte);
        $manager->flush();

        $contenuFitness = new ContenuStatic();
        $contenuFitness
            ->setEmplacement("fitness")
            ->setTitre("Lutte")
            ->setDescription('l\'activité Fitness au club Alfa')
            ->setContenu("Lorem ipsum dolor sit amet, consectetur adipiscing elit.ros tortor");


        $manager->persist($contenuFitness);
        $manager->flush();

        $contenuMusculation = new ContenuStatic();
        $contenuMusculation
            ->setEmplacement("musculation")
            ->setTitre("Musculation")
            ->setDescription('l\'activité Musculation au club Alfa')
            ->setContenu("Lorem ipsum dolor sit amet, consectetur adipiscing elit.ros tortor");


        $manager->persist($contenuMusculation);
        $manager->flush();

        $contenuGrappling = new ContenuStatic();
        $contenuGrappling
            ->setEmplacement("grappling")
            ->setTitre("Grappling Fight")
            ->setDescription('l\'activité Grappling Fight au club Alfa')
            ->setContenu("Lorem ipsum dolor sit amet, consectetur adipiscing elit.ros tortor");


        $manager->persist($contenuGrappling);
        $manager->flush();

        $admin = new User;
        $admin->setEmail("admin@mail.com");
        $admin->setNom("ad")->setPrenom("min")->setPlainPassword("123456");
        $admin->setAdresse("123 rue AAAA")->setCodePostal(12345)->setVille("VILLE")->setBirthdate(new \DateTime());
        $admin->setAdmin(true)->setSuperAdmin(true);

        $manager->persist($admin);
        $manager->flush();

    }
}
<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\ContenuStaticEmplacement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\ContenuStatic;
use AppBundle\Entity\User;

class fixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $indexEmplacement = new ContenuStaticEmplacement();
        $indexEmplacement->setName("index")->setUrl("/");
        $contenuIndex = new ContenuStatic();
        $contenuIndex
            ->setEmplacement($indexEmplacement)
            ->setTitre("club Alfa 44")
            ->setDescription('Club de Lutte, Fitness, Musculation, Grappling Fight')
            ->setContenu("Lorem ipsum dolor sit amet, consectetur adipiscing elit.ros tortor");


        $manager->persist($contenuIndex);
        $manager->flush();


        $lutteEmplacement = new ContenuStaticEmplacement();
        $lutteEmplacement->setName("lutte-presentation")->setUrl("/lutte/presentation");
        $contenuLutte = new ContenuStatic();
        $contenuLutte
            ->setEmplacement($lutteEmplacement)
            ->setTitre("Lutte")
            ->setDescription('l\'activité LUTTE au club Alfa')
            ->setContenu("Lorem ipsum dolor sit amet, consectetur adipiscing elit.ros tortor");


        $manager->persist($contenuLutte);
        $manager->flush();

        $fitnessEmplacement = new ContenuStaticEmplacement();
        $fitnessEmplacement->setName("fitness-presentation")->setUrl("/fitness/presentation");
        $contenuFitness = new ContenuStatic();
        $contenuFitness
            ->setEmplacement($fitnessEmplacement)
            ->setTitre("Lutte")
            ->setDescription('l\'activité Fitness au club Alfa')
            ->setContenu("Lorem ipsum dolor sit amet, consectetur adipiscing elit.ros tortor");


        $manager->persist($contenuFitness);
        $manager->flush();

        $muscuEmplacement = new ContenuStaticEmplacement();
        $muscuEmplacement->setName("muscu-presentation")->setUrl("/musculation/presentation");
        $contenuMusculation = new ContenuStatic();
        $contenuMusculation
            ->setEmplacement($muscuEmplacement)
            ->setTitre("Musculation")
            ->setDescription('l\'activité Musculation au club Alfa')
            ->setContenu("Lorem ipsum dolor sit amet, consectetur adipiscing elit.ros tortor");


        $manager->persist($contenuMusculation);
        $manager->flush();


        $grapplingEmplacement = new ContenuStaticEmplacement();
        $grapplingEmplacement->setName("grappling-presentation")->setUrl("/grappling/presentation");
        $contenuGrappling = new ContenuStatic();
        $contenuGrappling
            ->setEmplacement($grapplingEmplacement)
            ->setTitre("Grappling Fight")
            ->setDescription('l\'activité Grappling Fight au club Alfa')
            ->setContenu("Lorem ipsum dolor sit amet, consectetur adipiscing elit.ros tortor");


        $manager->persist($contenuGrappling);
        $manager->flush();

        $admin = new User;
        $admin->setEmail("admin@mail.com")->setUsername('admin');
        $admin->setNom("name")->setPrenom("firstname")->setPlainPassword("123456");
        $admin->setAdresse("123 rue AAAA")->setCodePostal(12345)->setVille("VILLE")->setBirthdate(new \DateTime());
        $admin->setAdmin(true)->setSuperAdmin(true);

        $manager->persist($admin);
        $manager->flush();

    }
}

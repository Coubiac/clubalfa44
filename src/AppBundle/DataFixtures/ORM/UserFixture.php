<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class userFixture extends Fixture{

    public function load(ObjectManager $manager)
    {
        $admin = new User;
        $admin->setEmail("admin@mail.com")->setUsername('admin')->setEnabled(true);
        $admin->setNom("Doe")->setPrenom("John")->setPlainPassword("123456");
        $admin->setAdresse("123 rue AAAA")->setCodePostal(12345)->setVille("VILLE")->setBirthdate(new \DateTime());
        $admin->setAdmin(true)->setSuperAdmin(true);

        $manager->persist($admin);
        $manager->flush();

        $user = new User;
        $user->setEmail("user@mail.com")->setUsername('user')->setEnabled(true);
        $user->setNom("Doe")->setPrenom("Jane")->setPlainPassword("123456");
        $user->setAdresse("123 rue AAAA")->setCodePostal(12345)->setVille("VILLE")->setBirthdate(new \DateTime());

        $manager->persist($user);
        $manager->flush();
    }



}

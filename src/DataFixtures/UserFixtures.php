<?php

namespace App\DataFixtures;

use App\Entity\ChefsProjets;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $admin = new ChefsProjets();
        $admin->setEmail('tristanfio05@gmail.com');
        $admin->setNom('Tristan');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword('$2y$13$pNb2e51UVEgWB.ybYmbbVOFUT0fMLJAhcRfqjkmtbmLyEt/oBqJWO');

        $manager->persist($admin);

        $user = new ChefsProjets();
        $user->setEmail('olivier.audegond@sully-group.fr');
        $user->setNom('Olivier');
        $user->setPassword('$2y$13$A0yBuBq8fDxHISenrrkGjO30OI.mqojOK0WFOpnburagMVZLT4hx6');

        $manager->persist($user);

        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Collaborateurs;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CollaborateurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $collab = new Collaborateurs();
        $collab->setPrenom('Tristan');
        $collab->setNom('Fioroni');

        $manager->persist($collab);

        $manager->flush();
    }
}

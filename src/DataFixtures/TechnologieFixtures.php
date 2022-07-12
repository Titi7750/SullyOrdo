<?php

namespace App\DataFixtures;

use App\Entity\Competences;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TechnologieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $techno = new Competences();
        $techno->setTechnologie('Symfony');
        $techno->setTechnologie('Flutter');
        $techno->setTechnologie('Java');
        $techno->setTechnologie('Swift');
        $techno->setTechnologie('Javascript');
        $techno->setTechnologie('Xamarin');
        
        $manager->persist($techno);

        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Developer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $developer = new Developer();
            $developer->setName('Developer ' . $i);
            $developer->setLevel($i);
            $manager->persist($developer);
        }
        $manager->flush();
    }
}

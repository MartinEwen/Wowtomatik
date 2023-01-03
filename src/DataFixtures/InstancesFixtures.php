<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Instances;
use App\DataFixtures\UserFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class InstancesFixtures extends Fixture
{
    public function __construct(
        // Appel de le fonction de sluggage
        private SluggerInterface $slugger
    ) {
    }
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $instance = new Instances();
            $faker = Factory::create('fr-FR');
            $instance->setNameInstance($faker->unique()->name(2, true));
            $manager->persist($instance);
        }
        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            UserFixtures::class
        ];
    }
}

<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Boss;
use App\DataFixtures\UserFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BossFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(
        // Appel de le fonction de sluggage
        private SluggerInterface $slugger
    ) {
    }
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 50; $i++) {
            $boss = new Boss();
            $faker = Factory::create('fr-FR');
            $boss->setNameBoss($faker->unique()->name(2, true))
                ->setImgBoss($faker->unique()->numberBetween(0, 1000));
            $manager->persist($boss);
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

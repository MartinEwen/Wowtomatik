<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Characters;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CharactersFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(
        // Appel de le fonction de sluggage
        private SluggerInterface $slugger
    ) {
    }

    public function load(ObjectManager $manager): void
    {

        for ($i = 0; $i < 25; $i++) {
            // Paramètre pour avoir des données faker en français
            $faker = Factory::create('fr-FR');
            // Création d'un nouveau character
            $characters = new Characters();
            $idUser = random_int(0, 9);

            $gear1 = random_int(3000, 4200);
            $gear2 = random_int(3000, 4200);
            $characters->setNameCharacter($faker->unique()->name())
                ->setLvlCharacter('80')
                ->setGearScoreSpe1($gear1)
                ->setGearScoreSpe2($gear2)
                // Récuperation de l'id user.
                ->setUser($this->getReference('user-' . $idUser));
            $manager->persist($characters);
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

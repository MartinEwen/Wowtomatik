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
        $class = array("war", "priest", "hunt", "DK", "drood", "paladin", "shaman", "demoniste", "mage", "fufu");
        $speWar = array("arme", "furry", "protection");
        $spePriest = array("Holy", "discipline", "shadow");
        $speHunt = array("beastMaster", "Precision", "survie");
        $speDK = array("sang tank", "sang DPS", "givre tank", "givre DPS", "impie tank", "impie DPS");
        $speDrood = array("equilibre", "feral DPS", "feral tank", "heal");
        $spePaladin = array("protection", "sacré", "retribution");
        $speShaman = array("elementaire", "heal", "amelioration");
        $speDemoniste = array("demono", "destruction", "affliction");
        $spemage = array("arcane", "feu", "givre");
        $speFufu = array("assassination", "combat", "finesse");

        for ($i = 0; $i < 25; $i++) {
            // Paramètre pour avoir des données faker en français
            $faker = Factory::create('fr-FR');
            // Création d'un nouveau character
            $characters = new Characters();
            $random_key = array_rand($class, 1);
            $idUser = random_int(0, 9);
            $random_user = $this->getReference('user-' . $idUser);

            if ($random_key == 0) {
                $random_spe = array_rand($speWar, 1);
                $spe = ($speWar[$random_spe]);
            } elseif ($random_key == 1) {
                $random_spe = array_rand($spePriest, 1);
                $spe = ($spePriest[$random_spe]);
            } elseif ($random_key == 2) {
                $random_spe = array_rand($speHunt, 1);
                $spe = ($speHunt[$random_spe]);
            } elseif ($random_key == 3) {
                $random_spe = array_rand($speDK, 1);
                $spe = ($speDK[$random_spe]);
            } elseif ($random_key == 4) {
                $random_spe = array_rand($speDrood, 1);
                $spe = ($speDrood[$random_spe]);
            } elseif ($random_key == 5) {
                $random_spe = array_rand($spePaladin, 1);
                $spe = ($spePaladin[$random_spe]);
            } elseif ($random_key == 6) {
                $random_spe = array_rand($speShaman, 1);
                $spe = ($speShaman[$random_spe]);
            } elseif ($random_key == 7) {
                $random_spe = array_rand($speDemoniste, 1);
                $spe = ($speDemoniste[$random_spe]);
            } elseif ($random_key == 8) {
                $random_spe = array_rand($spemage, 1);
                $spe = ($spemage[$random_spe]);
            } elseif ($random_key == 9) {
                $random_spe = array_rand($speFufu, 1);
                $spe = ($speFufu[$random_spe]);
            }

            if ($random_key == 0) {
                $random_spe2 = array_rand($speWar, 1);
                $spe2 = ($speWar[$random_spe2]);
            } elseif ($random_key == 1) {
                $random_spe2 = array_rand($spePriest, 1);
                $spe2 = ($spePriest[$random_spe2]);
            } elseif ($random_key == 2) {
                $random_spe2 = array_rand($speHunt, 1);
                $spe2 = ($speHunt[$random_spe2]);
            } elseif ($random_key == 3) {
                $random_spe2 = array_rand($speDK, 1);
                $spe2 = ($speDK[$random_spe2]);
            } elseif ($random_key == 4) {
                $random_spe2 = array_rand($speDrood, 1);
                $spe2 = ($speDrood[$random_spe2]);
            } elseif ($random_key == 5) {
                $random_spe2 = array_rand($spePaladin, 1);
                $spe2 = ($spePaladin[$random_spe2]);
            } elseif ($random_key == 6) {
                $random_spe2 = array_rand($speShaman, 1);
                $spe2 = ($speShaman[$random_spe2]);
            } elseif ($random_key == 7) {
                $random_spe2 = array_rand($speDemoniste, 1);
                $spe2 = ($speDemoniste[$random_spe2]);
            } elseif ($random_key == 8) {
                $random_spe2 = array_rand($spemage, 1);
                $spe2 = ($spemage[$random_spe2]);
            } elseif ($random_key == 9) {
                $random_spe2 = array_rand($speFufu, 1);
                $spe2 = ($speFufu[$random_spe2]);
            }

            $gear1 = random_int(3000, 4200);
            $gear2 = random_int(3000, 4200);
            $characters->setNameCharacter($faker->unique()->name())
                ->setLvlCharacter('80')
                ->setClassCharacter($class[$random_key])
                ->setSpeCharacter1($spe)
                ->setGearScoreSpe1($gear1)
                ->setSpeCharacter2($spe2)
                ->setGearScoreSpe2($gear2)
                ->setRoleGuild('in Progress')
                // Récuperation de l'id user.
                ->setUser($random_user);
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

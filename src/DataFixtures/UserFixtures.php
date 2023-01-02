<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        // Appel de la fonction de hachage du mot de passe
        private UserPasswordHasherInterface $passwordEncoder,
    ) {
    }
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            // Paramètre pour avoir des données faker en français
            $faker = Factory::create('fr-FR');
            // Création d'un nouvelle utilisateur
            $user = new User();
            // Utiliser : "$faker-> (type de donnée)" pour générer des données
            $user->setEmail($faker->email())
                ->setRoles(['ROLE_USER'])
                ->setPseudo($faker->word(1, true))
                ->setPassword($this->passwordEncoder->hashPassword(
                    $user,
                    'user'
                ));
            $manager->persist($user);
            // Référencement de l'utilisateur qui permet de récuppèrer l'utiliteur dans un autre fichier fixture
            $this->addReference('user-' . $i, $user);
        }
        $manager->flush();
    }
}

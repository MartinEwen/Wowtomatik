<?php

namespace App\Controller;

use App\Repository\BossRepository;
use App\Repository\KillRepository;
use App\Repository\RaceRepository;
use App\Repository\ClasseRepository;
use App\Repository\GuildsRepository;
use App\Repository\InstancesRepository;
use App\Repository\CharactersRepository;
use App\Repository\SpecialisationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(KillRepository $killRepository): Response
    {
        return $this->render('main/index.html.twig', [
            'kills' => $killRepository->findAll(),
        ]);
    }

    #[Route('/confidentialite', name: 'confidentialite')]
    public function confidentialite(): Response
    {
        return $this->render('main/confidentialite.html.twig');
    }

    #[Route('/copyright', name: 'copyright')]
    public function copyright(): Response
    {
        return $this->render('main/copyright.html.twig');
    }

    #[Route('/FAQ', name: 'FAQ')]
    public function FAQ(): Response
    {
        return $this->render('main/faq.html.twig');
    }

    #[Route('/admin', name: 'app_admin', methods: ['GET'])]
    public function admin(InstancesRepository $instancesRepository, RaceRepository $raceRepository, SpecialisationRepository $specialisationRepository, ClasseRepository $classeRepository, GuildsRepository $guildsRepository, BossRepository $bossRepository, CharactersRepository $charactersRepository): Response
    {
        return $this->render('main/admin.html.twig', [
            'instances' => $instancesRepository->findAll(),
            'bosses' => $bossRepository->findAll(),
            'races' => $raceRepository->findAll(),
            'specialisations' => $specialisationRepository->findAll(),
            'classes' => $classeRepository->findAll(),
            'guilds' => $guildsRepository->findAll(),
            'characters' => $charactersRepository->findAll(),
        ]);
    }
}

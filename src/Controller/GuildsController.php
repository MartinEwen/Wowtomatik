<?php

namespace App\Controller;

use App\Entity\Guilds;
use App\Form\GuildsType;
use App\Repository\GuildsRepository;
use App\Repository\ApplicantRepository;
use App\Repository\CharactersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/guilds')]
class GuildsController extends AbstractController
{

    #[Route('/{character}', name: 'app_guilds_index', methods: ['GET', 'POST'])]
    public function index(GuildsRepository $guildsRepository, CharactersRepository $characterRepository, $character, ApplicantRepository $applicantRepository): Response
    {
        $character = $characterRepository->find($character);
        $storedValue  = $character->getId();
        $guilds = $guildsRepository->findAll();
        $charactersCount = [];
        foreach ($guilds as $guild) {
            $charactersCount[$guild->getId()] = $characterRepository->countByGuilds($guild->getId());
        }
        return $this->render('guilds/index.html.twig', [
            'guilds' => $guildsRepository->findAll(),
            'characters' => $characterRepository->findAll(),
            'applicants' => $applicantRepository->findAll(),
            'storedValue' => $storedValue,
            'guilds' => $guilds,
            'charactersCount' => $charactersCount
        ]);
    }

    #[Route('/new/{character}', name: 'app_guilds_new', methods: ['GET', 'POST'])]
    public function new(Request $request, GuildsRepository $guildsRepository, CharactersRepository $characterRepository, $character): Response
    {
        $guild = new Guilds();
        $form = $this->createForm(GuildsType::class, $guild);
        $form->handleRequest($request);
        $character = $characterRepository->find($character);
        $role = $character->getRoleGuild();
        if ($form->isSubmitted() && $form->isValid() && $role == "ROLE_NONE") {
            $guildsRepository->save($guild, true);
            if ($guild->getId()) {
                $character->setGuilds($guild);
                $character->setRoleGuild("ROLE_GUILDMASTER");
                $characterRepository->save($character, true);
            }
            return $this->redirectToRoute('main', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('guilds/new.html.twig', [
            'guild' => $guild,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_guilds_show', methods: ['GET'])]
    public function show(Guilds $guild): Response
    {
        return $this->render('guilds/show.html.twig', [
            'guild' => $guild,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_guilds_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Guilds $guild, GuildsRepository $guildsRepository): Response
    {
        $form = $this->createForm(GuildsType::class, $guild);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $guildsRepository->save($guild, true);

            return $this->redirectToRoute('app_guilds_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('guilds/edit.html.twig', [
            'guild' => $guild,
            'form' => $form,
        ]);
    }


    #[Route('/add/{guild}/{character}', name: 'app_guilds_add', methods: ['GET', 'POST'])]
    public function add(GuildsRepository $guildsRepository, ApplicantRepository $applicantRepository, EntityManagerInterface $em, CharactersRepository $charactersRepository, $character, $guild): Response
    {
        $guild = $guildsRepository->find($guild);
        $character = $charactersRepository->find($character);
        $applicantIDs = array_map(function ($applicant) {
            return $applicant->getID();
        }, $applicantRepository->findBy(array('characters' => $character)));
        if ($guild->getId()) {
            $character->setGuilds($guild);
            $character->setRoleGuild("ROLE_MEMBER");
            $charactersRepository->save($character, true);

            foreach ($applicantIDs as $applicant) {
                $applicant = $applicantRepository->find($applicant);
                $em->remove($applicant);
            }
            $em->flush();
        }
        return $this->redirectToRoute('main', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/no/{guild}/{character}', name: 'app_guilds_add', methods: ['GET', 'POST'])]
    public function no(ApplicantRepository $applicantRepository, GuildsRepository $guildsRepository, CharactersRepository $characterRepository, EntityManagerInterface $em, $guild, $character): Response
    {
        $guild = $guildsRepository->find($guild)->getId();
        $character = $characterRepository->find($character)->getId();
        $applicant = $applicantRepository->findOneBy(['guild' => $guild, 'characters' => $character]);
        $applicant->setAccept(false);
        $em->persist($applicant);
        $em->flush();
        return $this->redirectToRoute('main', [], Response::HTTP_SEE_OTHER);
    }


    #[Route('/delete/{id}', name: 'app_guilds_delete', methods: ['GET', 'POST'])]
    public function delete(Request $request, Guilds $guild, GuildsRepository $guildsRepository, CharactersRepository $charactersRepository, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete' . $guild->getId(), $request->request->get('_token'))) {
            $characters = $charactersRepository->findBy(['guilds' => $guild]);
            foreach ($characters as $character) {
                $character->setGuilds(null);
                $character->setRoleGuild("ROLE_NONE");
                $charactersRepository->save($character);
            }
            $em->flush();
            $guildsRepository->remove($guild);
            $em->flush();
        }

        return $this->redirectToRoute('main', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/delete/character/{character}', name: 'app_guilds_delete_character', methods: ['GET', 'POST'])]
    public function deleteCharacter(CharactersRepository $charactersRepository, $character): Response
    {
        $character->setGuilds(null);
        $character->setRoleGuild("ROLE_NONE");
        $charactersRepository->save($character);
        return $this->redirectToRoute('main', [], Response::HTTP_SEE_OTHER);
    }
}

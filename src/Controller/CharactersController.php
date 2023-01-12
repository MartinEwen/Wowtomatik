<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Entity\Characters;
use App\Form\CharactersType;
use App\Repository\CharactersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/characters')]
class CharactersController extends AbstractController
{
    #[Route('/', name: 'app_characters_index', methods: ['GET'])]
    public function index(CharactersRepository $charactersRepository): Response
    {
        return $this->render('characters/index.html.twig', [
            'characters' => $charactersRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_characters_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CharactersRepository $charactersRepository): Response
    {
        $user = $this->getUser();
        $character = new Characters();
        $form = $this->createForm(CharactersType::class, $character);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $character->setUser($user);
            $charactersRepository->save($character, true);

            return $this->redirectToRoute('app_characters_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('characters/new.html.twig', [
            'character' => $character,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_characters_show', methods: ['GET'])]
    public function show(Characters $character): Response
    {
        return $this->render('characters/show.html.twig', [
            'character' => $character,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_characters_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Characters $character, CharactersRepository $charactersRepository): Response
    {
        $form = $this->createForm(CharactersType::class, $character);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $charactersRepository->save($character, true);

            return $this->redirectToRoute('app_characters_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('characters/edit.html.twig', [
            'character' => $character,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_characters_delete', methods: ['POST'])]
    public function delete(Request $request, Characters $character, CharactersRepository $charactersRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $character->getId(), $request->request->get('_token'))) {
            $charactersRepository->remove($character, true);
        }

        return $this->redirectToRoute('app_characters_index', [], Response::HTTP_SEE_OTHER);
    }


    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/ajax/handle-request', name: 'handle_ajax_request', methods: ['POST'])]
    public function handleAjaxRequest(Request $request): JsonResponse
    {
        $selectedRace = $request->request->get('race');
        $classes = $this->entityManager->getRepository(Classe::class)->findBy(['race' => $selectedRace]);
        $classesArray = array();
        foreach ($classes as $classe) {
            $classesArray[$classe->getId()] = $classe->getName();
        }
        return new JsonResponse($classesArray);
    }
}

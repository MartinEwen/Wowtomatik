<?php

namespace App\Controller;

use App\Entity\Characters;
use App\Entity\Guilds;
use App\Form\GuildsType;
use App\Repository\GuildsRepository;
use App\Repository\CharactersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/guilds')]
class GuildsController extends AbstractController
{
    #[Route('/', name: 'app_guilds_index', methods: ['GET'])]
    public function index(GuildsRepository $guildsRepository): Response
    {
        return $this->render('guilds/index.html.twig', [
            'guilds' => $guildsRepository->findAll(),
        ]);
    }

    #[Route('/new/{character}', name: 'app_guilds_new', methods: ['GET', 'POST'])]
    public function new(Request $request, GuildsRepository $guildsRepository): Response
    {
        $guild = new Guilds();
        $form = $this->createForm(GuildsType::class, $guild);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $guildsRepository->save($guild, true);
            return $this->redirectToRoute('app_guilds_index', [], Response::HTTP_SEE_OTHER);
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

    #[Route('/{id}', name: 'app_guilds_delete', methods: ['POST'])]
    public function delete(Request $request, Guilds $guild, GuildsRepository $guildsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $guild->getId(), $request->request->get('_token'))) {
            $guildsRepository->remove($guild, true);
        }

        return $this->redirectToRoute('app_guilds_index', [], Response::HTTP_SEE_OTHER);
    }
}

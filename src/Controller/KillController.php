<?php

namespace App\Controller;

use App\Entity\Kill;
use App\Form\KillType;
use App\Repository\KillRepository;
use App\Repository\GuildsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/kill')]
class KillController extends AbstractController
{
    #[Route('/', name: 'app_kill_index', methods: ['GET'])]
    public function index(KillRepository $killRepository): Response
    {
        return $this->render('kill/index.html.twig', [
            'kills' => $killRepository->findAll(),
        ]);
    }

    #[Route('/new/{guild}', name: 'app_kill_new', methods: ['GET', 'POST'])]
    public function new(Request $request, KillRepository $killRepository, GuildsRepository $guildsRepository, SluggerInterface $slugger, $guild): Response
    {
        $kill = new Kill();
        $form = $this->createForm(KillType::class, $kill);
        $form->handleRequest($request);
        $guild = $guildsRepository->find($guild);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('picture')->getData();
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();
                $imageFile->move(
                    $this->getParameter('images_kill'),
                    $newFilename
                );
                $kill->setGuild($guild);
                $kill->setAlive(false);
                $kill->setPicture($newFilename);
                $killRepository->save($kill, true);

                return $this->redirectToRoute('main', [], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->renderForm('kill/new.html.twig', [
            'kill' => $kill,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_kill_show', methods: ['GET'])]
    public function show(Kill $kill): Response
    {
        return $this->render('kill/show.html.twig', [
            'kill' => $kill,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_kill_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Kill $kill, KillRepository $killRepository, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(KillType::class, $kill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('picture')->getData();
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();
                $imageFile->move(
                    $this->getParameter('images_kill'),
                    $newFilename
                );
                $kill->setPicture($newFilename);
                $killRepository->save($kill, true);

                return $this->redirectToRoute('main', [], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->renderForm('kill/edit.html.twig', [
            'kill' => $kill,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_kill_delete', methods: ['POST'])]
    public function delete(Request $request, Kill $kill, KillRepository $killRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $kill->getId(), $request->request->get('_token'))) {
            $killRepository->remove($kill, true);
        }

        return $this->redirectToRoute('app_kill_index', [], Response::HTTP_SEE_OTHER);
    }
}

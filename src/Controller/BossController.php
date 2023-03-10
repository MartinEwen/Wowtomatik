<?php

namespace App\Controller;

use App\Entity\Boss;
use App\Form\BossType;
use App\Repository\BossRepository;
use App\Repository\InstancesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/boss')]
class BossController extends AbstractController
{
    #[Route('/', name: 'app_boss_index', methods: ['GET'])]
    public function index(BossRepository $bossRepository, InstancesRepository $instancesRepository): Response
    {
        return $this->render('boss/index.html.twig', [
            'bosses' => $bossRepository->findAll(),
            'instances' => $instancesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_boss_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BossRepository $bossRepository, SluggerInterface $slugger): Response
    {
        $boss = new Boss();
        $form = $this->createForm(BossType::class, $boss);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('imgBoss')->getData();
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();
                $imageFile->move(
                    $this->getParameter('images_boss'),
                    $newFilename
                );
                $boss->setImgBoss($newFilename);
                $bossRepository->save($boss, true);

                return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->renderForm('boss/new.html.twig', [
            'boss' => $boss,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_boss_show', methods: ['GET'])]
    public function show(Boss $boss): Response
    {
        return $this->render('boss/show.html.twig', [
            'boss' => $boss,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_boss_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Boss $boss, BossRepository $bossRepository, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(BossType::class, $boss);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('imgBoss')->getData();
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();
                $imageFile->move(
                    $this->getParameter('images_boss'),
                    $newFilename
                );
                $boss->setImgBoss($newFilename);
                $bossRepository->save($boss, true);

                return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->renderForm('boss/edit.html.twig', [
            'boss' => $boss,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_boss_delete', methods: ['POST'])]
    public function delete(Request $request, Boss $boss, BossRepository $bossRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $boss->getId(), $request->request->get('_token'))) {
            $bossRepository->remove($boss, true);
        }

        return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
    }
}

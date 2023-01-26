<?php

namespace App\Controller;

use App\Entity\Applicant;
use App\Form\ApplicantType;
use App\Repository\GuildsRepository;
use App\Repository\ApplicantRepository;
use App\Repository\CharactersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/applicant')]
class ApplicantController extends AbstractController
{
    #[Route('/', name: 'app_applicant_index', methods: ['GET'])]
    public function index(ApplicantRepository $applicantRepository, CharactersRepository $characterRepository, GuildsRepository $guildsRepository): Response
    {
        return $this->render('applicant/index.html.twig', [
            'applicants' => $applicantRepository->findAll(),
            'guilds' => $guildsRepository->findAll(),
            'characters' => $characterRepository->findAll(),
        ]);
    }

    #[Route('/new/{id}/{character}', name: 'app_applicant_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CharactersRepository $characterRepository, GuildsRepository $guildsRepository, ApplicantRepository $applicantRepository, $character, $id): Response
    {
        $applicant = new Applicant();
        $form = $this->createForm(ApplicantType::class, $applicant);
        $form->handleRequest($request);
        $guild = $guildsRepository->find($id);
        $character = $characterRepository->find($character);
        $applicant->setGuild($guild);
        $applicant->setCharacters($character);
        $applicant->setAccept(true);
        $applicantRepository->save($applicant, true);
        return $this->redirectToRoute('main', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}', name: 'app_applicant_show', methods: ['GET'])]
    public function show(Applicant $applicant): Response
    {
        return $this->render('applicant/show.html.twig', [
            'applicant' => $applicant,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_applicant_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Applicant $applicant, ApplicantRepository $applicantRepository): Response
    {
        $form = $this->createForm(ApplicantType::class, $applicant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $applicantRepository->save($applicant, true);

            return $this->redirectToRoute('app_applicant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('applicant/edit.html.twig', [
            'applicant' => $applicant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_applicant_delete', methods: ['POST'])]
    public function delete(Request $request, Applicant $applicant, ApplicantRepository $applicantRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $applicant->getId(), $request->request->get('_token'))) {
            $applicantRepository->remove($applicant, true);
        }

        return $this->redirectToRoute('main', [], Response::HTTP_SEE_OTHER);
    }
}

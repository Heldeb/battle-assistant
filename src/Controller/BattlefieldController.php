<?php

namespace App\Controller;

use App\Entity\Battlefield;
use App\Form\BattlefieldType;
use App\Repository\BattlefieldRepository;
use App\Security\Voter\BattlefieldVoter;
use App\Security\Voter\ScenarioVoter;
use App\Service\BattlefieldService;
use App\Service\ScenarioService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// ========== BATTLEFIELD_VIEW ==========
#[Route('/battlefield')]
final class BattlefieldController extends AbstractController
{
    #[Route(name: 'app_battlefield_index', methods: ['GET'])]
    public function index(BattlefieldRepository $battlefieldRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('battlefield/index.html.twig', [
            'battlefields' => $battlefieldRepository->findAll(),
        ]);
    }


    // ========== BATTLEFIELD_CREATE ==========

    #[Route('/new', name: 'app_battlefield_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BattlefieldService $battlefieldService): Response
    {

        $this->denyAccessUnlessGranted(
            BattlefieldVoter::BATTLEFIELD_CREATE
        );

        $battlefield = new Battlefield();
        $form = $this->createForm(BattlefieldType::class, $battlefield);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $battlefieldService->create($battlefield);
            return $this->redirectToRoute('app_battlefield_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('battlefield/new.html.twig', [
            'battlefield' => $battlefield,
            'form' => $form,
        ]);
    }

    // ========== BATTLEFIELD_SHOW ==========

    #[Route('/{id}', name: 'app_battlefield_show', methods: ['GET'])]
    public function show(Battlefield $battlefield): Response
    {
        return $this->render('battlefield/show.html.twig', [
            'battlefield' => $battlefield,
        ]);
    }


    // ========== BATTLEFIELD_EDIT ==========

    #[Route('/{id}/edit', name: 'app_battlefield_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Battlefield $battlefield, BattlefieldService $battlefieldService): Response
    {
        $this->denyAccessUnlessGranted(BattlefieldVoter::BATTLEFIELD_EDIT, $battlefield);
        $form = $this->createForm(BattlefieldType::class, $battlefield);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $battlefieldService->update($battlefield);

            return $this->redirectToRoute('app_battlefield_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('battlefield/edit.html.twig', [
            'battlefield' => $battlefield,
            'form' => $form,
        ]);
    }

    // ========== BATTLEFIELD_DELETE ==========

    #[Route('/{id}', name: 'app_battlefield_delete', methods: ['POST'])]
    public function delete(Request $request, Battlefield $battlefield, BattlefieldService $battlefieldService): Response
    {

        $this->denyAccessUnlessGranted(BattlefieldVoter::BATTLEFIELD_DELETE, $battlefield);

        if ($this->isCsrfTokenValid('delete' . $battlefield->getId(), $request->getPayload()->getString('_token'))) {
            $battlefieldService->delete($battlefield);
        }

        return $this->redirectToRoute('app_battlefield_index', [], Response::HTTP_SEE_OTHER);
    }
}

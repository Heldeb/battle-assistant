<?php

namespace App\Controller;

use App\Entity\ExpansionPack;
use App\Form\ExpansionPack1Type;
use App\Repository\ExpansionPackRepository;
use App\Security\Voter\ExpansionPackVoter;
use App\Service\ExpansionPackService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// ========== EXPANSION_PACK_VIEW ==========

#[Route('/expansion/pack')]
final class ExpansionPackController extends AbstractController
{
    #[Route(name: 'app_expansion_pack_index', methods: ['GET'])]
    public function index(ExpansionPackRepository $expansionPackRepository): Response
    {

        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('expansion_pack/index.html.twig', [
            'expansion_packs' => $expansionPackRepository->findAll(),
        ]);
    }

    // ========== EXPANSION_PACK_CREATE ==========

    #[Route('/new', name: 'app_expansion_pack_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ExpansionPackService $expansionPackService): Response
    {

        $this->denyAccessUnlessGranted(
            ExpansionPackVoter::EXPANSION_PACK_CREATE
        );

        $expansionPack = new ExpansionPack();
        $form = $this->createForm(ExpansionPack1Type::class, $expansionPack);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $expansionPackService->create($expansionPack);
            return $this->redirectToRoute('app_expansion_pack_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('expansion_pack/new.html.twig', [
            'expansion_pack' => $expansionPack,
            'form' => $form,
        ]);
    }

    // ========== EXPANSION_PACK_SHOW ==========

    #[Route('/{id}', name: 'app_expansion_pack_show', methods: ['GET'])]
    public function show(ExpansionPack $expansionPack): Response
    {
        return $this->render('expansion_pack/show.html.twig', [
            'expansion_pack' => $expansionPack,
        ]);
    }

    // ========== EXPANSION_PACK_EDIT ==========

    #[Route('/{id}/edit', name: 'app_expansion_pack_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ExpansionPack $expansionPack, ExpansionPackService $expansionPackService): Response
    {
        $this->denyAccessUnlessGranted(ExpansionPackVoter::EXPANSION_PACK_EDIT, $expansionPack);
        $form = $this->createForm(ExpansionPack1Type::class, $expansionPack);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $expansionPackService->update($expansionPack);

            return $this->redirectToRoute('app_expansion_pack_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('expansion_pack/edit.html.twig', [
            'expansion_pack' => $expansionPack,
            'form' => $form,
        ]);
    }

    // ========== EXPANSION_PACK_DELETE ==========

    #[Route('/{id}', name: 'app_expansion_pack_delete', methods: ['POST'])]
    public function delete(Request $request, ExpansionPack $expansionPack, ExpansionPackService $expansionPackService): Response
    {
        $this->denyAccessUnlessGranted(ExpansionPackVoter::EXPANSION_PACK_DELETE, $expansionPack);

        if ($this->isCsrfTokenValid('delete' . $expansionPack->getId(), $request->getPayload()->getString('_token'))) {
            $expansionPackService->delete($expansionPack);;
        }

        return $this->redirectToRoute('app_expansion_pack_index', [], Response::HTTP_SEE_OTHER);
    }
}

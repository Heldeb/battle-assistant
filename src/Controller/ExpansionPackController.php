<?php

namespace App\Controller;

use App\Entity\ExpansionPack;
use App\Form\ExpansionPack1Type;
use App\Repository\ExpansionPackRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/expansion/pack')]
final class ExpansionPackController extends AbstractController
{
    #[Route(name: 'app_expansion_pack_index', methods: ['GET'])]
    public function index(ExpansionPackRepository $expansionPackRepository): Response
    {
        return $this->render('expansion_pack/index.html.twig', [
            'expansion_packs' => $expansionPackRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_expansion_pack_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $expansionPack = new ExpansionPack();
        $form = $this->createForm(ExpansionPack1Type::class, $expansionPack);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($expansionPack);
            $entityManager->flush();

            return $this->redirectToRoute('app_expansion_pack_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('expansion_pack/new.html.twig', [
            'expansion_pack' => $expansionPack,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_expansion_pack_show', methods: ['GET'])]
    public function show(ExpansionPack $expansionPack): Response
    {
        return $this->render('expansion_pack/show.html.twig', [
            'expansion_pack' => $expansionPack,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_expansion_pack_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ExpansionPack $expansionPack, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ExpansionPack1Type::class, $expansionPack);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_expansion_pack_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('expansion_pack/edit.html.twig', [
            'expansion_pack' => $expansionPack,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_expansion_pack_delete', methods: ['POST'])]
    public function delete(Request $request, ExpansionPack $expansionPack, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$expansionPack->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($expansionPack);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_expansion_pack_index', [], Response::HTTP_SEE_OTHER);
    }
}

<?php

namespace App\Controller;

use App\Entity\Battlefield;
use App\Form\BattlefieldType;
use App\Repository\BattlefieldRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/battlefield')]
final class BattlefieldController extends AbstractController
{
    #[Route(name: 'app_battlefield_index', methods: ['GET'])]
    public function index(BattlefieldRepository $battlefieldRepository): Response
    {
        return $this->render('battlefield/index.html.twig', [
            'battlefields' => $battlefieldRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_battlefield_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $battlefield = new Battlefield();
        $form = $this->createForm(BattlefieldType::class, $battlefield);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($battlefield);
            $entityManager->flush();

            return $this->redirectToRoute('app_battlefield_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('battlefield/new.html.twig', [
            'battlefield' => $battlefield,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_battlefield_show', methods: ['GET'])]
    public function show(Battlefield $battlefield): Response
    {
        return $this->render('battlefield/show.html.twig', [
            'battlefield' => $battlefield,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_battlefield_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Battlefield $battlefield, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BattlefieldType::class, $battlefield);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_battlefield_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('battlefield/edit.html.twig', [
            'battlefield' => $battlefield,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_battlefield_delete', methods: ['POST'])]
    public function delete(Request $request, Battlefield $battlefield, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$battlefield->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($battlefield);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_battlefield_index', [], Response::HTTP_SEE_OTHER);
    }
}

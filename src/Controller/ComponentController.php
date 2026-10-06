<?php

namespace App\Controller;

use App\Entity\Component;
use App\Form\ComponentType;
use App\Repository\ComponentRepository;
use App\Security\Voter\ComponentVoter;
use App\Service\ComponentService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// ========== COMPONENT_VIEW ==========

#[Route('/component')]
final class ComponentController extends AbstractController
{
    #[Route(name: 'app_component_index', methods: ['GET'])]
    public function index(ComponentRepository $componentRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('component/index.html.twig', [
            'components' => $componentRepository->findAll(),
        ]);
    }


    // ========== COMPONENT_CREATE ==========

    #[Route('/new', name: 'app_component_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ComponentService $componentService): Response
    {
        $this->denyAccessUnlessGranted(
            ComponentVoter::COMPONENT_CREATE
        );
        $component = new Component();
        $form = $this->createForm(ComponentType::class, $component);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $componentService->create($component);
            return $this->redirectToRoute('app_component_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('component/new.html.twig', [
            'component' => $component,
            'form' => $form,
        ]);
    }

    // ========== COMPONENT_SHOW ==========

    #[Route('/{id}', name: 'app_component_show', methods: ['GET'])]
    public function show(Component $component): Response
    {
        return $this->render('component/show.html.twig', [
            'component' => $component,
        ]);
    }

    // ========== COMPONENT_EDIT ==========

    #[Route('/{id}/edit', name: 'app_component_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Component $component, ComponentService $componentService): Response
    {

        $this->denyAccessUnlessGranted(ComponentVoter::COMPONENT_EDIT, $component);
        $form = $this->createForm(ComponentType::class, $component);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $componentService->update($component);
            return $this->redirectToRoute('app_component_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('component/edit.html.twig', [
            'component' => $component,
            'form' => $form,
        ]);
    }

    // ========== COMPONENT_DELETE ==========

    #[Route('/{id}', name: 'app_component_delete', methods: ['POST'])]
    public function delete(Request $request, Component $component, ComponentService $componentService): Response
    {

        $this->denyAccessUnlessGranted(ComponentVoter::COMPONENT_DELETE, $component);

        if ($this->isCsrfTokenValid('delete' . $component->getId(), $request->getPayload()->getString('_token'))) {
            $componentService->delete($component);
        }

        return $this->redirectToRoute('app_component_index', [], Response::HTTP_SEE_OTHER);
    }
}

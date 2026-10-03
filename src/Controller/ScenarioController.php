<?php

namespace App\Controller;

use App\Entity\Scenario;
use App\Form\ScenarioType;
use App\Repository\ScenarioRepository;
use App\Security\Voter\ScenarioVoter;
use App\Service\ScenarioService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// ========== VIEW ==========
#[Route('/scenario')]
final class ScenarioController extends AbstractController
{
    #[Route(name: 'app_scenario_index', methods: ['GET'])]
    public function index(ScenarioRepository $scenarioRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('scenario/index.html.twig', [
            'scenarios' => $scenarioRepository->findAll(),
        ]);
    }

    // ========== SCENARIO_CREATE ==========

    #[Route('/new', name: 'app_scenario_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ScenarioService $scenarioService): Response
    {

        $this->denyAccessUnlessGranted(
            ScenarioVoter::SCENARIO_CREATE
        );

        $scenario = new Scenario();
        $form = $this->createForm(ScenarioType::class, $scenario);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $scenarioService->create($scenario);

            return $this->redirectToRoute('app_scenario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('scenario/new.html.twig', [
            'scenario' => $scenario,
            'form' => $form,
        ]);
    }

    // ========== SCENARIO_SHOW ==========

    #[Route('/{id}', name: 'app_scenario_show', methods: ['GET'])]
    public function show(Scenario $scenario): Response
    {
        return $this->render('scenario/show.html.twig', [
            'scenario' => $scenario,
        ]);
    }

    // ========== SCENARIO_EDIT ==========

    #[Route('/{id}/edit', name: 'app_scenario_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Scenario $scenario, ScenarioService $scenarioService): Response
    {
        $this->denyAccessUnlessGranted(ScenarioVoter::SCENARIO_EDIT, $scenario);
        $form = $this->createForm(ScenarioType::class, $scenario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $scenarioService->update($scenario);

            return $this->redirectToRoute('app_scenario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('scenario/edit.html.twig', [
            'scenario' => $scenario,
            'form' => $form,
        ]);
    }

    // ========== SCENARIO_DELETE ==========

    #[Route('/{id}', name: 'app_scenario_delete', methods: ['POST'])]
    public function delete(Request $request, Scenario $scenario, ScenarioService $scenarioService): Response
    {

        $this->denyAccessUnlessGranted(ScenarioVoter::SCENARIO_DELETE, $scenario);

        if ($this->isCsrfTokenValid('delete' . $scenario->getId(), $request->getPayload()->getString('_token'))) {
            $scenarioService->delete($scenario);
        }

        return $this->redirectToRoute('app_scenario_index', [], Response::HTTP_SEE_OTHER);
    }
}

<?php

namespace App\Controller;

use App\Entity\Rule;
use App\Form\Rule1Type;
use App\Repository\RuleRepository;
use App\Security\Voter\RuleVoter;
use App\Service\RuleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// ========== RULE_VIEW ==========

#[Route('/rule')]
final class RuleController extends AbstractController
{
    #[Route(name: 'app_rule_index', methods: ['GET'])]
    public function index(RuleRepository $ruleRepository): Response
    {

        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('rule/index.html.twig', [
            'rules' => $ruleRepository->findAll(),
        ]);
    }

    // ========== RULE_CREATE ==========

    #[Route('/new', name: 'app_rule_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RuleService $ruleService): Response
    {
        $this->denyAccessUnlessGranted(
            RuleVoter::RULE_CREATE
        );

        $rule = new Rule();
        $form = $this->createForm(Rule1Type::class, $rule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ruleService->create($rule);
            return $this->redirectToRoute('app_rule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('rule/new.html.twig', [
            'rule' => $rule,
            'form' => $form,
        ]);
    }

    // ========== RULE_SHOW ==========

    #[Route('/{id}', name: 'app_rule_show', methods: ['GET'])]
    public function show(Rule $rule): Response
    {
        return $this->render('rule/show.html.twig', [
            'rule' => $rule,
        ]);
    }

    // ========== RULE_EDIT ==========

    #[Route('/{id}/edit', name: 'app_rule_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Rule $rule, RuleService $ruleService): Response
    {
        $this->denyAccessUnlessGranted(RuleVoter::RULE_EDIT, $rule);
        $form = $this->createForm(Rule1Type::class, $rule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ruleService->update($rule);

            return $this->redirectToRoute('app_rule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('rule/edit.html.twig', [
            'rule' => $rule,
            'form' => $form,
        ]);
    }
    // ========== RULE_DELETE ==========

    #[Route('/{id}', name: 'app_rule_delete', methods: ['POST'])]
    public function delete(Request $request, Rule $rule, RuleService $ruleService): Response
    {
        $this->denyAccessUnlessGranted(RuleVoter::RULE_DELETE, $rule);

        if ($this->isCsrfTokenValid('delete' . $rule->getId(), $request->getPayload()->getString('_token'))) {
            $ruleService->delete($rule);
        }

        return $this->redirectToRoute('app_rule_index', [], Response::HTTP_SEE_OTHER);
    }
}

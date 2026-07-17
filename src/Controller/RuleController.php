<?php

namespace App\Controller;

use App\Entity\Rule;
use App\Form\Rule1Type;
use App\Repository\RuleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/rule')]
final class RuleController extends AbstractController
{
    #[Route(name: 'app_rule_index', methods: ['GET'])]
    public function index(RuleRepository $ruleRepository): Response
    {
        return $this->render('rule/index.html.twig', [
            'rules' => $ruleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_rule_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $rule = new Rule();
        $form = $this->createForm(Rule1Type::class, $rule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($rule);
            $entityManager->flush();

            return $this->redirectToRoute('app_rule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('rule/new.html.twig', [
            'rule' => $rule,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rule_show', methods: ['GET'])]
    public function show(Rule $rule): Response
    {
        return $this->render('rule/show.html.twig', [
            'rule' => $rule,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_rule_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Rule $rule, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Rule1Type::class, $rule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_rule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('rule/edit.html.twig', [
            'rule' => $rule,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rule_delete', methods: ['POST'])]
    public function delete(Request $request, Rule $rule, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rule->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($rule);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_rule_index', [], Response::HTTP_SEE_OTHER);
    }
}

<?php

namespace App\Service;

use App\Entity\Rule;
use Doctrine\ORM\EntityManagerInterface;

class RuleService
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function create(Rule $rule): void
    {
        $this->entityManager->persist($rule);
        $this->entityManager->flush();
    }

    public function update(Rule $rule): void
    {
        $this->entityManager->flush();
    }

    public function delete(Rule $rule): void
    {
        $this->entityManager->remove($rule);
        $this->entityManager->flush();
    }
}

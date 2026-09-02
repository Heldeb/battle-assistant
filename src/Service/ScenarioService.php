<?php

namespace App\Service;

use App\Entity\Scenario;
use Doctrine\ORM\EntityManagerInterface;

class ScenarioService
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function create(Scenario $scenario): void
    {
        $this->entityManager->persist($scenario);
        $this->entityManager->flush();
    }

    public function update(Scenario $scenario): void
    {
        $this->entityManager->flush();
    }

    public function delete(Scenario $scenario): void
    {
        $this->entityManager->remove($scenario);
        $this->entityManager->flush();
    }
}
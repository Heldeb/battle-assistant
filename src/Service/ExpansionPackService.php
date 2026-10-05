<?php

namespace App\Service;

use App\Entity\ExpansionPack;
use Doctrine\ORM\EntityManagerInterface;

class ExpansionPackService
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function create(ExpansionPack $expansionPack): void
    {
        $this->entityManager->persist($expansionPack);
        $this->entityManager->flush();
    }

    public function update(ExpansionPack $expansionPack): void
    {
        $this->entityManager->flush();
    }

    public function delete(ExpansionPack $expansionPack): void
    {
        $this->entityManager->remove($expansionPack);
        $this->entityManager->flush();
    }
}

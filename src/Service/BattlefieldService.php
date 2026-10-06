<?php

namespace App\Service;

use App\Entity\Battlefield;
use Doctrine\ORM\EntityManagerInterface;

class BattlefieldService
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function create(Battlefield $battlefield): void
    {
        $this->entityManager->persist($battlefield);
        $this->entityManager->flush();
    }

    public function update(Battlefield $battlefield): void
    {
        $this->entityManager->flush();
    }

    public function delete(Battlefield $battlefield): void
    {
        $this->entityManager->remove($battlefield);
        $this->entityManager->flush();
    }
}

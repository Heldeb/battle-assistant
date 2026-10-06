<?php

namespace App\Service;

use App\Entity\Component;
use Doctrine\ORM\EntityManagerInterface;

class ComponentService
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function create(Component $component): void
    {
        $this->entityManager->persist($component);
        $this->entityManager->flush();
    }

    public function update(Component $component): void
    {
        $this->entityManager->flush();
    }

    public function delete(Component $component): void
    {
        $this->entityManager->remove($component);
        $this->entityManager->flush();
    }
}

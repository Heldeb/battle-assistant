<?php

namespace App\Entity;

use App\Repository\ComponentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComponentRepository::class)]
class Component
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $component_name = null;

    #[ORM\Column(length: 50)]
    private ?string $component_type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComponentName(): ?string
    {
        return $this->component_name;
    }

    public function setComponentName(string $component_name): static
    {
        $this->component_name = $component_name;

        return $this;
    }

    public function getComponentType(): ?string
    {
        return $this->component_type;
    }

    public function setComponentType(string $component_type): static
    {
        $this->component_type = $component_type;

        return $this;
    }
}

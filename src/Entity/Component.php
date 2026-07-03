<?php

namespace App\Entity;

use App\Repository\ComponentRepository;
use Doctrine\DBAL\Types\Types;
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

    #[ORM\ManyToOne(inversedBy: 'components')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ExpansionPack $expansion_pack = null;

    #[ORM\Column(length: 50)]
    private ?string $subcategory = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $movement_rules = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $attack_rules = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $protection_rules = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $line_of_sight_rules = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $component_icon = null;

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

    public function getExpansionPack(): ?ExpansionPack
    {
        return $this->expansion_pack;
    }

    public function setExpansionPack(?ExpansionPack $expansion_pack): static
    {
        $this->expansion_pack = $expansion_pack;

        return $this;
    }

    public function getSubcategory(): ?string
    {
        return $this->subcategory;
    }

    public function setSubcategory(string $subcategory): static
    {
        $this->subcategory = $subcategory;

        return $this;
    }

    public function getMovementRules(): ?string
    {
        return $this->movement_rules;
    }

    public function setMovementRules(string $movement_rules): static
    {
        $this->movement_rules = $movement_rules;

        return $this;
    }

    public function getAttackRules(): ?string
    {
        return $this->attack_rules;
    }

    public function setAttackRules(string $attack_rules): static
    {
        $this->attack_rules = $attack_rules;

        return $this;
    }

    public function getProtectionRules(): ?string
    {
        return $this->protection_rules;
    }

    public function setProtectionRules(string $protection_rules): static
    {
        $this->protection_rules = $protection_rules;

        return $this;
    }

    public function getLineOfSightRules(): ?string
    {
        return $this->line_of_sight_rules;
    }

    public function setLineOfSightRules(string $line_of_sight_rules): static
    {
        $this->line_of_sight_rules = $line_of_sight_rules;

        return $this;
    }

    public function getComponentIcon(): ?string
    {
        return $this->component_icon;
    }

    public function setComponentIcon(string $component_icon): static
    {
        $this->component_icon = $component_icon;

        return $this;
    }
}

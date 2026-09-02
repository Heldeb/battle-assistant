<?php

namespace App\Entity;

use App\Repository\ComponentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private ?string $component_subcategory = null;

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

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $component_side = null;

    /**
     * @var Collection<int, Battlefield>
     */
    #[ORM\ManyToMany(targetEntity: Battlefield::class, mappedBy: 'component')]
    private Collection $battlefields;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $component_description = null;

    public function __construct()
    {
        $this->battlefields = new ArrayCollection();
    }

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

    public function getComponentSubcategory(): ?string
    {
        return $this->component_subcategory;
    }

    public function setComponentSubcategory(string $component_subcategory): static
    {
        $this->component_subcategory = $component_subcategory;

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

    public function getComponentSide(): ?string
    {
        return $this->component_side;
    }

    public function setComponentSide(?string $component_side): static
    {
        $this->component_side = $component_side;

        return $this;
    }

    /**
     * @return Collection<int, Battlefield>
     */
    public function getBattlefields(): Collection
    {
        return $this->battlefields;
    }

    public function addBattlefield(Battlefield $battlefield): static
    {
        if (!$this->battlefields->contains($battlefield)) {
            $this->battlefields->add($battlefield);
            $battlefield->addComponent($this);
        }

        return $this;
    }

    public function removeBattlefield(Battlefield $battlefield): static
    {
        if ($this->battlefields->removeElement($battlefield)) {
            $battlefield->removeComponent($this);
        }

        return $this;
    }

    public function getComponentDescription(): ?string
    {
        return $this->component_description;
    }

    public function setComponentDescription(?string $component_description): static
    {
        $this->component_description = $component_description;

        return $this;
    }
}
<?php

namespace App\Entity;

use App\Repository\ExpansionPackRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExpansionPackRepository::class)]
class ExpansionPack
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $expansion_pack_name = null;

    /**
     * @var Collection<int, Scenario>
     */
    #[ORM\OneToMany(targetEntity: Scenario::class, mappedBy: 'expansionPack')]
    private Collection $scenario;

    /**
     * @var Collection<int, Component>
     */
    #[ORM\OneToMany(targetEntity: Component::class, mappedBy: 'expansion_pack')]
    private Collection $components;

    public function __construct()
    {
        $this->scenario = new ArrayCollection();
        $this->components = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExpansionPackName(): ?string
    {
        return $this->expansion_pack_name;
    }

    public function setExpansionPackName(string $expansion_pack_name): static
    {
        $this->expansion_pack_name = $expansion_pack_name;

        return $this;
    }

    /**
     * @return Collection<int, Scenario>
     */
    public function getScenario(): Collection
    {
        return $this->scenario;
    }

    public function addScenario(Scenario $scenario): static
    {
        if (!$this->scenario->contains($scenario)) {
            $this->scenario->add($scenario);
            $scenario->setExpansionPack($this);
        }

        return $this;
    }

    public function removeScenario(Scenario $scenario): static
    {
        if ($this->scenario->removeElement($scenario)) {
            // set the owning side to null (unless already changed)
            if ($scenario->getExpansionPack() === $this) {
                $scenario->setExpansionPack(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Component>
     */
    public function getComponents(): Collection
    {
        return $this->components;
    }

    public function addComponent(Component $component): static
    {
        if (!$this->components->contains($component)) {
            $this->components->add($component);
            $component->setExpansionPack($this);
        }

        return $this;
    }

    public function removeComponent(Component $component): static
    {
        if ($this->components->removeElement($component)) {
            // set the owning side to null (unless already changed)
            if ($component->getExpansionPack() === $this) {
                $component->setExpansionPack(null);
            }
        }

        return $this;
    }
}

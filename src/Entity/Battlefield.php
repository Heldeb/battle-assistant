<?php

namespace App\Entity;

use App\Repository\BattlefieldRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BattlefieldRepository::class)]
class Battlefield
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $battlefield_type = null;

    #[ORM\ManyToOne(inversedBy: 'battlefields')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ExpansionPack $expansion_pack = null;

    /**
     * @var Collection<int, Scenario>
     */
    #[ORM\OneToMany(targetEntity: Scenario::class, mappedBy: 'battlefield')]
    private Collection $scenario;

    /**
     * @var Collection<int, Component>
     */
    #[ORM\ManyToMany(targetEntity: Component::class, inversedBy: 'battlefields')]
    private Collection $component;

    public function __construct()
    {
        $this->scenario = new ArrayCollection();
        $this->component = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBattlefieldType(): ?string
    {
        return $this->battlefield_type;
    }

    public function setBattlefieldType(string $battlefield_type): static
    {
        $this->battlefield_type = $battlefield_type;

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
            $scenario->setBattlefield($this);
        }

        return $this;
    }

    public function removeScenario(Scenario $scenario): static
    {
        if ($this->scenario->removeElement($scenario)) {
            // set the owning side to null (unless already changed)
            if ($scenario->getBattlefield() === $this) {
                $scenario->setBattlefield(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Component>
     */
    public function getComponent(): Collection
    {
        return $this->component;
    }

    public function addComponent(Component $component): static
    {
        if (!$this->component->contains($component)) {
            $this->component->add($component);
        }

        return $this;
    }

    public function removeComponent(Component $component): static
    {
        $this->component->removeElement($component);

        return $this;
    }
}

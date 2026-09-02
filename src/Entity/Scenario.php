<?php

namespace App\Entity;

use App\Repository\ScenarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScenarioRepository::class)]
class Scenario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $scenario_name = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $medal_count = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $historical_description = null;

    /**
     * @var Collection<int, PlayedGames>
     */
    #[ORM\OneToMany(targetEntity: PlayedGames::class, mappedBy: 'scenario')]
    private Collection $playedGames;

    #[ORM\ManyToOne(inversedBy: 'scenario')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ExpansionPack $expansionPack = null;

    #[ORM\ManyToOne(inversedBy: 'scenario')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Battlefield $battlefield = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $victory_condition = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date_of_the_battle = null;

    #[ORM\ManyToOne]
    private ?User $user = null;

    public function __construct()
    {
        $this->playedGames = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScenarioName(): ?string
    {
        return $this->scenario_name;
    }

    public function setScenarioName(string $scenario_name): static
    {
        $this->scenario_name = $scenario_name;

        return $this;
    }

    public function getMedalCount(): ?int
    {
        return $this->medal_count;
    }

    public function setMedalCount(int $medal_count): static
    {
        $this->medal_count = $medal_count;

        return $this;
    }

    public function getHistoricalDescription(): ?string
    {
        return $this->historical_description;
    }

    public function setHistoricalDescription(string $historical_description): static
    {
        $this->historical_description = $historical_description;

        return $this;
    }

    /**
     * @return Collection<int, PlayedGames>
     */
    public function getPlayedGames(): Collection
    {
        return $this->playedGames;
    }

    public function addPlayedGame(PlayedGames $playedGame): static
    {
        if (!$this->playedGames->contains($playedGame)) {
            $this->playedGames->add($playedGame);
            $playedGame->setScenario($this);
        }

        return $this;
    }

    public function removePlayedGame(PlayedGames $playedGame): static
    {
        if ($this->playedGames->removeElement($playedGame)) {
            // set the owning side to null (unless already changed)
            if ($playedGame->getScenario() === $this) {
                $playedGame->setScenario(null);
            }
        }

        return $this;
    }

    public function getExpansionPack(): ?ExpansionPack
    {
        return $this->expansionPack;
    }

    public function setExpansionPack(?ExpansionPack $expansionPack): static
    {
        $this->expansionPack = $expansionPack;

        return $this;
    }

    public function getBattlefield(): ?Battlefield
    {
        return $this->battlefield;
    }

    public function setBattlefield(?Battlefield $battlefield): static
    {
        $this->battlefield = $battlefield;

        return $this;
    }

    public function getVictoryCondition(): ?string
    {
        return $this->victory_condition;
    }

    public function setVictoryCondition(string $victory_condition): static
    {
        $this->victory_condition = $victory_condition;

        return $this;
    }

    public function getDateOfTheBattle(): ?\DateTime
    {
        return $this->date_of_the_battle;
    }

    public function setDateOfTheBattle(\DateTime $date_of_the_battle): static
    {
        $this->date_of_the_battle = $date_of_the_battle;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
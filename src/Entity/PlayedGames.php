<?php

namespace App\Entity;

use App\Repository\PlayedGamesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayedGamesRepository::class)]
class PlayedGames
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'playedGames')]
    private ?User $User = null;

    #[ORM\ManyToOne(inversedBy: 'playedGames')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Scenario $Scenario = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $first_leg_allies_score = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $first_leg_axies_score = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $second_leg_allies_score = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $second_leg_axies_score = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): static
    {
        $this->User = $User;

        return $this;
    }

    public function getScenario(): ?Scenario
    {
        return $this->Scenario;
    }

    public function setScenario(?Scenario $Scenario): static
    {
        $this->Scenario = $Scenario;

        return $this;
    }

    public function getFirstLegAlliesScore(): ?int
    {
        return $this->first_leg_allies_score;
    }

    public function setFirstLegAlliesScore(?int $first_leg_allies_score): static
    {
        $this->first_leg_allies_score = $first_leg_allies_score;

        return $this;
    }

    public function getFirstLegAxiesScore(): ?int
    {
        return $this->first_leg_axies_score;
    }

    public function setFirstLegAxiesScore(?int $first_leg_axies_score): static
    {
        $this->first_leg_axies_score = $first_leg_axies_score;

        return $this;
    }

    public function getSecondLegAlliesScore(): ?int
    {
        return $this->second_leg_allies_score;
    }

    public function setSecondLegAlliesScore(?int $second_leg_allies_score): static
    {
        $this->second_leg_allies_score = $second_leg_allies_score;

        return $this;
    }

    public function getSecondLegAxiesScore(): ?int
    {
        return $this->second_leg_axies_score;
    }

    public function setSecondLegAxiesScore(?int $second_leg_axies_score): static
    {
        $this->second_leg_axies_score = $second_leg_axies_score;

        return $this;
    }
}

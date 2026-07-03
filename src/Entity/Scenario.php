<?php

namespace App\Entity;

use App\Repository\ScenarioRepository;
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
}

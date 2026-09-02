<?php

namespace App\Entity;

use App\Repository\RuleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RuleRepository::class)]
class Rule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $rule_name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $rule_description = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $rule_step = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $rule_type = null;

    #[ORM\ManyToOne(inversedBy: 'rules')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRuleName(): ?string
    {
        return $this->rule_name;
    }

    public function setRuleName(string $rule_name): static
    {
        $this->rule_name = $rule_name;

        return $this;
    }

    public function getRuleDescription(): ?string
    {
        return $this->rule_description;
    }

    public function setRuleDescription(string $rule_description): static
    {
        $this->rule_description = $rule_description;

        return $this;
    }

    public function getRuleStep(): ?int
    {
        return $this->rule_step;
    }

    public function setRuleStep(?int $rule_step): static
    {
        $this->rule_step = $rule_step;

        return $this;
    }

    public function getRuleType(): ?string
    {
        return $this->rule_type;
    }

    public function setRuleType(?string $rule_type): static
    {
        $this->rule_type = $rule_type;

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
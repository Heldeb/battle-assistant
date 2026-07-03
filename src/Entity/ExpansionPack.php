<?php

namespace App\Entity;

use App\Repository\ExpansionPackRepository;
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
}

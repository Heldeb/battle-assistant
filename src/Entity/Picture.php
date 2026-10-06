<?php

namespace App\Entity;

use App\Repository\PictureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PictureRepository::class)]
class Picture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $file_name = null;

    #[ORM\ManyToOne(inversedBy: 'pictures')]
    private ?ExpansionPack $design = null;

    #[ORM\ManyToOne(inversedBy: 'pictures')]
    private ?Component $component = null;

    #[ORM\ManyToOne(inversedBy: 'pictures')]
    private ?Battlefield $battlefield = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Scenario $scenario = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFileName(): ?string
    {
        return $this->file_name;
    }

    public function setFileName(string $file_name): static
    {
        $this->file_name = $file_name;

        return $this;
    }

    public function getDesign(): ?ExpansionPack
    {
        return $this->design;
    }

    public function setDesign(?ExpansionPack $design): static
    {
        $this->design = $design;

        return $this;
    }

    public function getComponent(): ?Component
    {
        return $this->component;
    }

    public function setComponent(?Component $component): static
    {
        $this->component = $component;

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

    public function getScenario(): ?Scenario
    {
        return $this->scenario;
    }

    public function setScenario(?Scenario $scenario): static
    {
        $this->scenario = $scenario;

        return $this;
    }
}

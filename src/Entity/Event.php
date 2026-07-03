<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $event_name = null;

    #[ORM\Column(length: 50)]
    private ?string $event_type = null;

    #[ORM\Column]
    private ?\DateTime $event_date = null;

    #[ORM\Column(length: 100)]
    private ?string $event_town = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $event_contact = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $event_icon = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'event')]
    private Collection $organization;

    public function __construct()
    {
        $this->organization = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEventName(): ?string
    {
        return $this->event_name;
    }

    public function setEventName(string $event_name): static
    {
        $this->event_name = $event_name;

        return $this;
    }

    public function getEventType(): ?string
    {
        return $this->event_type;
    }

    public function setEventType(string $event_type): static
    {
        $this->event_type = $event_type;

        return $this;
    }

    public function getEventDate(): ?\DateTime
    {
        return $this->event_date;
    }

    public function setEventDate(\DateTime $event_date): static
    {
        $this->event_date = $event_date;

        return $this;
    }

    public function getEventTown(): ?string
    {
        return $this->event_town;
    }

    public function setEventTown(string $event_town): static
    {
        $this->event_town = $event_town;

        return $this;
    }

    public function getEventContact(): ?string
    {
        return $this->event_contact;
    }

    public function setEventContact(string $event_contact): static
    {
        $this->event_contact = $event_contact;

        return $this;
    }

    public function getEventIcon(): ?string
    {
        return $this->event_icon;
    }

    public function setEventIcon(?string $event_icon): static
    {
        $this->event_icon = $event_icon;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getOrganization(): Collection
    {
        return $this->organization;
    }

    public function addOrganization(User $organization): static
    {
        if (!$this->organization->contains($organization)) {
            $this->organization->add($organization);
            $organization->setEvent($this);
        }

        return $this;
    }

    public function removeOrganization(User $organization): static
    {
        if ($this->organization->removeElement($organization)) {
            // set the owning side to null (unless already changed)
            if ($organization->getEvent() === $this) {
                $organization->setEvent(null);
            }
        }

        return $this;
    }
}

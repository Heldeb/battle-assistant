<?php

namespace App\Entity;

use App\Repository\RegistrationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegistrationRepository::class)]
class Registration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'registrations')]
    private ?User $User = null;

    #[ORM\ManyToOne(inversedBy: 'registrations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Event $Event = null;

    #[ORM\Column]
    private ?\DateTime $registration_date = null;

    #[ORM\Column]
    private ?bool $confirmed_registration = null;

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

    public function getEvent(): ?Event
    {
        return $this->Event;
    }

    public function setEvent(?Event $Event): static
    {
        $this->Event = $Event;

        return $this;
    }

    public function getRegistrationDate(): ?\DateTime
    {
        return $this->registration_date;
    }

    public function setRegistrationDate(\DateTime $registration_date): static
    {
        $this->registration_date = $registration_date;

        return $this;
    }

    public function isConfirmedRegistration(): ?bool
    {
        return $this->confirmed_registration;
    }

    public function setConfirmedRegistration(bool $confirmed_registration): static
    {
        $this->confirmed_registration = $confirmed_registration;

        return $this;
    }
}

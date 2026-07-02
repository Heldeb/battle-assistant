<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class Utilisateur implements UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(
        min: 3,
        max: 50,
        minMessage: "Le pseudo doit contenir au moins {{ limit }} caractères",
        maxMessage: "Le pseudo ne peut pas dépasser {{ limit }} caractères"
    )]
    #[Assert\NotBlank(message: "Le pseudo ne peut pas être vide")]
    private ?string $pseudo_utilisateur = null;



    #[ORM\Column(length: 255)]
    #[Assert\Email(
        message: "L\'adresse renseignée {{ value }} n'est pas valide.",
    )]
    #[Assert\NotBlank(message: "L'adresse email ne peut pas être vide")]
    private ?string $email_utilisateur = null;

    /*
     * @var string The hashed password
     */

    #[ORM\Column(length: 50)]
    #[Assert\Length(
        min: 3,
        max: 50,
        minMessage: "Le mot de passe doit contenir au moins {{ limit }} caractères",
        maxMessage: "Le mot de passe ne peut pas dépasser {{ limit }} caractères"
    )]
    #[Assert\NotBlank(message: "Le mot de passe ne peut pas être vide")]
    #[Assert\Regex(
        pattern: '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z0-9]).+$/',
        message: "Le mot de passe doit contenir une majuscule, une minuscule, un chiffre et un caractère spécial."
    )]
    private ?string $motdepasse_utilisateur = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: "Le nom ne peut pas être vide")]
    private ?string $nom_utilisateur = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: "Le prénom ne peut pas être vide")]
    private ?string $prenom_utilisateur = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "L'adresse ne peut pas être vide")]
    private ?string $adresse_utilisateur = null;

    #[ORM\Column(length: 5)]
    #[Assert\NotBlank(message: "Le code postal ne peut pas être vide")]
    private ?string $codepostal_utilisateur = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: "La ville ne peut pas être vide")]
    private ?string $ville_utilisateur = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $icone_utilisateur = null;

    #[ORM\Column(length: 50)]
    private ?string $role_utilisateur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudoUtilisateur(): ?string
    {
        return $this->pseudo_utilisateur;
    }

    public function setPseudoUtilisateur(string $pseudo_utilisateur): static
    {
        $this->pseudo_utilisateur = $pseudo_utilisateur;

        return $this;
    }

    public function getEmailUtilisateur(): ?string
    {
        return $this->email_utilisateur;
    }

    public function setEmailUtilisateur(string $email_utilisateur): static
    {
        $this->email_utilisateur = $email_utilisateur;

        return $this;
    }

    public function getMotdepasseUtilisateur(): ?string
    {
        return $this->motdepasse_utilisateur;
    }

    public function setMotdepasseUtilisateur(string $motdepasse_utilisateur): static
    {
        $this->motdepasse_utilisateur = $motdepasse_utilisateur;

        return $this;
    }

    public function getNomUtilisateur(): ?string
    {
        return $this->nom_utilisateur;
    }

    public function setNomUtilisateur(string $nom_utilisateur): static
    {
        $this->nom_utilisateur = $nom_utilisateur;

        return $this;
    }

    public function getPrenomUtilisateur(): ?string
    {
        return $this->prenom_utilisateur;
    }

    public function setPrenomUtilisateur(string $prenom_utilisateur): static
    {
        $this->prenom_utilisateur = $prenom_utilisateur;

        return $this;
    }

    public function getAdresseUtilisateur(): ?string
    {
        return $this->adresse_utilisateur;
    }

    public function setAdresseUtilisateur(string $adresse_utilisateur): static
    {
        $this->adresse_utilisateur = $adresse_utilisateur;

        return $this;
    }

    public function getCodepostalUtilisateur(): ?string
    {
        return $this->codepostal_utilisateur;
    }

    public function setCodepostalUtilisateur(string $codepostal_utilisateur): static
    {
        $this->codepostal_utilisateur = $codepostal_utilisateur;

        return $this;
    }

    public function getVilleUtilisateur(): ?string
    {
        return $this->ville_utilisateur;
    }

    public function setVilleUtilisateur(string $ville_utilisateur): static
    {
        $this->ville_utilisateur = $ville_utilisateur;

        return $this;
    }

    public function getIconeUtilisateur(): ?string
    {
        return $this->icone_utilisateur;
    }

    public function setIconeUtilisateur(?string $icone_utilisateur): static
    {
        $this->icone_utilisateur = $icone_utilisateur;

        return $this;
    }

    public function getRoleUtilisateur(): ?string
    {
        return $this->role_utilisateur;
    }

    public function setRoleUtilisateur(string $role_utilisateur): static
    {
        $this->role_utilisateur = $role_utilisateur;

        return $this;
    }
}
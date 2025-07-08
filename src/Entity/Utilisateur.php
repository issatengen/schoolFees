<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $codeUtilisateur = null;

    #[ORM\Column(length: 50)]
    private ?string $nomUtilisateur = null;

    #[ORM\Column(length: 100)]
    private ?string $prenomUtilisateur = null;

    #[ORM\Column(length: 100)]
    private ?string $EmailUtilisateur = null;

    #[ORM\Column(length: 100)]
    private ?string $adresseUtilisateur = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $telephoneUtilisateur = null;

    #[ORM\Column(length: 10)]
    private ?string $passwordUtilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'idRole')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Role $role = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeUtilisateur(): ?string
    {
        return $this->codeUtilisateur;
    }

    public function setCodeUtilisateur(string $codeUtilisateur): static
    {
        $this->codeUtilisateur = $codeUtilisateur;

        return $this;
    }

    public function getNomUtilisateur(): ?string
    {
        return $this->nomUtilisateur;
    }

    public function setNomUtilisateur(string $nomUtilisateur): static
    {
        $this->nomUtilisateur = $nomUtilisateur;

        return $this;
    }

    public function getPrenomUtilisateur(): ?string
    {
        return $this->prenomUtilisateur;
    }

    public function setPrenomUtilisateur(string $prenomUtilisateur): static
    {
        $this->prenomUtilisateur = $prenomUtilisateur;

        return $this;
    }

    public function getEmailUtilisateur(): ?string
    {
        return $this->EmailUtilisateur;
    }

    public function setEmailUtilisateur(string $EmailUtilisateur): static
    {
        $this->EmailUtilisateur = $EmailUtilisateur;

        return $this;
    }

    public function getAdresseUtilisateur(): ?string
    {
        return $this->adresseUtilisateur;
    }

    public function setAdresseUtilisateur(string $adresseUtilisateur): static
    {
        $this->adresseUtilisateur = $adresseUtilisateur;

        return $this;
    }

    public function getTelephoneUtilisateur(): ?string
    {
        return $this->telephoneUtilisateur;
    }

    public function setTelephoneUtilisateur(?string $telephoneUtilisateur): static
    {
        $this->telephoneUtilisateur = $telephoneUtilisateur;

        return $this;
    }

    public function getPasswordUtilisateur(): ?string
    {
        return $this->passwordUtilisateur;
    }

    public function setPasswordUtilisateur(string $passwordUtilisateur): static
    {
        $this->passwordUtilisateur = $passwordUtilisateur;

        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): static
    {
        $this->role = $role;

        return $this;
    }
}

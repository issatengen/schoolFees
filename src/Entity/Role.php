<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
class Role
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $codeRole = null;

    #[ORM\Column(length: 30)]
    private ?string $libelleRole = null;

    /**
     * @var Collection<int, Utilisateur>
     */
    #[ORM\OneToMany(targetEntity: Utilisateur::class, mappedBy: 'role', orphanRemoval: true)]
    private Collection $idRole;

    public function __construct()
    {
        $this->idRole = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeRole(): ?string
    {
        return $this->codeRole;
    }

    public function setCodeRole(string $codeRole): static
    {
        $this->codeRole = $codeRole;

        return $this;
    }

    public function getLibelleRole(): ?string
    {
        return $this->libelleRole;
    }

    public function setLibelleRole(string $libelleRole): static
    {
        $this->libelleRole = $libelleRole;

        return $this;
    }

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getIdRole(): Collection
    {
        return $this->idRole;
    }

    public function addIdRole(Utilisateur $idRole): static
    {
        if (!$this->idRole->contains($idRole)) {
            $this->idRole->add($idRole);
            $idRole->setRole($this);
        }

        return $this;
    }

    public function removeIdRole(Utilisateur $idRole): static
    {
        if ($this->idRole->removeElement($idRole)) {
            // set the owning side to null (unless already changed)
            if ($idRole->getRole() === $this) {
                $idRole->setRole(null);
            }
        }

        return $this;
    }
}

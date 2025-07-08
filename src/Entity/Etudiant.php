<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtudiantRepository::class)]
class Etudiant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]

    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $matricule_etudiant = null;

    #[ORM\Column(length: 50)]
    private ?string $nom_etudiant = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom_etudiant = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_naissance = null;

    #[ORM\ManyToOne(inversedBy: 'etudiants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Specialite $code_specialite = null;

    /**
     * @var Collection<int, Payment>
     */
    #[ORM\OneToMany(targetEntity: Payment::class, mappedBy: 'student')]
    private Collection $payments;

    public function __construct()
    {
        $this->payments = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }


    public function setIdEtudiant(int $id_etudiant): static
    {
        $this->id_etudiant = $id_etudiant;

        return $this;
    }

    public function getMatriculeEtudiant(): ?string
    {
        return $this->matricule_etudiant;
    }

    public function setMatriculeEtudiant(string $matricule_etudiant): static
    {
        $this->matricule_etudiant = $matricule_etudiant;

        return $this;
    }

    public function getNomEtudiant(): ?string
    {
        return $this->nom_etudiant;
    }

    public function setNomEtudiant(string $nom_etudiant): static
    {
        $this->nom_etudiant = $nom_etudiant;

        return $this;
    }

    public function getPrenomEtudiant(): ?string
    {
        return $this->prenom_etudiant;
    }

    public function setPrenomEtudiant(string $prenom_etudiant): static
    {
        $this->prenom_etudiant = $prenom_etudiant;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeInterface $date_naissance): static
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getCodeSpecialite(): ?Specialite
    {
        return $this->code_specialite;
    }

    public function setCodeSpecialite(?Specialite $code_specialite): static
    {
        $this->code_specialite = $code_specialite;

        return $this;
    }
    
    /**
     * @return Collection<int, Payment>
     */
    public function getPayments(): Collection
    {
        return $this->payments;
    }

    public function addPayment(Payment $payment): static
    {
        if (!$this->payments->contains($payment)) {
            $this->payments->add($payment);
            $payment->setStudent($this);
        }

        return $this;
    }

    public function removePayment(Payment $payment): static
    {
        if ($this->payments->removeElement($payment)) {
            // set the owning side to null (unless already changed)
            if ($payment->getStudent() === $this) {
                $payment->setStudent(null);
            }
        }

        return $this;
    }

}

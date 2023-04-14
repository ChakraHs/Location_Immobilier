<?php

namespace App\Entity;

use App\Repository\AnnonceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnnonceRepository::class)]
class Annonce
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $A_Prix = null;

    #[ORM\Column(length: 255)]
    private ?string $A_Ville = null;

    #[ORM\Column(length: 255)]
    private ?string $A_Rue = null;

    #[ORM\Column]
    private ?int $A_Num_Immo = null;

    #[ORM\Column(length: 255)]
    private ?string $A_Etat = null;

    #[ORM\Column(length: 255)]
    private ?string $A_Traite = null;

    #[ORM\OneToMany(mappedBy: 'annonce', targetEntity: Proprietaire::class)]
    private Collection $A_Proprietaire;

    #[ORM\OneToMany(mappedBy: 'annonce', targetEntity: CategoryBien::class)]
    private Collection $A_Category;

    #[ORM\ManyToOne(inversedBy: 'I_Annonce')]
    private ?ImageImmo $imageImmo = null;

    #[ORM\ManyToOne(inversedBy: 'R_Annonce')]
    private ?Reservation $reservation = null;

    public function __construct()
    {
        $this->A_Proprietaire = new ArrayCollection();
        $this->A_Category = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAPrix(): ?float
    {
        return $this->A_Prix;
    }

    public function setAPrix(float $A_Prix): self
    {
        $this->A_Prix = $A_Prix;

        return $this;
    }

    public function getAVille(): ?string
    {
        return $this->A_Ville;
    }

    public function setAVille(string $A_Ville): self
    {
        $this->A_Ville = $A_Ville;

        return $this;
    }

    public function getARue(): ?string
    {
        return $this->A_Rue;
    }

    public function setARue(string $A_Rue): self
    {
        $this->A_Rue = $A_Rue;

        return $this;
    }

    public function getANumImmo(): ?int
    {
        return $this->A_Num_Immo;
    }

    public function setANumImmo(int $A_Num_Immo): self
    {
        $this->A_Num_Immo = $A_Num_Immo;

        return $this;
    }

    public function getAEtat(): ?string
    {
        return $this->A_Etat;
    }

    public function setAEtat(string $A_Etat): self
    {
        $this->A_Etat = $A_Etat;

        return $this;
    }

    public function getATraite(): ?string
    {
        return $this->A_Traite;
    }

    public function setATraite(string $A_Traite): self
    {
        $this->A_Traite = $A_Traite;

        return $this;
    }

    /**
     * @return Collection<int, Proprietaire>
     */
    public function getAProprietaire(): Collection
    {
        return $this->A_Proprietaire;
    }

    public function addAProprietaire(Proprietaire $aProprietaire): self
    {
        if (!$this->A_Proprietaire->contains($aProprietaire)) {
            $this->A_Proprietaire->add($aProprietaire);
            $aProprietaire->setAnnonce($this);
        }

        return $this;
    }

    public function removeAProprietaire(Proprietaire $aProprietaire): self
    {
        if ($this->A_Proprietaire->removeElement($aProprietaire)) {
            // set the owning side to null (unless already changed)
            if ($aProprietaire->getAnnonce() === $this) {
                $aProprietaire->setAnnonce(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CategoryBien>
     */
    public function getACategory(): Collection
    {
        return $this->A_Category;
    }

    public function addACategory(CategoryBien $aCategory): self
    {
        if (!$this->A_Category->contains($aCategory)) {
            $this->A_Category->add($aCategory);
            $aCategory->setAnnonce($this);
        }

        return $this;
    }

    public function removeACategory(CategoryBien $aCategory): self
    {
        if ($this->A_Category->removeElement($aCategory)) {
            // set the owning side to null (unless already changed)
            if ($aCategory->getAnnonce() === $this) {
                $aCategory->setAnnonce(null);
            }
        }

        return $this;
    }

    public function getImageImmo(): ?ImageImmo
    {
        return $this->imageImmo;
    }

    public function setImageImmo(?ImageImmo $imageImmo): self
    {
        $this->imageImmo = $imageImmo;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): self
    {
        $this->reservation = $reservation;

        return $this;
    }

}

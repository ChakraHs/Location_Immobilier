<?php

namespace App\Entity;

use App\Repository\AAnnonceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AAnnonceRepository::class)]
class AAnnonce
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $aprix = null;

    #[ORM\Column(length: 255)]
    private ?string $aville = null;

    #[ORM\Column(length: 255)]
    private ?string $arue = null;

    #[ORM\Column]
    private ?int $anumimmo = null;

    #[ORM\Column(length: 255)]
    private ?string $aetat = null;

    #[ORM\Column(length: 255)]
    private ?string $atraite = null;

    #[ORM\ManyToOne(inversedBy: 'pannonces')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AProprietaire $aproprietaire = null;

    #[ORM\OneToMany(mappedBy: 'iannonce', targetEntity: AImage::class)]
    private Collection $aImages;

    #[ORM\ManyToOne(inversedBy: 'cannonces')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ACategory $acategory = null;

    #[ORM\OneToMany(mappedBy: 'rannonce', targetEntity: AReservation::class)]
    private Collection $aReservations;

    public function __construct()
    {
        $this->aImages = new ArrayCollection();
        $this->aReservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAprix(): ?float
    {
        return $this->aprix;
    }

    public function setAprix(float $aprix): self
    {
        $this->aprix = $aprix;

        return $this;
    }

    public function getAville(): ?string
    {
        return $this->aville;
    }

    public function setAville(string $aville): self
    {
        $this->aville = $aville;

        return $this;
    }

    public function getArue(): ?string
    {
        return $this->arue;
    }

    public function setArue(string $arue): self
    {
        $this->arue = $arue;

        return $this;
    }

    public function getAnumimmo(): ?int
    {
        return $this->anumimmo;
    }

    public function setAnumimmo(int $anumimmo): self
    {
        $this->anumimmo = $anumimmo;

        return $this;
    }

    public function getAetat(): ?string
    {
        return $this->aetat;
    }

    public function setAetat(string $aetat): self
    {
        $this->aetat = $aetat;

        return $this;
    }

    public function getAtraite(): ?string
    {
        return $this->atraite;
    }

    public function setAtraite(string $atraite): self
    {
        $this->atraite = $atraite;

        return $this;
    }

    public function getAproprietaire(): ?AProprietaire
    {
        return $this->aproprietaire;
    }

    public function setAproprietaire(?AProprietaire $aproprietaire): self
    {
        $this->aproprietaire = $aproprietaire;

        return $this;
    }

    /**
     * @return Collection<int, AImage>
     */
    public function getAImages(): Collection
    {
        return $this->aImages;
    }

    public function addAImage(AImage $aImage): self
    {
        if (!$this->aImages->contains($aImage)) {
            $this->aImages->add($aImage);
            $aImage->setIannonce($this);
        }

        return $this;
    }

    public function removeAImage(AImage $aImage): self
    {
        if ($this->aImages->removeElement($aImage)) {
            // set the owning side to null (unless already changed)
            if ($aImage->getIannonce() === $this) {
                $aImage->setIannonce(null);
            }
        }

        return $this;
    }

    public function getAcategory(): ?ACategory
    {
        return $this->acategory;
    }

    public function setAcategory(?ACategory $acategory): self
    {
        $this->acategory = $acategory;

        return $this;
    }

    /**
     * @return Collection<int, AReservation>
     */
    public function getAReservations(): Collection
    {
        return $this->aReservations;
    }

    public function addAReservation(AReservation $aReservation): self
    {
        if (!$this->aReservations->contains($aReservation)) {
            $this->aReservations->add($aReservation);
            $aReservation->setRannonce($this);
        }

        return $this;
    }

    public function removeAReservation(AReservation $aReservation): self
    {
        if ($this->aReservations->removeElement($aReservation)) {
            // set the owning side to null (unless already changed)
            if ($aReservation->getRannonce() === $this) {
                $aReservation->setRannonce(null);
            }
        }

        return $this;
    }
}

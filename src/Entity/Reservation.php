<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $R_Date_Entree = null;

    #[ORM\Column]
    private ?int $R_Nombre_Mois = null;

    #[ORM\Column(length: 255)]
    private ?string $R_Contrat = null;

    #[ORM\OneToMany(mappedBy: 'reservation', targetEntity: Annonce::class)]
    private Collection $R_Annonce;

    #[ORM\OneToMany(mappedBy: 'reservation', targetEntity: Client::class)]
    private Collection $R_client;

    public function __construct()
    {
        $this->R_Annonce = new ArrayCollection();
        $this->R_client = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRDateEntree(): ?\DateTimeInterface
    {
        return $this->R_Date_Entree;
    }

    public function setRDateEntree(\DateTimeInterface $R_Date_Entree): self
    {
        $this->R_Date_Entree = $R_Date_Entree;

        return $this;
    }

    public function getRNombreMois(): ?int
    {
        return $this->R_Nombre_Mois;
    }

    public function setRNombreMois(int $R_Nombre_Mois): self
    {
        $this->R_Nombre_Mois = $R_Nombre_Mois;

        return $this;
    }

    public function getRContrat(): ?string
    {
        return $this->R_Contrat;
    }

    public function setRContrat(string $R_Contrat): self
    {
        $this->R_Contrat = $R_Contrat;

        return $this;
    }

    /**
     * @return Collection<int, Annonce>
     */
    public function getRAnnonce(): Collection
    {
        return $this->R_Annonce;
    }

    public function addRAnnonce(Annonce $rAnnonce): self
    {
        if (!$this->R_Annonce->contains($rAnnonce)) {
            $this->R_Annonce->add($rAnnonce);
            $rAnnonce->setReservation($this);
        }

        return $this;
    }

    public function removeRAnnonce(Annonce $rAnnonce): self
    {
        if ($this->R_Annonce->removeElement($rAnnonce)) {
            // set the owning side to null (unless already changed)
            if ($rAnnonce->getReservation() === $this) {
                $rAnnonce->setReservation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Client>
     */
    public function getRClient(): Collection
    {
        return $this->R_client;
    }

    public function addRClient(Client $rClient): self
    {
        if (!$this->R_client->contains($rClient)) {
            $this->R_client->add($rClient);
            $rClient->setReservation($this);
        }

        return $this;
    }

    public function removeRClient(Client $rClient): self
    {
        if ($this->R_client->removeElement($rClient)) {
            // set the owning side to null (unless already changed)
            if ($rClient->getReservation() === $this) {
                $rClient->setReservation(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getRContrat();
    }
}

<?php

namespace App\Entity;

use App\Repository\AClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AClientRepository::class)]
class AClient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $cnom = null;

    #[ORM\Column(length: 255)]
    private ?string $cprenom = null;

    // #[ORM\Column(length: 255)]
    // private ?string $cemail = null;

    // #[ORM\Column(length: 255)]
    // private ?string $cmdp = null;

    #[ORM\Column(length: 255)]
    private ?string $ctele = null;

    #[ORM\OneToMany(mappedBy: 'rclient', targetEntity: AReservation::class)]
    private Collection $creservations;

    #[ORM\OneToOne(inversedBy: 'aClient', cascade: ['persist', 'remove'])]
    private ?User $Cuser = null;

    public function __construct()
    {
        $this->creservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCnom(): ?string
    {
        return $this->cnom;
    }

    public function setCnom(string $cnom): self
    {
        $this->cnom = $cnom;

        return $this;
    }

    public function getCprenom(): ?string
    {
        return $this->cprenom;
    }

    public function setCprenom(string $cprenom): self
    {
        $this->cprenom = $cprenom;

        return $this;
    }

    // public function getCemail(): ?string
    // {
    //     return $this->cemail;
    // }

    // public function setCemail(string $cemail): self
    // {
    //     $this->cemail = $cemail;

    //     return $this;
    // }

    // public function getCmdp(): ?string
    // {
    //     return $this->cmdp;
    // }

    // public function setCmdp(string $cmdp): self
    // {
    //     $this->cmdp = $cmdp;

    //     return $this;
    // }

    public function getCtele(): ?string
    {
        return $this->ctele;
    }

    public function setCtele(string $ctele): self
    {
        $this->ctele = $ctele;

        return $this;
    }

    /**
     * @return Collection<int, AReservation>
     */
    public function getCreservations(): Collection
    {
        return $this->creservations;
    }

    public function addCreservation(AReservation $creservation): self
    {
        if (!$this->creservations->contains($creservation)) {
            $this->creservations->add($creservation);
            $creservation->setRclient($this);
        }

        return $this;
    }

    public function removeCreservation(AReservation $creservation): self
    {
        if ($this->creservations->removeElement($creservation)) {
            // set the owning side to null (unless already changed)
            if ($creservation->getRclient() === $this) {
                $creservation->setRclient(null);
            }
        }

        return $this;
    }

    public function getCuser(): ?user
    {
        return $this->Cuser;
    }

    public function setCuser(?user $Cuser): self
    {
        $this->Cuser = $Cuser;

        return $this;
    }
}

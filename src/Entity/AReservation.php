<?php

namespace App\Entity;

use App\Repository\AReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AReservationRepository::class)]
class AReservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $rdateentree = null;

    #[ORM\Column]
    private ?int $rnombremois = null;

    #[ORM\Column(length: 255)]
    private ?string $rcontrat = null;

    #[ORM\ManyToOne(inversedBy: 'aReservations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AAnnonce $rannonce = null;

    #[ORM\ManyToOne(inversedBy: 'creservations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AClient $rclient = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRdateentree(): ?\DateTimeInterface
    {
        return $this->rdateentree;
    }

    public function setRdateentree(\DateTimeInterface $rdateentree): self
    {
        $this->rdateentree = $rdateentree;

        return $this;
    }

    public function getRnombremois(): ?int
    {
        return $this->rnombremois;
    }

    public function setRnombremois(int $rnombremois): self
    {
        $this->rnombremois = $rnombremois;

        return $this;
    }

    public function getRcontrat(): ?string
    {
        return $this->rcontrat;
    }

    public function setRcontrat(string $rcontrat): self
    {
        $this->rcontrat = $rcontrat;

        return $this;
    }

    public function getRannonce(): ?AAnnonce
    {
        return $this->rannonce;
    }

    public function setRannonce(?AAnnonce $rannonce): self
    {
        $this->rannonce = $rannonce;

        return $this;
    }

    public function getRclient(): ?AClient
    {
        return $this->rclient;
    }

    public function setRclient(?AClient $rclient): self
    {
        $this->rclient = $rclient;

        return $this;
    }
}

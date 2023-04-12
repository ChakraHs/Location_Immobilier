<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $C_Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $C_prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $C_Email = null;

    #[ORM\Column(length: 255)]
    private ?string $C_Mdp = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $C_Tele = null;

    #[ORM\ManyToOne(inversedBy: 'R_client')]
    private ?Reservation $reservation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCNom(): ?string
    {
        return $this->C_Nom;
    }

    public function setCNom(string $C_Nom): self
    {
        $this->C_Nom = $C_Nom;

        return $this;
    }

    public function getCPrenom(): ?string
    {
        return $this->C_prenom;
    }

    public function setCPrenom(string $C_prenom): self
    {
        $this->C_prenom = $C_prenom;

        return $this;
    }

    public function getCEmail(): ?string
    {
        return $this->C_Email;
    }

    public function setCEmail(string $C_Email): self
    {
        $this->C_Email = $C_Email;

        return $this;
    }

    public function getCMdp(): ?string
    {
        return $this->C_Mdp;
    }

    public function setCMdp(string $C_Mdp): self
    {
        $this->C_Mdp = $C_Mdp;

        return $this;
    }

    public function getCTele(): ?string
    {
        return $this->C_Tele;
    }

    public function setCTele(string $C_Tele): self
    {
        $this->C_Tele = $C_Tele;

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

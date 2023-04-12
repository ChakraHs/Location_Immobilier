<?php

namespace App\Entity;

use App\Repository\ProprietaireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProprietaireRepository::class)]
class Proprietaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $P_Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $P_Prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $P_Email = null;

    #[ORM\Column(length: 255)]
    private ?string $P_Mdp = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $P_Tele = null;

    #[ORM\Column(length: 255)]
    private ?string $P_CIN = null;

    #[ORM\Column(length: 255)]
    private ?string $P_Cin_Image = null;

    #[ORM\ManyToOne(inversedBy: 'A_Proprietaire')]
    private ?Annonce $annonce = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->P_Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->P_Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->P_Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->P_Prenom = $Prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->P_Email;
    }

    public function setEmail(string $Email): self
    {
        $this->P_Email = $Email;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->P_Mdp;
    }

    public function setMdp(string $Mdp): self
    {
        $this->P_Mdp = $Mdp;

        return $this;
    }

    public function getTele(): ?string
    {
        return $this->P_Tele;
    }

    public function setTele(string $Tele): self
    {
        $this->P_Tele = $Tele;

        return $this;
    }

    public function getCIN(): ?string
    {
        return $this->P_CIN;
    }

    public function setCIN(string $CIN): self
    {
        $this->P_CIN = $CIN;

        return $this;
    }

    public function getPCinImage(): ?string
    {
        return $this->P_Cin_Image;
    }

    public function setPCinImage(string $P_Cin_Image): self
    {
        $this->P_Cin_Image = $P_Cin_Image;

        return $this;
    }

    public function getAnnonce(): ?Annonce
    {
        return $this->annonce;
    }

    public function setAnnonce(?Annonce $annonce): self
    {
        $this->annonce = $annonce;

        return $this;
    }
}

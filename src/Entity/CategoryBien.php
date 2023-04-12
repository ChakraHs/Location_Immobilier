<?php

namespace App\Entity;

use App\Repository\CategoryBienRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryBienRepository::class)]
class CategoryBien
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Cat_Nom = null;

    #[ORM\ManyToOne(inversedBy: 'A_Category')]
    private ?Annonce $annonce = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCatNom(): ?string
    {
        return $this->Cat_Nom;
    }

    public function setCatNom(string $Cat_Nom): self
    {
        $this->Cat_Nom = $Cat_Nom;

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

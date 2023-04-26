<?php

namespace App\Entity;

use App\Repository\AImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AImageRepository::class)]
class AImage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'aImages')]
    private ?AAnnonce $iannonce = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getIannonce(): ?AAnnonce
    {
        return $this->iannonce;
    }

    public function setIannonce(?AAnnonce $iannonce): self
    {
        $this->iannonce = $iannonce;

        return $this;
    }
}

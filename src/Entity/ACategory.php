<?php

namespace App\Entity;

use App\Repository\ACategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ACategoryRepository::class)]
class ACategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $catnom = null;

    #[ORM\OneToMany(mappedBy: 'acategory', targetEntity: AAnnonce::class)]
    private Collection $cannonces;

    public function __construct()
    {
        $this->cannonces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCatnom(): ?string
    {
        return $this->catnom;
    }

    public function setCatnom(string $catnom): self
    {
        $this->catnom = $catnom;

        return $this;
    }

    /**
     * @return Collection<int, AAnnonce>
     */
    public function getCannonces(): Collection
    {
        return $this->cannonces;
    }

    public function addCannonce(AAnnonce $cannonce): self
    {
        if (!$this->cannonces->contains($cannonce)) {
            $this->cannonces->add($cannonce);
            $cannonce->setAcategory($this);
        }

        return $this;
    }

    public function removeCannonce(AAnnonce $cannonce): self
    {
        if ($this->cannonces->removeElement($cannonce)) {
            // set the owning side to null (unless already changed)
            if ($cannonce->getAcategory() === $this) {
                $cannonce->setAcategory(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getCatnom();
    }
}

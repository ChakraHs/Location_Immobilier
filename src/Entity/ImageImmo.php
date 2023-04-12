<?php

namespace App\Entity;

use App\Repository\ImageImmoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageImmoRepository::class)]
class ImageImmo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Image = null;

    #[ORM\OneToMany(mappedBy: 'imageImmo', targetEntity: Annonce::class)]
    private Collection $I_Annonce;

    public function __construct()
    {
        $this->I_Annonce = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }

    /**
     * @return Collection<int, Annonce>
     */
    public function getIAnnonce(): Collection
    {
        return $this->I_Annonce;
    }

    public function addIAnnonce(Annonce $iAnnonce): self
    {
        if (!$this->I_Annonce->contains($iAnnonce)) {
            $this->I_Annonce->add($iAnnonce);
            $iAnnonce->setImageImmo($this);
        }

        return $this;
    }

    public function removeIAnnonce(Annonce $iAnnonce): self
    {
        if ($this->I_Annonce->removeElement($iAnnonce)) {
            // set the owning side to null (unless already changed)
            if ($iAnnonce->getImageImmo() === $this) {
                $iAnnonce->setImageImmo(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\AProprietaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AProprietaireRepository::class)]
class AProprietaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $pnom = null;

    #[ORM\Column(length: 255)]
    private ?string $pprenom = null;

    #[ORM\Column(length: 255)]
    private ?string $pemail = null;

    #[ORM\Column(length: 255)]
    private ?string $pmdp = null;

    #[ORM\Column(length: 255)]
    private ?string $ptele = null;

    #[ORM\Column(length: 255)]
    private ?string $pcin = null;

    #[ORM\Column(length: 255)]
    private ?string $pcinimage = null;

    #[ORM\OneToMany(mappedBy: 'aproprietaire', targetEntity: AAnnonce::class)]
    private Collection $pannonces;

    public function __construct()
    {
        $this->pannonces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPnom(): ?string
    {
        return $this->pnom;
    }

    public function setPnom(string $pnom): self
    {
        $this->pnom = $pnom;

        return $this;
    }

    public function getPprenom(): ?string
    {
        return $this->pprenom;
    }

    public function setPprenom(string $pprenom): self
    {
        $this->pprenom = $pprenom;

        return $this;
    }

    public function getPemail(): ?string
    {
        return $this->pemail;
    }

    public function setPemail(string $pemail): self
    {
        $this->pemail = $pemail;

        return $this;
    }

    public function getPmdp(): ?string
    {
        return $this->pmdp;
    }

    public function setPmdp(string $pmdp): self
    {
        $this->pmdp = $pmdp;

        return $this;
    }

    public function getPtele(): ?string
    {
        return $this->ptele;
    }

    public function setPtele(string $ptele): self
    {
        $this->ptele = $ptele;

        return $this;
    }

    public function getPcin(): ?string
    {
        return $this->pcin;
    }

    public function setPcin(string $pcin): self
    {
        $this->pcin = $pcin;

        return $this;
    }

    public function getPcinimage(): ?string
    {
        return $this->pcinimage;
    }

    public function setPcinimage(string $pcinimage): self
    {
        $this->pcinimage = $pcinimage;

        return $this;
    }

    /**
     * @return Collection<int, AAnnonce>
     */
    public function getPannonces(): Collection
    {
        return $this->pannonces;
    }

    public function addPannonce(AAnnonce $pannonce): self
    {
        if (!$this->pannonces->contains($pannonce)) {
            $this->pannonces->add($pannonce);
            $pannonce->setAproprietaire($this);
        }

        return $this;
    }

    public function removePannonce(AAnnonce $pannonce): self
    {
        if ($this->pannonces->removeElement($pannonce)) {
            // set the owning side to null (unless already changed)
            if ($pannonce->getAproprietaire() === $this) {
                $pannonce->setAproprietaire(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getId();
    }
}

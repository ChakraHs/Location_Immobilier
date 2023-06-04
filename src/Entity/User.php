<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\OneToOne(mappedBy: 'Cuser', cascade: ['persist', 'remove'])]
    private ?AClient $aClient = null;

    #[ORM\OneToOne(mappedBy: 'Puser', cascade: ['persist', 'remove'])]
    private ?AProprietaire $aProprietaire = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getAClient(): ?AClient
    {
        return $this->aClient;
    }

    public function setAClient(?AClient $aClient): self
    {
        // unset the owning side of the relation if necessary
        if ($aClient === null && $this->aClient !== null) {
            $this->aClient->setCuser(null);
        }

        // set the owning side of the relation if necessary
        if ($aClient !== null && $aClient->getCuser() !== $this) {
            $aClient->setCuser($this);
        }

        $this->aClient = $aClient;

        return $this;
    }

    public function getAProprietaire(): ?AProprietaire
    {
        return $this->aProprietaire;
    }

    public function setAProprietaire(?AProprietaire $aProprietaire): self
    {
        // unset the owning side of the relation if necessary
        if ($aProprietaire === null && $this->aProprietaire !== null) {
            $this->aProprietaire->setPuser(null);
        }

        // set the owning side of the relation if necessary
        if ($aProprietaire !== null && $aProprietaire->getPuser() !== $this) {
            $aProprietaire->setPuser($this);
        }

        $this->aProprietaire = $aProprietaire;

        return $this;
    }

    public function __toString(){
        return $this->getId();
    }
}

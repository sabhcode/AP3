<?php

namespace App\Entity;

use App\Repository\CredentialsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CredentialsRepository::class)]
class Credentials
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $lastconnection = null;

    #[ORM\OneToOne(mappedBy: 'credential_email', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getLastconnection(): ?\DateTimeInterface
    {
        return $this->lastconnection;
    }

    public function setLastconnection(\DateTimeInterface $lastconnection): static
    {
        $this->lastconnection = $lastconnection;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        // set the owning side of the relation if necessary
        if ($user->getCredentialEmail() !== $this) {
            $user->setCredentialEmail($this);
        }

        $this->user = $user;

        return $this;
    }
}

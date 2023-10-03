<?php

namespace App\Entity;

use App\Repository\CredentialRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CredentialRepository::class)]
class Credential
{
    #[ORM\Id]
    #[ORM\OneToOne(inversedBy: 'credential', cascade: ['persist', 'remove'])]
    private ?User $user_email = null;

    #[ORM\Column(length: 60)]
    private ?string $password = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $last_connection = null;

    public function getUserEmail(): ?User
    {
        return $this->user_email;
    }

    public function setUserEmail(?User $user_email): static
    {
        $this->user_email = $user_email;

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

    public function getLastConnection(): ?\DateTimeInterface
    {
        return $this->last_connection;
    }

    public function setLastConnection(\DateTimeInterface $last_connection): static
    {
        $this->last_connection = $last_connection;

        return $this;
    }
}

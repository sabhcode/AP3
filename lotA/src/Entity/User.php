<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['uuid'], message: 'There is already an account with this uuid')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{

    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    private ?string $uuid = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 100)]
    private ?string $firstname = null;  

    #[ORM\Column(length: 255)]
    private ?string $street = null;

    #[ORM\Column(length: 255)]
    private ?string $zip_code = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'credential_email', referencedColumnName: 'email', nullable: false)]
    private ?Credential $credential = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: order::class)]
    private Collection $orders;

    public function __construct()
    {
        $this->uuid = Uuid::v4();
        $this->orders = new ArrayCollection();
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return $this->getCredential()->getEmail();
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

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->getCredential()->getPassword();
    }

    public function setPassword(string $password): Credential
    {
        $this->getCredential()->setPassword($password);

        return $this->getCredential();
    }

    public function getEmail(): ?string
    {
        return $this->getCredential()->getEmail();
    }

    public function setEmail(string $email): Credential
    {
        $this->getCredential()->setEmail($email);

        return $this->getCredential();
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getCredential(): ?Credential
    {
        return $this->credential;
    }

    public function setCredential(?Credential $credential): static
    {
        $this->credential = $credential;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): static
    {
        $this->street = $street;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zip_code;
    }

    public function setZipCode(string $zip_code): static
    {
        $this->zip_code = $zip_code;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return Collection<int, order>
     */
    public function getOrderUuid(): Collection
    {
        return $this->orders;
    }

    public function addOrderUuid(order $orderUuid): static
    {
        if (!$this->orders->contains($orderUuid)) {
            $this->orders->add($orderUuid);
            $orderUuid->setUser($this);
        }

        return $this;
    }

    public function removeOrderUuid(order $orderUuid): static
    {
        if ($this->orders->removeElement($orderUuid)) {
            // set the owning side to null (unless already changed)
            if ($orderUuid->getUser() === $this) {
                $orderUuid->setUser(null);
            }
        }

        return $this;
    }
}
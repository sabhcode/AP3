<?php

namespace App\Entity;

// API imports
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'user:item']),
    ]
)]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['credential'], message: 'Adresse email déjà utilisée')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    private const NUMBER_REFERENCE_CLIENT = 8;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(options: ['unsigned' => true])]
    #[Groups(['user:item'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['user:item'])]
    private array $roles = [];

    #[ORM\Column(length: 100)]
    #[Groups(['user:item'])]
    private ?string $name = null;

    #[ORM\Column(length: 100)]
    #[Groups(['user:item'])]
    private ?string $firstname = null;  

    #[ORM\Column(length: 20, nullable: true)]
    #[Groups(['user:item'])]
    private ?string $phone = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[Groups(['user:item'])]
    private ?string $street = null;

    #[ORM\Column(length: 10, nullable: true)]
    #[Groups(['user:item'])]
    private ?string $zip_code = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[Groups(['user:item'])]
    private ?string $city = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Groups(['user:item'])]
    private ?\DateTimeInterface $birthday = null;

    #[ORM\Column(columnDefinition: 'TINYINT')]
    #[Groups(['user:item'])]
    private ?int $nb_children = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'credential_email', referencedColumnName: 'email', nullable: false)]
    private ?Credential $credential = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: OrderUser::class)]
    private Collection $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return str_pad($this->id, self::NUMBER_REFERENCE_CLIENT, "0", STR_PAD_LEFT);
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return $this->getCredential()?->getEmail();
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
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->getCredential()?->getPassword();
    }

    public function setPassword(string $password): Credential
    {
        $this->getCredential()?->setPassword($password);

        return $this->getCredential();
    }

    public function getEmail(): ?string
    {
        return $this->getCredential()?->getEmail();
    }

    public function setEmail(string $email): Credential
    {
        $this->getCredential()?->setEmail($email);

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

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): static
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getNbChildren(): ?int
    {
        return $this->nb_children;
    }

    public function setNbChildren(int $nb_children): static
    {
        $this->nb_children = $nb_children;

        return $this;
    }

    /**
     * @return Collection<int, OrderUser>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(OrderUser $order): static
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->setUser($this);
        }

        return $this;
    }

    public function removeOrder(OrderUser $order): static
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getUser() === $this) {
                $order->setUser(null);
            }
        }

        return $this;
    }

    public function getAddress(): ?string {

        if($this->street && $this->zip_code && $this->city) {
            return "$this->street, $this->zip_code $this->city";
        }
        return null;

    }
}

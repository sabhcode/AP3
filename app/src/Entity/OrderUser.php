<?php

namespace App\Entity;

// API imports
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;

use App\Repository\OrderUserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'orderuser:item']),
        new Post(normalizationContext: ['groups' => 'orderuser:item'])
    ]
)]
#[ORM\Entity(repositoryClass: OrderUserRepository::class)]
class OrderUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(options: ['unsigned' => true])]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_time = null;

    #[ORM\Column(type: Types::DECIMAL, scale: 2)]
    private ?string $total_price_ht = null;

    #[ORM\Column]
    private ?float $tax = null;

    #[ORM\Column]
    private ?int $product_quantity = null;

    #[ORM\Column(type: Types::DECIMAL, scale: 2, nullable: true)]
    private ?string $shipping_cost = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $street = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $zip_code = null;

    #[ORM\Column(length: 100)]
    private ?string $city = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: "order", targetEntity: OrderDetail::class)]
    private Collection $orderDetails;

    #[ORM\OneToMany(mappedBy: 'order', targetEntity: OrderRank::class)]
    private Collection $orderRanks;

    public function __construct()
    {
        $this->orderDetails = new ArrayCollection();
        $this->orderRanks = new ArrayCollection();
        
        $datetime = new \DateTime();
        $timezone = new \DateTimeZone('Europe/Paris');
        $this->date_time = $datetime->setTimezone($timezone);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateTime(): ?\DateTimeInterface
    {
        return $this->date_time;
    }

    public function setDateTime(\DateTimeInterface $date_time): static
    {
        $this->date_time = $date_time;

        return $this;
    }

    public function getTotalPriceHT(): ?float
    {
        return $this->total_price_ht;
    }

    public function setTotalPriceHT(float $total_price_ht): static
    {
        $this->total_price_ht = $total_price_ht;

        return $this;
    }

    public function getTax(): ?int
    {
        return $this->tax;
    }

    public function setTax(int $tax): static
    {
        $this->tax = $tax;

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

    /**
     * @return Collection<int, OrderDetail>
     */
    public function getOrderDetail(): Collection
    {
        return $this->orderDetails;
    }

    /**
     * @return Collection<int, OrderRank>
     */
    public function getOrderRanks(): Collection
    {
        return $this->orderRanks;
    }

    public function addOrderRank(OrderRank $orderRank): static
    {
        if (!$this->orderRanks->contains($orderRank)) {
            $this->orderRanks->add($orderRank);
            $orderRank->setOrder($this);
        }

        return $this;
    }

    public function removeOrderRank(OrderRank $orderRank): static
    {
        if ($this->orderRanks->removeElement($orderRank)) {
            // set the owning side to null (unless already changed)
            if ($orderRank->getOrder() === $this) {
                $orderRank->setOrder(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getProductQuantity(): ?int
    {
        return $this->product_quantity;
    }

    public function setProductQuantity(int $product_quantity): static
    {
        $this->product_quantity = $product_quantity;

        return $this;
    }

    public function getShippingCost(): ?float
    {
        return $this->shipping_cost;
    }

    public function setShippingCost(float $shipping_cost): static
    {
        $this->shipping_cost = $shipping_cost;

        return $this;
    }

    public function getAddress(): string {

        $address = "";

        if($this->street && $this->zip_code && $this->city) {
            $address .= "$this->street, $this->zip_code";
        }
        return $address .= " $this->city";

    }
}

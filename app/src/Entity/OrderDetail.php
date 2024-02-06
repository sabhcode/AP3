<?php

namespace App\Entity;

// API imports
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\OrderDetailRepository;

#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'orderdetail:item']),
        new Post(normalizationContext: ['groups' => 'orderdetail:item'])
    ]
)]
#[ORM\Entity(repositoryClass: OrderDetailRepository::class)]
class OrderDetail
{
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: "orderDetails")]
    #[ORM\JoinColumn(nullable: false)]
    private ?OrderUser $order = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: "orderDetails")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column(type: Types::DECIMAL, scale: 2)]
    private ?string $unit_price = null;

    public function getOrder(): ?OrderUser
    {
        return $this->order;
    }

    public function setOrder(OrderUser $order): static
    {
        $this->order = $order;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getUnitPrice(): ?float
    {
        return $this->unit_price;
    }

    public function setUnitPrice(float $unit_price): static
    {
        $this->unit_price = $unit_price;

        return $this;
    }
}

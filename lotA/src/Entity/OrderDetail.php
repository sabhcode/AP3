<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\OrderDetailRepository;

#[ORM\Entity(repositoryClass: OrderDetailRepository::class)]
class OrderDetail
{
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: "orderDetails")]
    #[ORM\JoinColumn(name: "order_uuid", referencedColumnName: "uuid", nullable: false)]
    private ?Order $order_uuid = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: "orderDetails")]
    #[ORM\JoinColumn(name: "product_uuid", referencedColumnName: "uuid", nullable: false)]
    private ?Product $product_uuid = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 4, scale: 2)]
    private ?float $unit_price = null;

    public function getOrderUuid(): ?Order
    {
        return $this->order_uuid;
    }

    public function setOrderUuid(Order $order_uuid): static
    {
        $this->order_uuid = $order_uuid;

        return $this;
    }

    public function getProductUuid(): ?Product
    {
        return $this->product_uuid;
    }

    public function setProductUuid(Product $product_uuid): static
    {
        $this->product_uuid = $product_uuid;

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

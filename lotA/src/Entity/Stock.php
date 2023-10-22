<?php

namespace App\Entity;

use App\Repository\StockRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StockRepository::class)]
class Stock
{

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'stocks')]
    #[ORM\JoinColumn(name: "store_uuid", referencedColumnName: "uuid", nullable: false)]
    private ?Store $store_uuid = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'stocks')]
    #[ORM\JoinColumn(name: "product_uuid", referencedColumnName: "uuid", nullable: false)]
    private ?Product $product_uuid = null;

    #[ORM\Column]
    private ?int $quantity = null;

    public function getStore(): ?Store
    {
        return $this->store_uuid;
    }

    public function setStore(?Store $store_uuid): static
    {
        $this->store_uuid = $store_uuid;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product_uuid;
    }

    public function setProduct(?Product $product_uuid): static
    {
        $this->product_uuid = $product_uuid;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }
}

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

    public function getStoreUuid(): ?Store
    {
        return $this->store_uuid;
    }

    public function setStoreUuid(?Store $store_uuid): static
    {
        $this->store_uuid = $store_uuid;

        return $this;
    }

    public function getProductUuid(): ?Product
    {
        return $this->product_uuid;
    }

    public function setProductUuid(?Product $product_uuid): static
    {
        $this->product_uuid = $product_uuid;

        return $this;
    }

    public function getQuantity(): ?Product
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }
}

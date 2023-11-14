<?php

namespace App\Entity;

use App\Repository\StockShelfRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StockShelfRepository::class)]
class StockShelf
{


    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'stockShelves')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product = null;

    
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'stockShelves')]
    #[ORM\JoinColumn(name:"shelf_code", referencedColumnName:"code", nullable: false)]
    private ?Shelf $shelf = null;

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getShelf(): ?Shelf
    {
        return $this->shelf;
    }

    public function setShelf(?Shelf $shelf): static
    {
        $this->shelf = $shelf;

        return $this;
    }
}
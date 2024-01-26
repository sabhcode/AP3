<?php

namespace App\Entity;

use App\Repository\StockShelfRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StockShelfRepository::class)]
class StockShelf
{
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'stockShelves')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'stockShelves')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Shelf $shelf = null;

    #[ORM\Column]
    private ?int $quantity = null;

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

    public function getSection(): ?Shelf
    {
        return $this->section;
    }

    public function setSection(?Shelf $section): static
    {
        $this->section = $section;

        return $this;
    }

    public function getWay(): ?Shelf
    {
        return $this->way;
    }

    public function setWay(?Way $way): static
    {
        $this->way = $way;

        return $this;
    }

    public function getModule(): ?Shelf
    {
        return $this->module;
    }

    public function setModule(?Shelf $module): static
    {
        $this->module = $module;

        return $this;
    }

    public function getBuilding(): ?Shelf
    {
        return $this->building;
    }

    public function setBuilding(?Shelf $building): static
    {
        $this->building = $building;

        return $this;
    }

    public function getWarehouse(): ?Shelf
    {
        return $this->warehouse;
    }

    public function setWarehouse(?Shelf $warehouse): static
    {
        $this->warehouse = $warehouse;

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
}

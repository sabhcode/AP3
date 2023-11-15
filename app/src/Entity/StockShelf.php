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
    #[ORM\JoinColumn(name:"shelf_code", referencedColumnName:"code", nullable: false)]
    private ?Shelf $shelf = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'stockShelves')]
    #[ORM\JoinColumn(name:"section_code", referencedColumnName:"section_code", nullable: false)]
    private ?Shelf $section = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'stockShelves')]
    #[ORM\JoinColumn(name:"way_code", referencedColumnName:"way_code", nullable: false)]
    private ?Shelf $way = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'stockShelves')]
    #[ORM\JoinColumn(name:"module_code", referencedColumnName:"module_code", nullable: false)]
    private ?Shelf $module = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'stockShelves')]
    #[ORM\JoinColumn(name:"building_code", referencedColumnName:"building_code", nullable: false)]
    private ?Shelf $building = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'stockShelves')]
    #[ORM\JoinColumn(name:"warehouse_id", referencedColumnName:"warehouse_id", nullable: false)]
    private ?Shelf $warehouse = null;

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

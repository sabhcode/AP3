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

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'stockShelvesSections')]
    #[ORM\JoinColumn(name:"shelf_section_code", referencedColumnName:"section_code",nullable: false)]
    private ?Shelf $shelf_section_code = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'stockShelvesRowShelf')]
    #[ORM\JoinColumn(name:"shelf_row_shelf_code", referencedColumnName:"row_shelf_code",nullable: false)]
    private ?Shelf $shelf_row_shelf_code = null;
    
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'stockShelvesModules')]
    #[ORM\JoinColumn(name:"shelf_module_code", referencedColumnName:"module_code",nullable: false)]
    private ?Shelf $shelf_module_code = null;
    
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'stockShelvesBuildings')]
    #[ORM\JoinColumn(name:"shelf_building_code", referencedColumnName:"building_code",nullable: false)]
    private ?Shelf $shelf_building_code = null;

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

    public function getShelfSectionCode(): ?Shelf
    {
        return $this->shelf_section_code;
    }

    public function setShelfSectionCode(?Shelf $shelf_section_code): static
    {
        $this->shelf_section_code = $shelf_section_code;

        return $this;
    }

    public function getShelfRowShelfCode(): ?Shelf
    {
        return $this->shelf_row_shelf_code;
    }

    public function setShelfRowShelfCode(?Shelf $shelf_row_shelf_code): static
    {
        $this->shelf_row_shelf_code = $shelf_row_shelf_code;

        return $this;
    }

    public function getShelfModeleCode(): ?Shelf
    {
        return $this->shelf_module_code;
    }

    public function setShelfModeleCode(?Shelf $shelf_module_code): static
    {
        $this->shelf_module_code = $shelf_module_code;

        return $this;
    }

    public function getShelfBuildingCode(): ?Shelf
    {
        return $this->shelf_building_code;
    }

    public function setShelfBuildingCode(?Shelf $shelf_building_code): static
    {
        $this->shelf_building_code = $shelf_building_code;

        return $this;
    }
}
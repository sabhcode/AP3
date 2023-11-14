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
    #[ORM\JoinColumn(name:"building_code", referencedColumnName:"code", nullable: false)]
    private ?Building $building = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'stockShelves')]
    #[ORM\JoinColumn(name:"module_code", referencedColumnName:"code", nullable: false)]
    private ?Module $module = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'stockShelves')]
    #[ORM\JoinColumn(name:"row_code", referencedColumnName:"code", nullable: false)]
    private ?Row $row_ = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'stockShelves')]
    #[ORM\JoinColumn(name:"section_code", referencedColumnName:"code", nullable: false)]
    private ?Section $section = null;

    #[ORM\Column]
    private ?int $quantity = null;

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

    public function getBuilding(): ?Building
    {
        return $this->building;
    }

    public function setBuilding(?Building $building): static
    {
        $this->building = $building;

        return $this;
    }

    public function getModule(): ?Module
    {
        return $this->module;
    }

    public function setModule(?Module $module): static
    {
        $this->module = $module;

        return $this;
    }

    public function getRow(): ?Row
    {
        return $this->row_;
    }

    public function setRow(?Row $row_): static
    {
        $this->row_ = $row_;

        return $this;
    }

    public function getSection(): ?Section
    {
        return $this->section;
    }

    public function setSection(?Section $section): static
    {
        $this->section = $section;

        return $this;
    }

}
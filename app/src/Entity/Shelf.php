<?php

namespace App\Entity;

use App\Repository\ShelfRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShelfRepository::class)]
class Shelf
{
    #[ORM\Id]
    #[ORM\Column(length: 1)]
    private ?string $code = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'shelves')]
    #[ORM\JoinColumn(name:"section_code", referencedColumnName:"code",nullable: false)]
    private ?Section $section = null;

    #[ORM\OneToMany(mappedBy: 'shelf', targetEntity: StockShelf::class)]
    private Collection $stockShelves;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'shelves')]
    #[ORM\JoinColumn(name:"row_shelf_code", referencedColumnName:"code",nullable: false)]
    private ?Row $row_shelf = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'shelves')]
    #[ORM\JoinColumn(name:"module_code", referencedColumnName:"code",nullable: false)]
    private ?Module $module = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'shelves')]
    #[ORM\JoinColumn(name:"building_code", referencedColumnName:"code",nullable: false)]
    private ?Building $building = null;

    #[ORM\OneToMany(mappedBy: 'shelf_section_code', targetEntity: StockShelf::class)]
    private Collection $stockShelvesSections;

    #[ORM\OneToMany(mappedBy: 'shelf_row_shelf_code', targetEntity: StockShelf::class)]
    private Collection $stockShelvesRowShelf;

    #[ORM\OneToMany(mappedBy: 'shelf_modele_code', targetEntity: StockShelf::class)]
    private Collection $stockShelvesModules;

    #[ORM\OneToMany(mappedBy: 'shelf_building_code', targetEntity: StockShelf::class)]
    private Collection $stockShelvesBuildings;

    public function __construct()
    {
        $this->stockShelves = new ArrayCollection();
        $this->stockShelvesSections = new ArrayCollection();
        $this->stockShelvesRowShelf = new ArrayCollection();
        $this->stockShelvesModules = new ArrayCollection();
        $this->stockShelvesBuildings = new ArrayCollection();
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

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

    /**
     * @return Collection<int, StockShelf>
     */
    public function getStockShelves(): Collection
    {
        return $this->stockShelves;
    }

    public function addStockShelf(StockShelf $stockShelf): static
    {
        if (!$this->stockShelves->contains($stockShelf)) {
            $this->stockShelves->add($stockShelf);
            $stockShelf->setShelf($this);
        }

        return $this;
    }

    public function removeStockShelf(StockShelf $stockShelf): static
    {
        if ($this->stockShelves->removeElement($stockShelf)) {
            // set the owning side to null (unless already changed)
            if ($stockShelf->getShelf() === $this) {
                $stockShelf->setShelf(null);
            }
        }

        return $this;
    }

    public function getRowShelf(): ?Row
    {
        return $this->row_shelf;
    }

    public function setRowShelf(?Row $row_shelf): static
    {
        $this->row_shelf = $row_shelf;

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

    public function getBuilding(): ?Building
    {
        return $this->building;
    }

    public function setBuilding(?Building $building): static
    {
        $this->building = $building;

        return $this;
    }

    /**
     * @return Collection<int, StockShelf>
     */
    public function getStockShelvesSections(): Collection
    {
        return $this->stockShelvesSections;
    }

    public function addStockShelvesSection(StockShelf $stockShelvesSection): static
    {
        if (!$this->stockShelvesSections->contains($stockShelvesSection)) {
            $this->stockShelvesSections->add($stockShelvesSection);
            $stockShelvesSection->setShelfSectionCode($this);
        }

        return $this;
    }

    public function removeStockShelvesSection(StockShelf $stockShelvesSection): static
    {
        if ($this->stockShelvesSections->removeElement($stockShelvesSection)) {
            // set the owning side to null (unless already changed)
            if ($stockShelvesSection->getShelfSectionCode() === $this) {
                $stockShelvesSection->setShelfSectionCode(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, StockShelf>
     */
    public function getStockShelvesRowShelf(): Collection
    {
        return $this->stockShelvesRowShelf;
    }

    public function addStockShelvesRowShelf(StockShelf $stockShelvesRowShelf): static
    {
        if (!$this->stockShelvesRowShelf->contains($stockShelvesRowShelf)) {
            $this->stockShelvesRowShelf->add($stockShelvesRowShelf);
            $stockShelvesRowShelf->setShelfRowShelfCode($this);
        }

        return $this;
    }

    public function removeStockShelvesRowShelf(StockShelf $stockShelvesRowShelf): static
    {
        if ($this->stockShelvesRowShelf->removeElement($stockShelvesRowShelf)) {
            // set the owning side to null (unless already changed)
            if ($stockShelvesRowShelf->getShelfRowShelfCode() === $this) {
                $stockShelvesRowShelf->setShelfRowShelfCode(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, StockShelf>
     */
    public function getStockShelvesModules(): Collection
    {
        return $this->stockShelvesModules;
    }

    public function addStockShelvesModule(StockShelf $stockShelvesModule): static
    {
        if (!$this->stockShelvesModules->contains($stockShelvesModule)) {
            $this->stockShelvesModules->add($stockShelvesModule);
            $stockShelvesModule->setShelfModeleCode($this);
        }

        return $this;
    }

    public function removeStockShelvesModule(StockShelf $stockShelvesModule): static
    {
        if ($this->stockShelvesModules->removeElement($stockShelvesModule)) {
            // set the owning side to null (unless already changed)
            if ($stockShelvesModule->getShelfModeleCode() === $this) {
                $stockShelvesModule->setShelfModeleCode(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, StockShelf>
     */
    public function getStockShelvesBuildings(): Collection
    {
        return $this->stockShelvesBuildings;
    }

    public function addStockShelvesBuilding(StockShelf $stockShelvesBuilding): static
    {
        if (!$this->stockShelvesBuildings->contains($stockShelvesBuilding)) {
            $this->stockShelvesBuildings->add($stockShelvesBuilding);
            $stockShelvesBuilding->setShelfBuildingCode($this);
        }

        return $this;
    }

    public function removeStockShelvesBuilding(StockShelf $stockShelvesBuilding): static
    {
        if ($this->stockShelvesBuildings->removeElement($stockShelvesBuilding)) {
            // set the owning side to null (unless already changed)
            if ($stockShelvesBuilding->getShelfBuildingCode() === $this) {
                $stockShelvesBuilding->setShelfBuildingCode(null);
            }
        }

        return $this;
    }
}
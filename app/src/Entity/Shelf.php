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
    #[ORM\Column(length: 1, options: ["fixed" => true])]
    private ?string $code = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'shelves')]
    #[ORM\JoinColumn(name:"section_code", referencedColumnName:"code", nullable: false)]
    private ?Section $section = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'shelves')]
    #[ORM\JoinColumn(name:"way_code", referencedColumnName:"way_code", nullable: false)]
    private ?Section $way = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'shelves')]
    #[ORM\JoinColumn(name:"module_code", referencedColumnName:"module_code", nullable: false)]
    private ?Section $module = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'shelves')]
    #[ORM\JoinColumn(name:"building_code", referencedColumnName:"building_code", nullable: false)]
    private ?Section $building = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'shelves')]
    #[ORM\JoinColumn(name:"warehouse_id", referencedColumnName:"warehouse_id", nullable: false)]
    private ?Section $warehouse = null;

    #[ORM\OneToMany(mappedBy: 'shelf', targetEntity: StockShelf::class)]
    private Collection $stockShelves;

    public function __construct()
    {
        $this->stockShelves = new ArrayCollection();
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

    public function getWay(): ?Section
    {
        return $this->way;
    }

    public function setWay(?Section $way): static
    {
        $this->way = $way;

        return $this;
    }

    public function getModule(): ?Section
    {
        return $this->module;
    }

    public function setModule(?Section $module): static
    {
        $this->module = $module;

        return $this;
    }

    public function getBuilding(): ?Section
    {
        return $this->building;
    }

    public function setBuilding(?Section $building): static
    {
        $this->building = $building;

        return $this;
    }

    public function getWarehouse(): ?Section
    {
        return $this->warehouse;
    }

    public function setWarehouse(?Section $warehouse): static
    {
        $this->warehouse = $warehouse;

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
}

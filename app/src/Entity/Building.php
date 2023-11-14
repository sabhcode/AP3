<?php

namespace App\Entity;

use App\Repository\BuildingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BuildingRepository::class)]
class Building
{
    #[ORM\Id]
    #[ORM\Column(length: 2)]
    private ?string $code = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'buildings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Warehouse $warehouse = null;

    #[ORM\OneToMany(mappedBy: 'building', targetEntity: Row::class)]
    private Collection $rows_building;

    #[ORM\OneToMany(mappedBy: 'building', targetEntity: Section::class)]
    private Collection $sections;

    #[ORM\OneToMany(mappedBy: 'building', targetEntity: Shelf::class)]
    private Collection $shelves;

    #[ORM\OneToMany(mappedBy: 'building', targetEntity: StockShelf::class)]
    private Collection $stockShelves;

    public function __construct()
    {
        $this->rows_building = new ArrayCollection();
        $this->sections = new ArrayCollection();
        $this->shelves = new ArrayCollection();
        $this->stockShelves = new ArrayCollection();
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

    public function getWarehouse(): ?Warehouse
    {
        return $this->warehouse;
    }

    public function setWarehouse(?Warehouse $warehouse): static
    {
        $this->warehouse = $warehouse;

        return $this;
    }

    /**
     * @return Collection<int, Row>
     */
    public function getRowsBuilding(): Collection
    {
        return $this->rows_building;
    }

    public function addRowsBuilding(Row $rowsBuilding): static
    {
        if (!$this->rows_building->contains($rowsBuilding)) {
            $this->rows_building->add($rowsBuilding);
            $rowsBuilding->setBuilding($this);
        }

        return $this;
    }

    public function removeRowsBuilding(Row $rowsBuilding): static
    {
        if ($this->rows_building->removeElement($rowsBuilding)) {
            // set the owning side to null (unless already changed)
            if ($rowsBuilding->getBuilding() === $this) {
                $rowsBuilding->setBuilding(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Section>
     */
    public function getSections(): Collection
    {
        return $this->sections;
    }

    public function addSection(Section $section): static
    {
        if (!$this->sections->contains($section)) {
            $this->sections->add($section);
            $section->setBuilding($this);
        }

        return $this;
    }

    public function removeSection(Section $section): static
    {
        if ($this->sections->removeElement($section)) {
            // set the owning side to null (unless already changed)
            if ($section->getBuilding() === $this) {
                $section->setBuilding(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Shelf>
     */
    public function getShelves(): Collection
    {
        return $this->shelves;
    }

    public function addShelf(Shelf $shelf): static
    {
        if (!$this->shelves->contains($shelf)) {
            $this->shelves->add($shelf);
            $shelf->setBuilding($this);
        }

        return $this;
    }

    public function removeShelf(Shelf $shelf): static
    {
        if ($this->shelves->removeElement($shelf)) {
            // set the owning side to null (unless already changed)
            if ($shelf->getBuilding() === $this) {
                $shelf->setBuilding(null);
            }
        }

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
            $stockShelf->setBuilding($this);
        }

        return $this;
    }

    public function removeStockShelf(StockShelf $stockShelf): static
    {
        if ($this->stockShelves->removeElement($stockShelf)) {
            // set the owning side to null (unless already changed)
            if ($stockShelf->getBuilding() === $this) {
                $stockShelf->setBuilding(null);
            }
        }

        return $this;
    }
}
<?php

namespace App\Entity;

use App\Repository\RowRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RowRepository::class)]
#[ORM\Table(name: '`row`')]
class Row
{
    #[ORM\Id]
    #[ORM\Column(length: 1)]
    private ?string $code = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'fk_rows')]
    #[ORM\JoinColumn(name:"module_code", referencedColumnName:"code",nullable: false)]
    private ?Module $module = null;

    #[ORM\OneToMany(mappedBy: 'row_section', targetEntity: Section::class)]
    private Collection $sections;
    
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'rows_building')]
    #[ORM\JoinColumn(name:"building_code", referencedColumnName:"code",nullable: false)]
    private ?Building $building = null;

    #[ORM\OneToMany(mappedBy: 'row_shelf', targetEntity: Shelf::class)]
    private Collection $shelves;

    #[ORM\OneToMany(mappedBy: 'Row_', targetEntity: StockShelf::class)]
    private Collection $stockShelves;


    public function __construct()
    {
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

    public function getModule(): ?Module
    {
        return $this->module;
    }

    public function setModule(?Module $module): static
    {
        $this->module = $module;

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
            $section->setRowSection($this);
        }

        return $this;
    }

    public function removeSection(Section $section): static
    {
        if ($this->sections->removeElement($section)) {
            // set the owning side to null (unless already changed)
            if ($section->getRowSection() === $this) {
                $section->setRowSection(null);
            }
        }

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
            $shelf->setRowShelf($this);
        }

        return $this;
    }

    public function removeShelf(Shelf $shelf): static
    {
        if ($this->shelves->removeElement($shelf)) {
            // set the owning side to null (unless already changed)
            if ($shelf->getRowShelf() === $this) {
                $shelf->setRowShelf(null);
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
            $stockShelf->setRow($this);
        }

        return $this;
    }

    public function removeStockShelf(StockShelf $stockShelf): static
    {
        if ($this->stockShelves->removeElement($stockShelf)) {
            // set the owning side to null (unless already changed)
            if ($stockShelf->getRow() === $this) {
                $stockShelf->setRow(null);
            }
        }

        return $this;
    }
}
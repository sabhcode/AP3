<?php

namespace App\Entity;

use App\Repository\SectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SectionRepository::class)]
class Section
{
    #[ORM\Id]
    #[ORM\Column(length: 1)]
    private ?string $code = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'sections')]
    #[ORM\JoinColumn(name:"row_code", referencedColumnName:"code",nullable: false)]
    private ?Row $row_section = null;

    #[ORM\OneToMany(mappedBy: 'section', targetEntity: Shelf::class)]
    private Collection $shelves;


    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'sections')]
    #[ORM\JoinColumn(name:"module_code", referencedColumnName:"code",nullable: false)]
    private ?Module $module = null;
    
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'sections')]
    #[ORM\JoinColumn(name:"building_code", referencedColumnName:"code",nullable: false)]
    private ?Building $building = null;

    #[ORM\OneToMany(mappedBy: 'section', targetEntity: StockShelf::class)]
    private Collection $stockShelves;

    public function __construct()
    {
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

    public function getRowSection(): ?Row
    {
        return $this->row_section;
    }

    public function setRowSection(?Row $row_section): static
    {
        $this->row_section = $row_section;

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
            $shelf->setSection($this);
        }

        return $this;
    }

    public function removeShelf(Shelf $shelf): static
    {
        if ($this->shelves->removeElement($shelf)) {
            // set the owning side to null (unless already changed)
            if ($shelf->getSection() === $this) {
                $shelf->setSection(null);
            }
        }

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
    public function getStockShelves(): Collection
    {
        return $this->stockShelves;
    }

    public function addStockShelf(StockShelf $stockShelf): static
    {
        if (!$this->stockShelves->contains($stockShelf)) {
            $this->stockShelves->add($stockShelf);
            $stockShelf->setSection($this);
        }

        return $this;
    }

    public function removeStockShelf(StockShelf $stockShelf): static
    {
        if ($this->stockShelves->removeElement($stockShelf)) {
            // set the owning side to null (unless already changed)
            if ($stockShelf->getSection() === $this) {
                $stockShelf->setSection(null);
            }
        }

        return $this;
    }
}
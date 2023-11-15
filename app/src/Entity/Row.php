<?php

namespace App\Entity;

use App\Repository\RowRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RowRepository::class)]
class Row
{
    #[ORM\Id]
    #[ORM\Column(length: 1)]
    private ?string $code = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'fk_rows')]
    #[ORM\JoinColumn(name:"module_code", referencedColumnName:"code",nullable: false)]
    private ?Module $module = null;
    
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'rows_building')]
    #[ORM\JoinColumn(name:"building_code", referencedColumnName:"code",nullable: false)]
    private ?Building $building = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'rowss')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Warehouse $warehouse = null;

    #[ORM\OneToMany(mappedBy: 'row_section', targetEntity: Section::class)]
    private Collection $sections;

    #[ORM\OneToMany(mappedBy: 'row_shelf', targetEntity: Shelf::class)]
    private Collection $shelves;

    public function __construct()
    {
        $this->sections = new ArrayCollection();
        $this->shelves = new ArrayCollection();
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

    public function getWarehouse(): ?Warehouse
    {
        return $this->warehouse;
    }

    public function setWarehouse(?Warehouse $warehouse): static
    {
        $this->warehouse = $warehouse;

        return $this;
    }
}
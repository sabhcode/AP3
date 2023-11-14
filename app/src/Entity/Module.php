<?php

namespace App\Entity;

use App\Repository\ModuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModuleRepository::class)]
class Module
{
    #[ORM\Id]
    #[ORM\Column(length: 2)]
    private ?string $code = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'modules')]
    #[ORM\JoinColumn(name:"building_code", referencedColumnName:"code", nullable: false)]
    private ?building $building = null;

    #[ORM\OneToMany(mappedBy: 'module', targetEntity: Row::class)]
    private Collection $fk_rows;

    #[ORM\OneToMany(mappedBy: 'module', targetEntity: Section::class)]
    private Collection $sections;

    #[ORM\OneToMany(mappedBy: 'module', targetEntity: Shelf::class)]
    private Collection $shelves;

    public function __construct()
    {
        $this->fk_rows = new ArrayCollection();
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

    public function getBuilding(): ?building
    {
        return $this->building;
    }

    public function setBuilding(?building $building): static
    {
        $this->building = $building;

        return $this;
    }

    /**
     * @return Collection<int, Row>
     */
    public function getFkRows(): Collection
    {
        return $this->fk_rows;
    }

    public function addFkRow(Row $fkRow): static
    {
        if (!$this->fk_rows->contains($fkRow)) {
            $this->fk_rows->add($fkRow);
            $fkRow->setModule($this);
        }

        return $this;
    }

    public function removeFkRow(Row $fkRow): static
    {
        if ($this->fk_rows->removeElement($fkRow)) {
            // set the owning side to null (unless already changed)
            if ($fkRow->getModule() === $this) {
                $fkRow->setModule(null);
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
            $section->setModule($this);
        }

        return $this;
    }

    public function removeSection(Section $section): static
    {
        if ($this->sections->removeElement($section)) {
            // set the owning side to null (unless already changed)
            if ($section->getModule() === $this) {
                $section->setModule(null);
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
            $shelf->setModule($this);
        }

        return $this;
    }

    public function removeShelf(Shelf $shelf): static
    {
        if ($this->shelves->removeElement($shelf)) {
            // set the owning side to null (unless already changed)
            if ($shelf->getModule() === $this) {
                $shelf->setModule(null);
            }
        }

        return $this;
    }
}
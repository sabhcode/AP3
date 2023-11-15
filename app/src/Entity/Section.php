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
    #[ORM\Column(length: 1, options: ["fixed" => true])]
    private ?string $code = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'sections')]
    #[ORM\JoinColumn(name:"way_code", referencedColumnName:"code", nullable: false)]
    private ?Way $way = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'sections')]
    #[ORM\JoinColumn(name:"module_code", referencedColumnName:"module_code", nullable: false)]
    private ?Way $module = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'sections')]
    #[ORM\JoinColumn(name:"building_code", referencedColumnName:"building_code", nullable: false)]
    private ?Way $building = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'sections')]
    #[ORM\JoinColumn(name:"warehouse_id", referencedColumnName:"warehouse_id", nullable: false)]
    private ?Way $warehouse = null;

    #[ORM\OneToMany(mappedBy: 'section', targetEntity: Shelf::class)]
    private Collection $shelves;

    public function __construct()
    {
        $this->shelves = new ArrayCollection();
    }

    public function getWay(): ?Way
    {
        return $this->way;
    }

    public function setWay(?Way $way): static
    {
        $this->way = $way;

        return $this;
    }

    public function getModule(): ?Way
    {
        return $this->module;
    }

    public function setModule(?Way $module): static
    {
        $this->module = $module;

        return $this;
    }

    public function getBuilding(): ?Way
    {
        return $this->building;
    }

    public function setBuilding(?Way $building): static
    {
        $this->building = $building;

        return $this;
    }

    public function getWarehouse(): ?Way
    {
        return $this->warehouse;
    }

    public function setWarehouse(?Way $warehouse): static
    {
        $this->warehouse = $warehouse;

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
}

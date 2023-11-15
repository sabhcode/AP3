<?php

namespace App\Entity;

use App\Repository\WayRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WayRepository::class)]
class Way
{
    #[ORM\Id]
    #[ORM\Column(length: 1, options: ["fixed" => true])]
    private ?string $code = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'ways')]
    #[ORM\JoinColumn(name:"module_code", referencedColumnName:"code", nullable: false)]
    private ?Module $module = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'ways')]
    #[ORM\JoinColumn(name:"building_code", referencedColumnName:"building_code", nullable: false)]
    private ?Module $building = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'ways')]
    #[ORM\JoinColumn(name:"warehouse_id", referencedColumnName:"warehouse_id", nullable: false)]
    private ?Module $warehouse = null;

    #[ORM\OneToMany(mappedBy: 'way', targetEntity: Section::class)]
    private Collection $sections;

    public function __construct()
    {
        $this->sections = new ArrayCollection();
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

    public function getBuilding(): ?Module
    {
        return $this->building;
    }

    public function setBuilding(?Module $building): static
    {
        $this->building = $building;

        return $this;
    }

    public function getWarehouse(): ?Module
    {
        return $this->warehouse;
    }

    public function setWarehouse(?Module $warehouse): static
    {
        $this->warehouse = $warehouse;

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
            $section->setWay($this);
        }

        return $this;
    }

    public function removeSection(Section $section): static
    {
        if ($this->sections->removeElement($section)) {
            // set the owning side to null (unless already changed)
            if ($section->getWay() === $this) {
                $section->setWay(null);
            }
        }

        return $this;
    }
}

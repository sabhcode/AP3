<?php

namespace App\Entity;

use App\Repository\WarehouseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WarehouseRepository::class)]
class Warehouse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(options: ['unsigned' => true])]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $city = null;

    #[ORM\OneToMany(mappedBy: 'warehouse', targetEntity: Store::class)]
    private Collection $stores;

    #[ORM\OneToMany(mappedBy: 'warehouse', targetEntity: StockWeb::class)]
    private Collection $stockWebs;

    #[ORM\OneToMany(mappedBy: 'warehouse', targetEntity: Building::class)]
    private Collection $buildings;

    #[ORM\OneToMany(mappedBy: 'warehouse', targetEntity: Module::class)]
    private Collection $modules;

    #[ORM\OneToMany(mappedBy: 'warehouse', targetEntity: row::class)]
    private Collection $rowss;

    #[ORM\OneToMany(mappedBy: 'warehouse', targetEntity: Section::class)]
    private Collection $sections;

    #[ORM\OneToMany(mappedBy: 'warehouse', targetEntity: Shelf::class)]
    private Collection $shelves;

    public function __construct()
    {
        $this->stores = new ArrayCollection();
        $this->stockWebs = new ArrayCollection();
        $this->buildings = new ArrayCollection();
        $this->modules = new ArrayCollection();
        $this->rowss = new ArrayCollection();
        $this->sections = new ArrayCollection();
        $this->shelves = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return Collection<int, Store>
     */
    public function getStores(): Collection
    {
        return $this->stores;
    }

    public function addStore(Store $store): static
    {
        if (!$this->stores->contains($store)) {
            $this->stores->add($store);
            $store->setWarehouse($this);
        }

        return $this;
    }

    public function removeStore(Store $store): static
    {
        if ($this->stores->removeElement($store)) {
            // set the owning side to null (unless already changed)
            if ($store->getWarehouse() === $this) {
                $store->setWarehouse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, StockWeb>
     */
    public function getStockWebs(): Collection
    {
        return $this->stockWebs;
    }

    public function addStockWeb(StockWeb $stockWeb): static
    {
        if (!$this->stockWebs->contains($stockWeb)) {
            $this->stockWebs->add($stockWeb);
            $stockWeb->setWarehouse($this);
        }

        return $this;
    }

    public function removeStockWeb(StockWeb $stockWeb): static
    {
        if ($this->stockWebs->removeElement($stockWeb)) {
            // set the owning side to null (unless already changed)
            if ($stockWeb->getWarehouse() === $this) {
                $stockWeb->setWarehouse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Building>
     */
    public function getBuildings(): Collection
    {
        return $this->buildings;
    }

    public function addBuilding(Building $building): static
    {
        if (!$this->buildings->contains($building)) {
            $this->buildings->add($building);
            $building->setWarehouse($this);
        }

        return $this;
    }

    public function removeBuilding(Building $building): static
    {
        if ($this->buildings->removeElement($building)) {
            // set the owning side to null (unless already changed)
            if ($building->getWarehouse() === $this) {
                $building->setWarehouse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Module>
     */
    public function getModules(): Collection
    {
        return $this->modules;
    }

    public function addModules(Module $module): static
    {
        if (!$this->modules->contains($module)) {
            $this->modules->add($module);
            $module->setWarehouse($this);
        }

        return $this;
    }

    public function removeModules(Module $module): static
    {
        if ($this->modules->removeElement($module)) {
            // set the owning side to null (unless already changed)
            if ($module->getWarehouse() === $this) {
                $module->setWarehouse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, row>
     */
    public function getRowss(): Collection
    {
        return $this->rowss;
    }

    public function addRowss(row $rowss): static
    {
        if (!$this->rowss->contains($rowss)) {
            $this->rowss->add($rowss);
            $rowss->setWarehouse($this);
        }

        return $this;
    }

    public function removeRowss(row $rowss): static
    {
        if ($this->rowss->removeElement($rowss)) {
            // set the owning side to null (unless already changed)
            if ($rowss->getWarehouse() === $this) {
                $rowss->setWarehouse(null);
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

    public function addSection(Section $sectionss): static
    {
        if (!$this->sections->contains($sectionss)) {
            $this->sections->add($sectionss);
            $sectionss->setWarehouse($this);
        }

        return $this;
    }

    public function removeSection(Section $sectionss): static
    {
        if ($this->sections->removeElement($sectionss)) {
            // set the owning side to null (unless already changed)
            if ($sectionss->getWarehouse() === $this) {
                $sectionss->setWarehouse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Shelf>
     */
    public function getShelf(): Collection
    {
        return $this->shelves;
    }

    public function addShelf(Shelf $shelves): static
    {
        if (!$this->shelves->contains($shelves)) {
            $this->shelves->add($shelves);
            $shelves->setWarehouse($this);
        }

        return $this;
    }

    public function removeShelf(Shelf $shelves): static
    {
        if ($this->shelves->removeElement($shelves)) {
            // set the owning side to null (unless already changed)
            if ($shelves->getWarehouse() === $this) {
                $shelves->setWarehouse(null);
            }
        }

        return $this;
    }
}

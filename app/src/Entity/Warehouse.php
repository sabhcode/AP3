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

    public function __construct()
    {
        $this->stores = new ArrayCollection();
        $this->stockWebs = new ArrayCollection();
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
}

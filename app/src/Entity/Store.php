<?php

namespace App\Entity;

use App\Entity\StockStore;
use App\Repository\StoreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StoreRepository::class)]
class Store
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(options: ['unsigned' => true])]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $city = null;

    #[ORM\Column(length: 100)]
    private ?string $country = null;

    #[ORM\OneToMany(mappedBy: 'store', targetEntity: StockStore::class)]
    private Collection $stockStores;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Warehouse $warehouse = null;

    public function __construct()
    {
        $this->stockStores = new ArrayCollection();
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

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection<int, StockStore>
     */
    public function getStockStores(): Collection
    {
        return $this->stockStores;
    }

    public function addStockStore(StockStore $stock): static
    {
        if (!$this->stockStores->contains($stock)) {
            $this->stockStores->add($stock);
            $stock->setStore($this);
        }

        return $this;
    }

    public function removeStockStore(StockStore $stock): static
    {
        if ($this->stockStores->removeElement($stock)) {
            // set the owning side to null (unless already changed)
            if ($stock->getStore() === $this) {
                $stock->setStore(null);
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

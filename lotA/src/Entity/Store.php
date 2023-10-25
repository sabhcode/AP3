<?php

namespace App\Entity;

use App\Repository\StoreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: StoreRepository::class)]
class Store
{

    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    private ?Uuid $uuid = null;

    #[ORM\Column]
    private ?string $city = null;

    #[ORM\OneToMany(mappedBy: 'store_uuid', targetEntity: Stock::class)]
    private Collection $stocks;

    public function __construct()
    {
        $this->uuid = Uuid::v4();
        $this->stocks = new ArrayCollection();
    }

    public function getUuid(): ?Uuid
    {
        return $this->uuid;
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
     * @return Collection<int, Stock>
     */
    public function getStocks(): Collection
    {
        return $this->stocks;
    }

    public function addStock(Stock $stock): static
    {
        if (!$this->stocks->contains($stock)) {
            $this->stocks->add($stock);
            $stock->setStore($this);
        }

        return $this;
    }

    public function removeStock(Stock $stock): static
    {
        if ($this->stocks->removeElement($stock)) {
            // set the owning side to null (unless already changed)
            if ($stock->getStore() === $this) {
                $stock->setStore(null);
            }
        }

        return $this;
    }
}

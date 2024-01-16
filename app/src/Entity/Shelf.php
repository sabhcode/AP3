<?php

namespace App\Entity;

use App\Repository\ShelfRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShelfRepository::class)]
class Shelf
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 1, options: ["fixed" => true])]
    private ?string $code = null;

    #[ORM\ManyToOne(inversedBy: 'shelves')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Section $section = null;

    #[ORM\OneToMany(mappedBy: 'shelf', targetEntity: StockShelf::class)]
    private Collection $stockShelves;

    public function __construct()
    {
        $this->stockShelves = new ArrayCollection();
    }

    public function getCode(): ?String
    {
        return $this->code;
    }

    public function setCode(?String $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getSection(): ?Section
    {
        return $this->section;
    }

    public function setSection(?Section $section): static
    {
        $this->section = $section;

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
            $stockShelf->setShelf($this);
        }

        return $this;
    }

    public function removeStockShelf(StockShelf $stockShelf): static
    {
        if ($this->stockShelves->removeElement($stockShelf)) {
            // set the owning side to null (unless already changed)
            if ($stockShelf->getShelf() === $this) {
                $stockShelf->setShelf(null);
            }
        }

        return $this;
    }
}

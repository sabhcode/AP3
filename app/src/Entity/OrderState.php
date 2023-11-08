<?php

namespace App\Entity;

use App\Repository\OrderStateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderStateRepository::class)]
class OrderState
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(options: ['unsigned' => true])]
    private ?int $id = null;

    #[ORM\Column]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'orderState', targetEntity: OrderRank::class)]
    private Collection $orderRanks;

    public function __construct()
    {
        $this->orderRanks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, OrderRank>
     */
    public function getOrderRanks(): Collection
    {
        return $this->orderRanks;
    }

    public function addOrderRank(OrderRank $orderRank): static
    {
        if (!$this->orderRanks->contains($orderRank)) {
            $this->orderRanks->add($orderRank);
            $orderRank->setOrderState($this);
        }

        return $this;
    }

    public function removeOrderRank(OrderRank $orderRank): static
    {
        if ($this->orderRanks->removeElement($orderRank)) {
            // set the owning side to null (unless already changed)
            if ($orderRank->getOrderState() === $this) {
                $orderRank->setOrderState(null);
            }
        }

        return $this;
    }
}

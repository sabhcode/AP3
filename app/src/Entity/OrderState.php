<?php

namespace App\Entity;

use App\Repository\OrderStateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: OrderStateRepository::class)]
class OrderState
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    private ?Uuid $uuid = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: "orderState", targetEntity: Order::class)]
    private Collection $orders;

    #[ORM\OneToMany(mappedBy: 'order_state_uuid', targetEntity: OrderRank::class)]
    private Collection $orderRanks;

    public function __construct()
    {
        $this->uuid = Uuid::v4();
        $this->orders = new ArrayCollection();
        $this->orderRanks = new ArrayCollection();
    }

    public function getUuid(): ?Uuid
    {
        return $this->uuid;
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
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
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
            $orderRank->setOrderStateUuid($this);
        }

        return $this;
    }

    public function removeOrderRank(OrderRank $orderRank): static
    {
        if ($this->orderRanks->removeElement($orderRank)) {
            // set the owning side to null (unless already changed)
            if ($orderRank->getOrderStateUuid() === $this) {
                $orderRank->setOrderStateUuid(null);
            }
        }

        return $this;
    }
}

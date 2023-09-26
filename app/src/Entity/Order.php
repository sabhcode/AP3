<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    private ?Uuid $uuid = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateTime = null;
    
    #[ORM\Column]
    private ?float $totalPrice = null;

    #[ORM\OneToMany(mappedBy: "order_uuid", targetEntity: OrderDetail::class)]
    private Collection $orderDetails;

    #[ORM\ManyToOne(inversedBy: "order")]
    #[ORM\JoinColumn(name: "orderstate_uuid", referencedColumnName: "uuid", nullable: false)]
    private ?OrderState $orderState = null;

    #[ORM\OneToMany(mappedBy: 'order_uuid', targetEntity: OrderRank::class)]
    private Collection $orderRanks;

    public function __construct()
    {
        $this->uuid = Uuid::v4();
        $this->orderDetails = new ArrayCollection();
        $this->orderRanks = new ArrayCollection();
    }

    public function getUuid(): ?Uuid
    {
        return $this->uuid;
    }

    public function getDateTime(): ?\DateTimeInterface
    {
        return $this->dateTime;
    }

    public function setDateTime(\DateTimeInterface $dateTime): static
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    public function getTotalPrice(): ?float
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(float $totalPrice): static
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * @return Collection<int, OrderDetail>
     */
    public function getOrderDetail(): Collection
    {
        return $this->orderDetails;
    }

    public function getOrderState(): ?OrderState
    {
        return $this->orderState;
    }

    public function setOrderState(?OrderState $orderState): static
    {
        $this->orderState = $orderState;

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
            $orderRank->setOrderUuid($this);
        }

        return $this;
    }

    public function removeOrderRank(OrderRank $orderRank): static
    {
        if ($this->orderRanks->removeElement($orderRank)) {
            // set the owning side to null (unless already changed)
            if ($orderRank->getOrderUuid() === $this) {
                $orderRank->setOrderUuid(null);
            }
        }

        return $this;
    }
}
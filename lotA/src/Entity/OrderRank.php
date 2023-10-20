<?php

namespace App\Entity;

use App\Repository\OrderRankRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRankRepository::class)]
class OrderRank
{
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'orderRanks')]
    #[ORM\JoinColumn(name: 'order_state_uuid', referencedColumnName: 'uuid', nullable: false)]
    private ?OrderState $order_state_uuid = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'orderRanks')]
    #[ORM\JoinColumn(name: 'order_uuid', referencedColumnName: 'uuid', nullable: false)]
    private ?Order $order_uuid = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $datetime = null;

    public function getOrderStateUuid(): ?OrderState
    {
        return $this->order_state_uuid;
    }

    public function setOrderStateUuid(?OrderState $order_state_uuid): static
    {
        $this->order_state_uuid = $order_state_uuid;

        return $this;
    }

    public function getOrderUuid(): ?Order
    {
        return $this->order_uuid;
    }

    public function setOrderUuid(?Order $order_uuid): static
    {
        $this->order_uuid = $order_uuid;

        return $this;
    }

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeInterface $datetime): static
    {
        $this->datetime = $datetime;

        return $this;
    }
}

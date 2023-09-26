<?php

namespace App\Entity;

use App\Repository\OrderRankRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRankRepository::class)]
class OrderRank
{

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $datetime = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'orderRanks')]
    #[ORM\JoinColumn(referencedColumnName:"uuid" ,name:"orderstate_uuid", nullable: false)]
    private ?orderState $orderstate_uuid = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'orderRanks')]
    #[ORM\JoinColumn(referencedColumnName:"uuid" ,name:"order_uuid", nullable: false)]
    private ?Order $order_uuid = null;



    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeInterface $datetime): static
    {
        $this->datetime = $datetime;

        return $this;
    }

    public function getOrderstateUuid(): ?orderState
    {
        return $this->orderstate_uuid;
    }

    public function setOrderstateUuid(?orderState $orderstate_uuid): static
    {
        $this->orderstate_uuid = $orderstate_uuid;

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
}
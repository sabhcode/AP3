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
    #[ORM\JoinColumn(nullable: false)]
    private ?OrderState $orderState = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'orderRanks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?OrderUser $order = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_time = null;

    public function __construct()
    {
        $datetime = new \DateTime();
        $timezone = new \DateTimeZone('Europe/Paris');
        $this->date_time = $datetime->setTimezone($timezone);
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

    public function getOrder(): ?OrderUser
    {
        return $this->order;
    }

    public function setOrder(?OrderUser $order): static
    {
        $this->order = $order;

        return $this;
    }

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->date_time;
    }

    public function setDatetime(\DateTimeInterface $date_time): static
    {
        $this->date_time = $date_time;

        return $this;
    }
}

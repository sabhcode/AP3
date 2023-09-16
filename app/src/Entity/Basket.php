<?php

namespace App\Entity;

use App\Repository\BasketRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: BasketRepository::class)]
class Basket
{

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'basket')]
    #[ORM\JoinColumn(name: "user_uuid", referencedColumnName: "uuid", nullable: false)]
    private ?User $user_uuid = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'basket')]
    #[ORM\JoinColumn(name: "product_uuid", referencedColumnName: "uuid", nullable: false)]
    private ?Product $product_uuid = null;

    #[ORM\Column]
    private ?int $quantity = null;

    public function getUserUuid(): ?User
    {
        return $this->user_uuid;
    }

    public function setUserUuid(?User $user_uuid): static
    {
        $this->user_uuid = $user_uuid;

        return $this;
    }

    public function getProductUuid(): ?Product
    {
        return $this->product_uuid;
    }

    public function setProductUuid(?Product $product_uuid): static
    {
        $this->product_uuid = $product_uuid;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }
}
